<?php

namespace App\Http\Controllers;

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
    public function getZona(Request $request, $slug){
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $lokasi = PoltArea::where("slug", $slug)->first();
        $query = Zona::query();
        if (!empty($search)) {
            $query->where('zona', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $lokasi = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $zona = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view('show.zona', compact('zona', "user" , 'search', 'perPage', 'lokasi'));
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
        $poltareaID = $request->input("polt-area_id"); // pastikan polt-area_id dikirim dari FE
        $polt = PoltArea::find($poltareaID);
        // dd($request->all());
        // Validasi request
        $validatedData = $request->validate([
            'polt-area_id' => 'required|integer|exists:polt-area,id',
            'zona' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jenis_hutan' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {

            $poltArea = Zona::create([
                'polt-area_id' => $polt->id,
                "zona" => $validatedData['zona'],
                "jenis_hutan" => $validatedData['jenis_hutan'],
                "latitude" => $validatedData['latitude'],
                "longitude" => $validatedData['longitude'],
                "slug" => Str::slug($validatedData['zona']),
            ]);
            // dd($poltArea);
            // Response berhasil
            // return response()->json([
            //     'message' => 'PoltArea berhasil di buat',
            //     'data' => $poltArea
            // ], 201);
            DB::commit();
            return redirect()->back()->with('success', 'Zona berhasil ditambahkan!');
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
