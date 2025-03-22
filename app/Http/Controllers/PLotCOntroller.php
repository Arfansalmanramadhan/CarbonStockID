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
        $query = Plot::query();
        if (!empty($search)) {
            $query->where('zona', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
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
        $zona = Zona::findOrFail($id);
        $poltArea = PoltArea::findOrFail($id);
        $query = Plot::query()
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
        return view('show.plot', compact('user', 'plot', 'search', 'perPage', 'hamparan', 'zona', 'poltArea'));
    }
    public function getsubPlot(Request $request, $id)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        // $poltArea = PoltArea::findOrFail($id);
        $plot = SubPlot::find($id);
        $Serasah = DB::table('serasah')
            ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        // dd( $Serasah);
        $Semai = DB::table('semai')
            ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);

        $TumbuhanBawah = DB::table('tumbuhan_bawah')
            ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);

        $pancang = DB::table('pancang')
            ->leftJoin('subplot', 'pancang.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $tiang = DB::table('tiang')
            ->leftJoin('subplot', 'tiang.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $pohon = DB::table('pohon')
            ->leftJoin('subplot', 'pohon.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $Necromas = DB::table('necromass')
            ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        $tanah = DB::table('tanah')
            ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
            ->where('subplot.plot_id', $plot)
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('show.DetailPlot', compact(
            'user',
            'perPage',
            'plot',
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
    public function destroy(string $id)
    {
        //
    }
}
