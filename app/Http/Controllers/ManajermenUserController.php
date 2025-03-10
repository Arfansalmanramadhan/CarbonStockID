<?php

namespace App\Http\Controllers;

use App\Models\Beadbs;
use App\Models\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PoltArea;
use App\Models\SubPlot;

class ManajermenUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("Verifikasi", compact('user'));
    }
    public function view(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $query = Plot::where('status', '=', 'tidakaktif');
        if (!empty($search)) {
            $query->where('nama_plot', 'ILIKE', "%{$search}%")
                ->orWhere('type_plot', 'ILIKE', "%{$search}%");
        }
        $plot = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("Verifikasi", compact('user', 'plot', 'search', 'perPage'));
    }
    public function menyetujui($slug)
    {
        $Plot = Plot::where('slug', $slug)->first();
        if (!$Plot) {
            return redirect()->back()->with("error", "Data plot tslugak ditemukan");
        }

        $Plot->status = 'aktif';
        $Plot->save();
        return redirect("veri/" . $slug)->with("status", "Menetujui perngguna sukses");
    }
    public function getPlopt(Request $request, $slug)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $perPage = $request->query('per_page', 5);
        $beadbs = Beadbs::where('slug', $slug)->first();
        $query = Plot::where('status', '=', 'tidakaktif');
        if (!empty($search)) {
            $query->where('nama_plot', 'ILIKE', "%{$search}%")
                ->orWhere('type_plot', 'ILIKE', "%{$search}%");
        }
        $plot = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage
        ]);
        return view("show.plot", compact('user', 'plot', 'search', 'perPage', 'beadbs'));
    }
}
