<?php

namespace App\Http\Controllers\Authentication;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequests;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /* public function registasi(RegisterRequests $request)
    {
        // dd($request->all());
        try {
            $request["password"] = Hash::make($request->password);
            $user = User::create($request->all());
            return response()->json([
                "mesage" => "Pengguna berhasil registasi",
                "data" =>  $user
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                "mesage" => $error->getMessage(),
            ], 500);
        }
    } */
    public function registasi(Request $request)
    {
        try {
            $request["password"] = Hash::make($request->password);
            $user = User::create($request->all());
            // Redirect ke halaman login jika berhasil
            return redirect()->route('login')->with('success', 'Pengguna berhasil registrasi, silakan login');
        } catch (Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }
    public function login(LoginRequests $request)
    {
        $credentials = [
            'password' => $request->input('password'),
        ];

        if (filter_var($request->input('email_or_username'), FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->input('email_or_username');
        } else {
            $credentials['username'] = $request->input('email_or_username');
        }

        // Autentikasi
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        // Jika berhasil login
        return redirect()->route('dashboard')->with('success', 'Login berhasil');
    }


    /* public function login(LoginRequests $request)
    {
        // Mengambil password dari request
        $credentials = $request->only('password');

        // Menambahkan email atau username ke credentials
        if ($request->has('username')) {
            $credentials['username'] = $request->username;
        } elseif ($request->has('email')) {
            $credentials['email'] = $request->email;
        }

        // Mengambil data pengguna dari database berdasarkan email atau username
        $user = User::where('email', $credentials['email'] ?? null)
                    ->orWhere('username', $credentials['username'] ?? null)
                    ->first();

        // Jika pengguna tidak ditemukan atau password salah
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->with('error', 'Email/Username atau password salah.');
        }

        // Autentikasi sukses, buat token baru atau autentikasi Laravel standar
        auth()->login($user);
        return redirect()->route('dashboard')->with('success', 'Login sukses.');
    } */

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
            return response()->json([
                "message" => "Anda belum masuk"
            ], 401);
        }

        // Menghapus token yang digunakan saat ini
        $user = auth()->user();
        $tokenId = $request->bearerToken(); // Mengambil token dari header Authorization
        $user->tokens()->where('id', $tokenId)->delete();

        return response()->json([
            "message" => "Logout sukses"
        ], 200);
    }
    public function getUser()
    {
        return response()->json([
            "user" => auth()->user()
        ], 200);
    }
}
