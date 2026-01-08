<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntellatualController extends Controller
{
    public function index(){
        return view('home.index');
    }
}
