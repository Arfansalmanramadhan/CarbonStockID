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
        $perPage = $request->query('per_page',);
        $query = Plot::with(['hamparan.zona.poltArea'])->where('status', '=', 'aktif');
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
        $perPage = $request->query('per_page',);
        $hamparan = Hamparan::find($id);
        $zona = $hamparan->zona;
        $poltArea = $zona->poltArea;
        $subplot = SubPlot::all();
        // // dd($zona, $poltArea, $subplot );
        // $query = Plot::query()
        //     ->where('hamparan_id', $hamparan->id);
        $query = Plot::with(['hamparan.zona.poltArea'])->where("hamparan_id", $hamparan->id)->where('status', '=', 'aktif');
        // ->where('hamparan_id', $hamparan->id);
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
        $perPage = $request->query('per_page',);
        // $poltArea = PoltArea::findOrFail($id);

        $subplot = SubPlot::findOrFail($id);
        $plot = $subplot->plot;
        // dd($plot);
        $hamparan = $plot->hamparan;
        $zona = $hamparan->zona;
        $poltArea = $zona->poltArea;
        // dd($subplot);
        $Serasah = DB::table('serasah')
            ->leftJoin('subplot', 'serasah.subplot_id', '=', 'subplot.id')
            ->where('serasah.subplot_id', $subplot->id)
            ->select(
                'serasah.id as id',
                'serasah.total_berat_basah as total_berat_basah',
                'serasah.sample_berat_basah as sample_berat_basah',
                'serasah.sample_berat_kering as sample_berat_kering',
                'serasah.total_berat_kering as total_berat_kering',
                'serasah.kandungan_karbon as kandungan_karbon',
                'serasah.co2 as co2',

            )
            ->get();
        // ->whereNull('serasah.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
        // dd( $Serasah);
        $Semai = DB::table('semai')
            ->leftJoin('subplot', 'semai.subplot_id', '=', 'subplot.id')
            ->where('semai.subplot_id', $subplot->id)
            ->select(
                'semai.id as id',
                'semai.total_berat_basah as total_berat_basah',
                'semai.sample_berat_basah as sample_berat_basah',
                'semai.sample_berat_kering as sample_berat_kering',
                'semai.total_berat_kering as total_berat_kering',
                'semai.kandungan_karbon as kandungan_karbon',
                'semai.co2 as co2',

            )
            ->get();
        // ->whereNull('semai.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);

        $TumbuhanBawah = DB::table('tumbuhan_bawah')
            ->leftJoin('subplot', 'tumbuhan_bawah.subplot_id', '=', 'subplot.id')
            ->where('tumbuhan_bawah.subplot_id', $subplot->id)
            ->select(
                'tumbuhan_bawah.id as id',
                'tumbuhan_bawah.total_berat_basah as total_berat_basah',
                'tumbuhan_bawah.sample_berat_basah as sample_berat_basah',
                'tumbuhan_bawah.sample_berat_kering as sample_berat_kering',
                'tumbuhan_bawah.total_berat_kering as total_berat_kering',
                'tumbuhan_bawah.kandungan_karbon as kandungan_karbon',
                'tumbuhan_bawah.co2 as co2',

            )
            ->get();
        // ->whereNull('tumbuhan_bawah.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);

        $pancang = DB::table('pancang')
            ->leftJoin('subplot', 'pancang.subplot_id', '=', 'subplot.id')
            ->where('pancang.subplot_id', $subplot->id)
            ->select(
                'pancang.id as id',
                'pancang.no_pohon as no_pohon',
                'pancang.keliling as keliling',
                'pancang.diameter as diameter',
                'pancang.nama_lokal as nama_lokal',
                'pancang.nama_ilmiah as nama_ilmiah',
                'pancang.kerapatan_jenis_kayu as kerapatan_jenis_kayu',
                'pancang.bio_di_atas_tanah as bio_di_atas_tanah',
                'pancang.kandungan_karbon as kandungan_karbon',
                'pancang.co2 as co2',

            )
            ->get();
        // ->whereNull('pancang.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
        $tiang = DB::table('tiang')
            ->leftJoin('subplot', 'tiang.subplot_id', '=', 'subplot.id')
            ->where('tiang.subplot_id', $subplot->id)
            ->select(
                'tiang.id as id',
                'tiang.no_pohon as no_pohon',
                'tiang.keliling as keliling',
                'tiang.diameter as diameter',
                'tiang.nama_lokal as nama_lokal',
                'tiang.nama_ilmiah as nama_ilmiah',
                'tiang.kerapatan_jenis_kayu as kerapatan_jenis_kayu',
                'tiang.bio_di_atas_tanah as bio_di_atas_tanah',
                'tiang.kandungan_karbon as kandungan_karbon',
                'tiang.co2 as co2',

            )
            ->get();
        // ->whereNull('tiang.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
        $pohon = DB::table('pohon')
            ->leftJoin('subplot', 'pohon.subplot_id', '=', 'subplot.id')
            ->where('pohon.subplot_id', $subplot->id)
            ->select(
                'pohon.id as id',
                'pohon.no_pohon as no_pohon',
                'pohon.keliling as keliling',
                'pohon.diameter as diameter',
                'pohon.nama_lokal as nama_lokal',
                'pohon.nama_ilmiah as nama_ilmiah',
                'pohon.kerapatan_jenis_kayu as kerapatan_jenis_kayu',
                'pohon.bio_di_atas_tanah as bio_di_atas_tanah',
                'pohon.kandungan_karbon as kandungan_karbon',
                'pohon.co2 as co2',

            )
            ->get();
        // ->whereNull('pohon.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
        $Necromas = DB::table('necromass')
            ->leftJoin('subplot', 'necromass.subplot_id', '=', 'subplot.id')
            ->where('necromass.subplot_id', $subplot->id)
            ->select(
                'necromass.id as id',
                'necromass.diameter_pangkal as diameter_pangkal',
                'necromass.diameter_ujung as diameter_ujung',
                'necromass.panjang as panjang',
                'necromass.volume as volume',
                'necromass.berat_jenis_kayu as berat_jenis_kayu',
                'necromass.biomasa as biomasa',
                'necromass.carbon as carbon',
                'necromass.co2 as co2',

            )
            ->get();
        // ->whereNull('necromass.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
        $tanah = DB::table('tanah')
            ->leftJoin('subplot', 'tanah.subplot_id', '=', 'subplot.id')
            ->where('tanah.subplot_id', $subplot->id)
            ->select(
                'tanah.id as id',
                'tanah.kedalaman_sample as kedalaman_sample',
                'tanah.berat_jenis_tanah as berat_jenis_tanah',
                'tanah.C_organic_tanah as C_organic_tanah',
                'tanah.carbongr as carbongr',
                'tanah.carbonton as carbonton',
                'tanah.carbonkg as carbonkg',
                'tanah.co2kg as co2kg',

            )
            ->get();
        // ->whereNull('tanah.deleted_at')
        // ->paginate($perPage)
        // ->appends(['per_page' => $perPage]);
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
            'tanah',
            'poltArea'
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
        DB::beginTransaction();
        try {
            $plot = Plot::findOrFail($id);
            // dd($hamparan_id,  Plot::where('hamparan_id', $hamparan_id)->first());
            $plot->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data tanah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data tanah: ' . $e->getMessage());
        }
    }
}
