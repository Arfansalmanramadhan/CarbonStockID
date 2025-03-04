<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoltArea;
use Illuminate\Support\Facades\Auth;

class DataPlotController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("dataPlot", compact('user'));
    }
    public function Lokasi(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5); // Default 5 item per halaman

        $query = PoltArea::query();

        if (!empty($search)) {
            $query->where('daerah', 'ILIKE', "%{$search}%")
                ->orWhere('jenis_hutan', 'ILIKE', "%{$search}%")
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
    // public function data(Request $request)
    // {
    //     $search = $request->query('search');
    //     $perPage = $request->query('perPage', 5); // Default 5 item per halaman

    //     $query = PoltArea::query();

    //     if (!empty($search)) {
    //         $query->where('daerah', 'ILIKE', "%{$search}%")
    //               ->orWhere('status', 'ILIKE', "%{$search}%");
    //     }

    //     $lokasi = $query->paginate($perPage);

    //     return view('Lokasi', compact('lokasi'));
    // }
}
