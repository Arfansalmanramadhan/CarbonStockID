<?php

namespace App\Http\Controllers;

use App\Models\Pancang;
use Illuminate\Http\Request;

class PancangContrller extends Controller
{
    public function index() {
        $pancang= Pancang::get();
        return
    }
}
