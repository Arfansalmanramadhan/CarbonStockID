<?php

namespace App\Http\Controllers;

use App\Models\PoltArea;
use Illuminate\Http\Request;

class PoltAreaController extends Controller
{

    // protected $geocodingService;

    // public function __construct(GeocodingService $geocodingService)
    // {
    //     $this->geocodingService = $geocodingService;
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Ambil profil dari user yang sedang login, misal melalui Auth
        $user = auth()->user();
        $profile = $user->profil; // Menganggap setiap user memiliki 1 profil terkait
        
        // Validasi request
        $validatedData = $request->validate([
            'daerah' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        try {
            // Membuat instance PoltArea baru
            $poltAreaa = new PoltArea;
            $poltAreaa->daerah = $validatedData['daerah'];
            $poltAreaa->latitude = $validatedData['latitude'];
            $poltAreaa->longitude = $validatedData['longitude'];
            $poltAreaa->save();

            // Response berhasil
            return response()->json([
                'message' => 'PoltArea created successfully',
                'data' => $poltAreaa
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Failed to create PoltArea',
                'error' => $e->getMessage()
            ], 500);
        }

        // Tentukan jenis polt berdasarkan input jenis
        // if (in_array($request->jenis, ['Semai', 'Serasah', 'Tumbuhan bawah', 'Tanah'])) {
        //     $polt_a = Polt_a::create([
        //         "polt-area_id" => $poltArea->id,  // Assign polt-area_id
        //         "jenis" => $request->jenis
        //     ]);
        //     if ($request->jenis == 'Semai') {
        //         $polt_a->jenis = "Semai";
        //         $polt_a->save();
        //     } elseif ($request->jenis == 'Serasah') {
        //         $polt_a->jenis = "Serasah";
        //         $polt_a->save();
        //     } elseif ($request->jenis == 'Tumbuhan bawah') {
        //         $polt_a->jenis = "Tumbuhan bawah";
        //         $polt_a->save();
        //     } elseif ($request->jenis == 'Tanah') {
        //         $polt_a->jenis = "Tanah";
        //         $polt_a->save();
        //     }
        //     return response()->json([
        //         "pesan" => "Data polt A berhasil disimpan",
        //         "data" => $polt_a
        //     ]);
        // } elseif ($request->jenis == 'Pancang') {
        //     $polt_b = Polt_b::create([
        //         "polt-area_id" => $poltArea->id,  // Assign polt-area_id
        //         "jenis" => $request->jenis
        //     ]);
        //     $polt_b->jenis == "Pancang";
        //     $polt_b->save();
        //     return response()->json([
        //         "pesan" => "Data polt B berhasil disimpan",
        //         "data" => $polt_b
        //     ]);
        // } elseif ($request->jenis == 'Tiang') {
        //     $polt_c = Polt_c::create([
        //         "polt-area_id" => $poltArea->id,  // Assign polt-area_id
        //         "jenis" => $request->jenis
        //     ]);
        //     $polt_c->jenis = "Tiang";
        //     $polt_c->save();
        //     return response()->json([
        //         "pesan" => "Data polt C berhasil disimpan",
        //         "data" => $polt_c
        //     ]);
        // } elseif ($request->jenis == 'Pohon') {
        //     $polt_d = Polt_d::create([
        //         "polt-area_id" => $poltArea->id,  // Assign polt-area_id
        //         "jenis" => $request->jenis
        //     ]);
        //     $polt_d->jenis = "Pohon";
        //     $polt_d->save();
        //     return response()->json([
        //         "pesan" => "Data polt D berhasil disimpan",
        //         "data" => $polt_d
        //     ]);
        // } else {
        //     return response()->json(['error' => 'Jenis tidak ada'], 400);
        // }
        // return response()->json([
        //     'pesa' => "Data berhasil disimpan ",
        //     "pesan" => $poltArea
        // ], 200);
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
