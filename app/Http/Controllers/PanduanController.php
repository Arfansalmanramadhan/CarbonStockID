<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Pohon;
// use App\Models\Semai;
// use App\Models\Tanah;
// use App\Models\Tiang;
// use App\Models\Pancang;
// use App\Models\Profil;
// use App\Models\Serasah;
// use App\Models\PoltArea;
// use App\Models\Necromass;
// use App\Models\TumbuhanBawah;
use Illuminate\Support\Facades\Auth;

class PanduanController extends Controller
{
    public function index() {
        $user = Auth::user();
        // $profil = Profil::where('id', $user->id)->first();
        // $poltArea = PoltArea::where('profil_id', $profil->id)->first();
        // $serasah = Serasah::where('polt-area_id', $poltArea->id)->first();
        // $semai = Semai::where('polt-area_id', $poltArea->id)->first();
        // $tanah = Tanah::where('polt-area_id', $poltArea->id)->first();
        // $tumbuhanbawah = TumbuhanBawah::where('polt-area_id', $poltArea->id)->first();
        // $pohon = Pohon::where('polt-area_id', $poltArea->id)->first();
        // $pancang = Pancang::where('polt-area_id', $poltArea->id)->first();
        // $tiang = Tiang::where('polt-area_id', $poltArea->id)->first();
        // $nekromas = Necromass::where('polt-area_id', $poltArea->id)->first();
        // return view('panduan',compact('user', 'profil', 'poltArea', 'serasah', 'semai', 'tanah', 'pancang', 'tiang', 'nekromas', 'pohon', 'tumbuhanbawah'));
        return view('panduan', compact('user'));
    }
}
