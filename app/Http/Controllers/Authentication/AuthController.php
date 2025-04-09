<?php

namespace App\Http\Controllers\Authentication;

use Exception;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterRequests;
use App\Models\PoltArea;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function registasii()
    {
        return view('register');
    }
    public function registasi(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi data input
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'nama' => 'required',
                'email' => 'required|email|unique:registrasi',
                'password' => 'required|min:8|confirmed', // Menggunakan password_confirmation
                'password_confirmation' => 'required|same:password|min:8', // Menggunakan password_confirmation
                'nip' => 'required|unique:registrasi',
                'no_hp' => 'required|unique:registrasi',
                'foto' => 'nullable|file|mimes:jpeg,png,jpg',
                'foto_ktp' => 'nullable|file|mimes:jpeg,png,jpg',
                'foto' => 'required',
                'foto_ktp' => 'required',
            ]);
            // dd($validator->errors());
            // dd($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Hash password
            $request['password'] = Hash::make($request->password);

            // Buat user baru
            $user = User::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request['password'],
                'nip' => $request->nip,
                'no_hp' => $request->no_hp,
                'foto' => $request->foto,
                'foto_ktp' => $request->foto_ktp,
            ]);

            // Proses upload foto
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_foto.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('images/profils'), $fotoName);
                $user->foto = 'images/profils/' . $fotoName;
            }

            if ($request->hasFile('foto_ktp')) {
                $fotoKtp = $request->file('foto_ktp');
                $fotoKtpName = time() . '_ktp.' . $fotoKtp->getClientOriginalExtension();
                $fotoKtp->move(public_path('images/ktp'), $fotoKtpName);
                $user->foto_ktp = 'images/ktp/' . $fotoKtpName;
            }

            $user->save();

            DB::commit();

            return redirect()->route('login')->with('success', 'Pengguna berhasil registrasi, silakan login');
        } catch (Exception $error) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Registrasi gagal, silakan coba lagi');
        }
        // try {
        //     $request["password"] = Hash::make($request->password);
        //     $user = User::create($request->all());
        //     // PoltArea::create([
        //     //     'profil_id' => $profil->id,
        //     //     'daerah' => $request->input('daerah', ''),
        //     //     "slug" => $request->input('slug', ''),
        //     //     'latitude' => $request->input('latitude', null),
        //     //     'longitude' => $request->input('longitude', null),
        //     // ]);
        //     /* return response()->json([
        //         "mesage" => "Pengguna berhasil registasi",
        //         "data" =>  $user
        //     ], 200); */
        //     // Redirect ke halaman login jika berhasil
        //     return redirect()->route('login')->with('success', 'Pengguna berhasil registrasi, silakan login');
        // } catch (Exception $error) {
        //     /* return response()->json([
        //         "mesage" => $error->getMessage(),
        //     ], 500); */
        //     DB::rollBack();
        //     return redirect()->back()->with('error', "anda gagal regestasi ");
        // }
    }


    public function login(Request $request)
    {
        // Mengambil password dari request
        // $credentials = $request->only('password');

        // // Menambahkan email atau username ke credentials
        // if ($request->has('username')) {
        //     $credentials['username'] = $request->username;
        // } elseif ($request->has('email')) {
        //     $credentials['email'] = $request->email;
        // }

        // Mengambil data pengguna dari database berdasarkan email atau username
        // $user = User::where('email', $credentials['email'] ?? null)
        //     ->orWhere('username', $credentials['username'] ?? null)
        //     ->first();

        // Jika pengguna tidak ditemukan atau password salah
        // if (!$user || !Hash::check($credentials['password'], $user->password)) {
        //     return response()->json([
        //         "message" => "invalid credentials",
        //     ], 500);
        //}

        // Autentikasi sukses, buat token baru
        // $user->tokens()->delete();
        // $token = $user->createToken("token")->plainTextToken;

        $credentials = $request->validate([
            'login' => ['required'], // Bisa email atau username
            'password' => ['required', 'min:8'],
        ]);
        // apakah input adalah email atau ysername
        // Tentukan apakah input adalah email atau username
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
            // Cek role_id == 2 (dilarang login)
            if (Auth::user()->role_id == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerate();

                return back()->withErrors([
                    'surveyor' => 'Akun kamu tidak diizinkan masuk.',
                ])->onlyInput('login');
            }

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();
        }
        return back()->withErrors([
            'login' => 'Email/Username atau Password salah.',
        ])->onlyInput('login');
        // return redirect()->route('dashboard');

        /* return response()->json([
            "message" => "login sukses",
            "data" => [
                "user" => $user,
                "token" => $token,
                'redirect_url' => route('dashboard')
            ]
        ], 200); */
    }


    public function forgotPassword(Request $request)
    {
        //validasi email
        $request->validate([
            'email' => 'required|email|exists:registrasi,email'
        ]);
        // Mengirim link reset password ke email pengguna
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // Mengembalikan respon berdasarkan status pengiriman email
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'pesan'  => "Password Anda telah berhasil direset."
            ], 200);
        } else {
            return response()->json([
                'pesan' => 'Terjadi kesalahan saat mengirim link reset password.'
            ], 400);
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            // 'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset([
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        ]);
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Password Anda telah berhasil direset.'
            ], 200);
        } else {

            return response()->json([
                'message' => 'Token tidak valid atau terjadi kesalahan.'
            ], 400);
        }
    }
    public function logout(Request $request)
    {
        // Memeriksa apakah pengguna saat ini sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withHeaders([
                'error' => 'anda belum login'
            ]);
            // return response()->json([
            //     "message" => "Anda belum masuk"
            // ], 401);
        }

        // Menghapus token yang digunakan saat ini
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // $user = auth()->user();
        // $tokenId = $request->bearerToken(); // Mengambil token dari header Authorization
        // $user->tokens()->where('id', $tokenId)->delete();

        // return response()->json([
        //     "message" => "Logout sukses"
        // ], 200);
        return redirect()->route('login')->with('success', 'Logout sukses.');
    }
    public function getUser()
    {
        return response()->json([
            "user" => auth()->user()
        ], 200);
    }
}
