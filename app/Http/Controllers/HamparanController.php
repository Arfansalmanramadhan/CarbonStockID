<?php

namespace App\Http\Controllers;

use App\Models\Hamparan;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HamparanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query("search");
        $perPage = $request->query('per_page', 5);
        $query = Hamparan::query();
        if (!empty($search)) {
            $query->where('nama_hamparan', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $poltArea = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $hamparan = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view('Hamparan', compact('user', 'hamparan',  'search', 'perPage'));
    }
    public function getHamparan(Request $request, $slug)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $zona = Zona::where("slug", $slug)->firstOrFail();
        $query = Hamparan::where('zona_id', $zona->id);
        // $poltArea = PoltArea::where("slug", $poltSlug)->firstOrFail();
        // $zona = Zona::where("slug", $zonaSlug)
        // ->where('polt_area_id', $poltArea->id);
        if (!empty($search)) {
            $query->where('nama_hamparan', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }
        // dd($zona );
        $hamparan = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        
        return view('show.Hamparan', compact('hamparan','user', 'search', 'perPage', 'zona'));
    }
    public function tambah($slug)
    {
        $user = Auth::user();
        $zona = Zona::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahHamparan', compact('user', 'zona'));
    }
    public function create($slug)
    {
        $user = Auth::user();
        $zona = Zona::where('slug', $slug)->firstOrFail();
        return view('tambah.TambahHamparan', compact( 'zona'));
    }
    public function store(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'nama_hamparan' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $zona = Zona::where('slug', $slug)->firstOrFail();

            $hamparan = Hamparan::create([
                'zona_id' => $zona->id,
                'nama_hamparan' => $validatedData['nama_hamparan'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'slug' => Str::slug($validatedData['nama_hamparan']),
            ]);

            DB::commit();
            return redirect()->route('hamparan.getHamparan', ['slug' => $slug])->with('success', 'Hamparan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat data: ' . $e->getMessage());
        }
    }
    public function edit($slugZ, $slugH)
    {
        // $user = Auth::user();
        $zona = Zona::where('slug', $slugZ)->firstOrFail();
        $hamparan = Hamparan::where('slug', $slugH)->where('zona_id', $zona->id)->firstOrFail();
        return view('edit.Hamparan', compact( 'zona', 'hamparan'));
    }

    public function update(Request $request, $slugZ, $slugH)
    {
        $validatedData = $request->validate([
            'nama_hamparan' => 'required|string|max:255|unique:hamparan,nama_hamparan,'.$slugH. ',slug',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $zona = Zona::where('slug', $slugZ)->firstOrFail();
            $hamparan = Hamparan::where('slug', $slugH)->where('zona_id', $zona->id)->firstOrFail();

            $hamparan->update([
                'nama_hamparan' => $validatedData['nama_hamparan'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
                'slug' => Str::slug($validatedData['nama_hamparan']),
            ]);

            DB::commit();
            return redirect()->route('hamparan.getHamparan', ['slug' => $slugZ])->with('success', 'Hamparan berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}
