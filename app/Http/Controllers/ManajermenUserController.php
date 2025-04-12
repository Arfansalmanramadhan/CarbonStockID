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
        // $query = Plot::query();
        $query = Plot::where('status', '=', null);
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
    public function menyetujui($id)
    {
        $plot = Plot::findOrFail($id);

        $plot->status = 'aktif';
        $plot->save();

        return redirect()->back()->with("status", "Menyetujui pengguna sukses");;
    }
}
