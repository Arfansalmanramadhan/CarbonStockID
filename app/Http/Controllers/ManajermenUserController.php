<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PoltArea;
use App\Models\SubPlot;

class ManajermenUserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view("Verifikasi",compact('user'));
    }
    public function view(){
        $lokasi = SubPlot::where('status', 'tidakaktif')->get();
        return view("Verifikasi",compact('lokasi'));
    }
    // public function menyetuju
}
