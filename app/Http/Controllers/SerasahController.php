<?php

namespace App\Http\Controllers;

use App\Models\PoltArea;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SerasahController extends Controller
{
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
        // ambil poltArea berdasarkan id
        $poltareaID = $request->input("polt-area_id"); // pastikan polt-area_id dikirim dari FE 
        $polt = PoltArea::find($poltareaID);
        if (!$poltareaID) {
            return response()->json([
                "persan" => "Polt Area tidak terkirim",
                "PoltArea" => $poltareaID
            ], 404);
        }

        // validasi reques 
        $validatedData = $request->validate([
            'polt-area_id' => 'required|integer|exists:polt-area,id', 
            'total_berat_basah' => 'required|numeric|min:0',           
            'sample_berat_basah' => 'required|numeric|min:0',          
            'total_berat_kering' => 'required|numeric|min:0',          
            'sample_berat_basah' => 'required|numeric|min:0',          
            'kandungan_karbon' => 'required|numeric|min:0',            
            'co2' => 'required|numeric|min:0',
        ]);
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
