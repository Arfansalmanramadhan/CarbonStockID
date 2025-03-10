<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use Illuminate\Http\Request;
use App\Models\PoltArea;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;

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

        $query = PoltArea::query();

        if (!empty($search)) {
            $query->where('daerah', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%");
        }

        // $lokasi = $query->paginate($perPage);

        /// Ambil data dengan pagination
        $lokasi = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("Lokasi", compact('user', 'lokasi', 'search', 'perPage'));
    }

}
