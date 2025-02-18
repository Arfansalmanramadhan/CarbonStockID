<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SUrveyorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("Surveyor", compact('user'));
    }
}
