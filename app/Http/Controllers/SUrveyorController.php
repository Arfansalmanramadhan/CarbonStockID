<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SUrveyorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("Surveyor", compact('user'));
    }
    public function indexx()
    {
        $user = Auth::user();
        return view("Tambah-Surveyor", compact('user'));
    }
    public function surveyor(Request $request)
    {
        $user = Auth::user();
        $registrasi = User::all()->where('role_id', '=', 2);
        $anggota = DB::table('registrasi')
            ->leftJoin('anggota_tim', 'registrasi.id', '=', 'anggota_tim.registrasi_id')
            ->leftJoin('tim', 'anggota_tim.tim_id', '=', 'tim.id')
            ->select(
                'registrasi.nama as nama',
                'registrasi.username as username',
                'registrasi.email as email',
                'registrasi.slug as slug',
                'registrasi.foto as foto',
                'registrasi.nip as nip',
                'registrasi.no_hp as no_hp',
                DB::raw("COALESCE(string_agg(tim.nama, ', '), 'Belum ada tim') as nama_tim"),
                DB::raw("COALESCE(registrasi.nik, 'Belum ada NIK') as nik")
            )
            ->where('role_id', '=', 2)
            ->groupBy(
                'registrasi.nama',
                'registrasi.username',
                'registrasi.email',
                'registrasi.slug',
                'registrasi.foto', // ← tambahkan ini juga
                'registrasi.nip',
                'registrasi.no_hp',
                'registrasi.nik'
            )
            ->get();

        return view("Percobaan", compact('registrasi', 'anggota', 'user'));
    }
    public function show(string $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('edit.surveyor', ['user' => $user]);
    }
    public function update(Request $request, $slug)
    {
        // dd($request->all());
        try {
            // dd("Hanif");
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1', // Validasi gambar
                'nip' => 'nullable|numeric',
                'no_hp' => 'nullable|numeric', // Sesuaikan max sesuai dengan batas panjang no_hp
                'nik' => 'nullable|numeric',
                // 'foto_ktp' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
                // 'foto_tandatangan' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);
            // Cari pengguna berdasarkan slug
            $user = User::where('slug', $slug)->firstOrFail();
            // dd($request->all());
            $user->update($validatedData);
            // dd( $user);
            // return response()->json([
            //     "success" => true,
            //     "message" => "Data updated successfully",
            //     "data" => $User
            // ], 200);
            return redirect()->route('Surveyor.surveyor')->with('success', 'Surveyor berhasil diperbarui.');
            // return redirect()->route('profile.index', ['slug' => $User->slug])->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            // return response()->json([
            //     "message" => $e->getMessage()
            // ], 500);
            // Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui surveyor.' . $e->getMessage());
        }
    }
}
