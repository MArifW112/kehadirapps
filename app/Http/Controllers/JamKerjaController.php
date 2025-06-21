<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JamKerjaController extends Controller
{
    public function index()
    {
        return view('jam-kerja');
    }
    
    public function __construct()
{
    $this->middleware('auth');
}
}
