<?php

namespace App\Http\Controllers;

use App\Models\polt_a;
use App\Models\Polt_b;
use App\Models\Polt_c;
use App\Models\Polt_d;
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
        $poltArea = PoltArea::findOrFail($request->jenis);
        $polt_a = polt_a::findOrFail($request->jenis);
        $polt_b = Polt_b::findOrFail($request->jenis);
        $polt_c = Polt_c::findOrFail($request->jenis);
        $polt_d = Polt_d::findOrFail($request->jenis);

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
