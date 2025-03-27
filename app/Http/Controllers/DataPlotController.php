<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\PlotAreaTim;
use Illuminate\Http\Request;
use App\Models\PoltArea;
use App\Models\Tim;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataPlotController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $query = Plot::where('status', '=', 'aktif');
        if (!empty($search)) {
            $query->where('nama_plot', 'ILIKE', "%{$search}%")
                ->orWhere('type_plot', 'ILIKE', "%{$search}%");
        }
        $lokasi = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("dataPlot", compact('user', 'lokasi', 'search', 'perPage'));
    }
    public function Lokasi(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5); // Default 5 item per halaman

        $query = PoltArea::withCount('PlotAreaTim');

        if (!empty($search)) {
            $query->where('daerah', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        $query->orderByDesc('plot_area_tim_count');

        /// Ambil data dengan pagination
        $lokasi = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("Lokasi", compact('user', 'lokasi', 'search', 'perPage'));
    }
    public function create($id)
    {
        $user = Auth::user();
        $lokasi = PoltArea::findOrFail($id);
        $tim =  Tim::all();
        $anggota = DB::table('polt_area_tim')
            ->leftJoin('tim', 'polt_area_tim.tim_id', '=', 'tim.id')  // Perbaikan
            ->leftJoin('polt_area', 'polt_area_tim.polt_area_id', '=', 'polt_area.id')  // Perbaikan
            ->select(
                'tim.nama as tim',
                'polt_area.daerah as lokasi',
                DB::raw("COALESCE(polt_area.daerah, 'Belum ada anggota') as nama_lokasi")
            )
            ->where('polt_area_tim.polt_area_id', $id)
            ->get();
        // dd($anggota);
        return view('Tim', compact('lokasi', 'tim', 'anggota', 'user'));
    }
    public function storee(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tim_id' => 'required|exists:tim,id',
        ]);

        DB::beginTransaction();
        try {
            // Cek apakah user sudah menjadi anggota tim
            $existingMember = PlotAreaTim::where('polt_area_id', $id)
                ->where('tim_id', $validatedData['tim_id'])
                ->exists();

            if ($existingMember) {
                return redirect()->back()->with('success', 'User sudah menjadi anggota tim.');
            }
            // dd($id)  ;
            // Tambahkan anggota tim
            PlotAreaTim::create([
                'tim_id' =>  $validatedData['tim_id'],
                'polt_area_id' => (int) $id,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Anggota tim berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambah anggota: ' . $e->getMessage());
        }
    }
}
