<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampahController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view("Sampah",compact('user'));
    }
}
