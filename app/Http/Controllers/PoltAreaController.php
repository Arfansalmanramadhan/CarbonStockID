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
        $poltArea = PoltArea::with('daerah')->get();
        return response()->json([
            'message' => 'PoltAreas fetched successfully',
            'data' => $poltArea
        ], 200);
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
            $poltArea = PoltArea::create([
                "profil_id" => $profile->id,
                "daerah" => $validatedData['daerah'],
                "latitude" => $validatedData['latitude'],
                "longitude" => $validatedData['longitude']
            ]);

            // Response berhasil
            return response()->json([
                'message' => 'PoltArea berhasil di buat',
                'data' => $poltArea
            ], 201);
        } catch (\Exception $e) {
            // Response error
            return response()->json([
                'message' => 'Gagal membuat PoltArea',
                'error' => $e->getMessage()
            ], 500);
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
