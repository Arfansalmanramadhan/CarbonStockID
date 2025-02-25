<?php

namespace App\Http\Controllers;

use App\Models\AnggotaTim;
use App\Models\Periode;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Ambil data Tim beserta relasi periode
        $tim = Tim::with('periode')->get();

        return view("Manajemen-Tim", compact('user', 'tim'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'registrasi_id' => 'required|exists:registrasi,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // dd($validatedData);
        DB::beginTransaction();
        try {
            // Membuat Tim
            $tim = Tim::create([
                "nama" => $validatedData['nama']
            ]);

            // Mengambil data user registrasi
            // Mengambil data user registrasi
            $registrasi = User::find($validatedData['registrasi_id']);
            if (!$registrasi) {
                return redirect()->back()->with('error', 'Registrasi tidak ditemukan');
            }

            // Membuat anggota tim
            $anggotaTim = AnggotaTim::create([
                'registrasi_id' => $registrasi->id,
                'tim_id' => $tim->id
            ]);

            // Membuat Periode jika anggota tim berhasil dibuat
            $periode = Periode::create([
                'anggota_tim_id' => $anggotaTim->id,
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_berakhir' => $validatedData['tanggal_berakhir']
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Periode berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
