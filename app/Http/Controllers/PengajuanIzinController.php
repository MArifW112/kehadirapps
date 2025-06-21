<?php

namespace App\Http\Controllers;

use App\Models\PengajuanIzin;
use Illuminate\Http\Request;

class PengajuanIzinController extends Controller
{
    public function index()
    {
        $pengajuanIzin = PengajuanIzin::all();
        return view('pengajuan.index', ['pengajuanIzin' => $pengajuanIzin]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'tanggal' => 'required|date',
            'tipe_izin' => 'required|string',
            'alasan_izin' => 'nullable|string',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            // Simpan gambar di folder 'lampiran' di storage dan simpan pathnya
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
        }

        // Membuat data pengajuan izin dengan path gambar
        PengajuanIzin::create([
            'user_id' => $validated['user_id'],
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'tanggal' => $validated['tanggal'],
            'tipe_izin' => $validated['tipe_izin'],
            'alasan_izin' => $validated['alasan_izin'],
            'lampiran' => $lampiranPath,
        ]);

        return response()->json(['message' => 'Pengajuan izin berhasil disimpan.'], 200);
    }

    public function getPengajuan(Request $request)
    {
        $userId = $request->user()->id;
        $pengajuanIzin = PengajuanIzin::where('user_id', $userId)->get();

        return response()->json($pengajuanIzin, 200);
    }
}
