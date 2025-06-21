<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use Illuminate\Http\Request;

class HariLiburController extends Controller
{
    public function index()
    {
        $hariliburs = HariLibur::all();
        return view('hari-libur' , ['hariliburs' => $hariliburs]);
    }
    
    public function __construct()
{
    $this->middleware('auth');
}
        public function store(Request $request)
            {
                // Validasi data
                $request->validate([
                    'tanggal' => 'required|date',
                    'keterangan_libur' => 'required|string|max:255',
                ]);

                // Simpan data ke database
                HariLibur::create([     
                    'tanggal' => $request->tanggal,
                    'keterangan_libur' => $request->keterangan_libur,
                ]);

                // Redirect kembali ke halaman daftar hari libur
                return redirect()->back()->with('success', 'Data hari libur berhasil ditambahkan');
            }

            public function update(Request $request, $id_libur)
            {
                $request->validate([
                    'tanggal' => 'required|date',
                    'keterangan_libur' => 'required|string|max:255',
                ]);
            
                // Cari berdasarkan id_libur
                $harilibur = HariLibur::findOrFail($id_libur);
                $harilibur->update([
                    'tanggal' => $request->tanggal,
                    'keterangan_libur' => $request->keterangan_libur,
                ]);
            
                return redirect()->back()->with('success', 'Data hari libur berhasil diubah');
            }

            public function destroy($id_libur)
{
    $harilibur = HariLibur::findOrFail($id_libur);
    $harilibur->delete();

    return redirect()->back()->with('success', 'Data hari libur berhasil dihapus');}

            

    }

