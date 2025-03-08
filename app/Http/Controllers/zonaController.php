<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\PoltArea;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    public function getZona(Request $request, $slug)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $poltArea = PoltArea::where("slug", $slug)->first();
        $query = Zona::query();
        if (!empty($search)) {
            $query->where('zona', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $poltArea = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $zona = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view('show.zona', compact('zona', "user", 'search', 'perPage', 'poltArea'));
    }
    public function tambah($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahZona', compact('user', 'poltArea'));
    }

    public function create($slug)
    {
        $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahZona', compact('poltArea'));
    }

    public function store(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'zona' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $poltArea = PoltArea::where('slug', $slug)->firstOrFail();

            $zona = Zona::create([
                'polt_area_id' => $poltArea->id,
                'zona' => $validatedData['zona'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'jenis_hutan' => $validatedData['jenis_hutan'],
                'slug' => Str::slug($validatedData['zona']),
            ]);

            DB::commit();
            return redirect()->route('zona.getZona', ['slug' => $slug])->with('success', 'Zona berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
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
    public function edit($slugP, $slugZ)
    {
        // $user = Auth::user();
        $poltArea = PoltArea::where('slug', $slugP)->firstOrFail();
        $zona = Zona::where('slug', $slugZ)->where('polt_area_id', $poltArea->id)->firstOrFail();

        return view('edit.zona', compact('poltArea', 'zona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slugP, $slugZ)
    {
        $validatedData = $request->validate([
            'zona' => 'required|string|max:255|unique:zona,zona,'.$slugZ. ',slug',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            $poltArea = PoltArea::where('slug', $slugP)->firstOrFail();
            $zona = Zona::where('slug', $slugZ)->where('polt_area_id', $poltArea->id)->firstOrFail();

            $zona->update([
                'zona' => $validatedData['zona'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'jenis_hutan' => $validatedData['jenis_hutan'],
                'slug' => Str::slug($validatedData['zona']),
            ]);

            DB::commit();
            return redirect()->route('zona.getZona', ['slug' => $slugP])->with('success', 'Zona berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
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
