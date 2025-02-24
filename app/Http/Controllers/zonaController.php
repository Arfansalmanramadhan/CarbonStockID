<?php

namespace App\Http\Controllers;

use App\Models\PoltArea;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class zonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('zona', compact('user'));
    }

    public function tambah()
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id)->first();
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('tambah.TambahZona', compact('user', 'poltArea'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('id', $user->id);
        $zona = Zona::where('polt-area_id', $user->id );
        return view('tambah.zona', compact('user', 'poltArea', 'zona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
