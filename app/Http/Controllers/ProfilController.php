<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Http\Resources\ProfilResources;
use App\Models\Profil;
use Exception;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::with('user:id,username,email')->get();
        return  ProfilResources::collection($profil);
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
    public function store(ProfilRequest $request)
    {
        try {
            $profil = Profil::create($request->all());
            return response()->json([
                "sukses" => true,
                "pesan" => "Data profil berhasil terkirim",
                "data" => $profil
            ], 200);
            // dd($profil);
        } catch (Exception $e) {
            return response()->json([
                "pesan"  => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profil = Profil::with('user:id,username,email')->findOrFail($id);
        return new ProfilResources($profil);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Profil::findOrFail($id);
        return response()->json([
            "data" => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfilRequest $request, string $id)
    {
        try {
            $profil = Profil::find($id)->update($request->all());
            return response()->json([
                "success" => true,
                "message" => "Data updated successfully",
                "data" => $profil
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
