<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAbsensi;
use App\Models\PengajuanIzin;
use App\Models\HariLibur;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hadirCount = LogAbsensi::whereNotNull('absensi_masuk')->count();
        $pCount = PengajuanIzin::whereNotNull('nama')->count();
        $liburCount = HariLibur::whereNotNull('tanggal')->count();
        return view('dashboard', ['hadirCount' => $hadirCount,'pCount' => $pCount, 'liburCount' => $liburCount]);
    }
}
