<?php

namespace App\Http\Controllers;

use App\Models\Beadbs;
use App\Models\Zona;
use App\Models\PoltArea;
use App\Models\Hamparan;
use App\Models\Plot;
use App\Models\SubPlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PLotCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $query = Plot::with(['hamparan.zona.poltArea'])->whereNull('plot.deleted_at');
        if (!empty($search)) {
            $query->where('nama_plot', 'ILIKE', "%{$search}%")
                ->orWhere('type_plot', 'ILIKE', "%{$search}%")
                ->orWhereHas('hamparan', function ($q) use ($search) {
                    $q->where('nama_hamparan', 'ILIKE', "%{$search}%");
                })
                ->orWhereHas('hamparan.zona', function ($q) use ($search) {
                    $q->where('zona', 'ILIKE', "%{$search}%");
                })
                ->orWhereHas('hamparan.zona.poltArea', function ($q) use ($search) {
                    $q->where('daerah', 'ILIKE', "%{$search}%");
                });
        }
        $plot = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("dataPlot", compact('user', 'plot', 'search', 'perPage'));
    }
    public function getPlot(Request $request, $id)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $hamparan = Hamparan::findOrFail($id);
        $zona = $hamparan->zona;
        $poltArea = $zona->poltArea;
        $subplot = SubPlot::all();
        // dd($zona, $poltArea, $subplot );
        $query = Plot::query()->whereNull('plot.deleted_at')
            ->where('hamparan_id', $hamparan->id);
        if (!empty($search)) {
            $query->where('nama_plot', 'ILIKE', "%{$search}%")
                ->orWhere('type_plot', 'ILIKE', "%{$search}%");
        }
        $plot = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('show.plot', compact('user', 'plot', 'search', 'perPage', 'hamparan', 'zona', 'poltArea', 'subplot'));
    }
    public function getsubPlot(Request $request, $id)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        // $poltArea = PoltArea::findOrFail($id);
        $subplot = SubPlot::findOrFail($id);
        // dd($subplot);
        $Serasah = DB::table('serasah')
            ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
            ->where('serasah.subplot_id', $subplot->id)
            ->whereNull('serasah.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        // dd( $Serasah);
        $Semai = DB::table('semai')
            ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
            ->where('semai.subplot_id', $subplot->id)
            ->whereNull('semai.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);

        $TumbuhanBawah = DB::table('tumbuhan_bawah')
            ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
            ->where('tumbuhan_bawah.subplot_id', $subplot->id)
            ->whereNull('tumbuhan_bawah.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);

        $pancang = DB::table('pancang')
            ->leftJoin('subplot', 'pancang.subplot_id', '=', 'subplot.id')
            ->where('pancang.subplot_id', $subplot->id)
            ->whereNull('pancang.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $tiang = DB::table('tiang')
            ->leftJoin('subplot', 'tiang.subplot_id', '=', 'subplot.id')
            ->where('tiang.subplot_id', $subplot->id)
            ->whereNull('tiang.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $pohon = DB::table('pohon')
            ->leftJoin('subplot', 'pohon.subplot_id', '=', 'subplot.id')
            ->where('pohon.subplot_id', $subplot->id)
            ->whereNull('pohon.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $Necromas = DB::table('necromass')
            ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
            ->where('necromass.subplot_id', $subplot->id)
            ->whereNull('necromass.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $tanah = DB::table('tanah')
            ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
            ->where('tanah.subplot_id', $subplot->id)
            ->whereNull('tanah.deleted_at')
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('show.DetailPlot', compact(
            'user',
            'perPage',
            'subplot',
            'Serasah',
            'Semai',
            'TumbuhanBawah',
            'Necromas',
            'pancang',
            'tiang',
            'pohon',
            'tanah'
        ));
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
    public function destroy(string $hamparan_id)
    {
        DB::beginTransaction();
        try {
            $tanah = Plot::where('hamparan_id', $hamparan_id)->first();
            // dd($hamparan_id,  Plot::where('hamparan_id', $hamparan_id)->first());
            $tanah->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data tanah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data tanah: ' . $e->getMessage());
        }
    }
}
