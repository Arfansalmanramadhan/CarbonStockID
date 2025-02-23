<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HamparanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $zona = Zona::where('polt-area_id', $user->id );
        return view('Hamparan', compact('user'));
    }
}
