<?php

namespace App\Http\Controllers;

use App\Models\LogAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogAbsensiController extends Controller
{
    public function index()
{
    $absensis = LogAbsensi::all();
    return view('laporan-absensi', ['absensis' => $absensis]);
}
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function absensiMasuk(Request $request)
    {
        Log::info('Method absensi Masuk berhasil dipanggil.');

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'absensi_masuk' => 'required|date_format:Y-m-d H:i:s',
        ]);
        
        Log::info('Validasi berhasil dilewati.');

        try {
            // Simpan data ke tabel log_absensis
            $absensi = LogAbsensi::create([
                'user_id' => $validatedData['user_id'],
                'nama' => $validatedData['nama'],
                'tanggal' => $validatedData['tanggal'],
                'absensi_masuk' => $validatedData['absensi_masuk'],
            ]);

            Log::info('Data absen masuk berhasil disimpan:', $absensi->toArray());

            return response()->json([
                'message' => 'Absen masuk berhasil dicatat.',
                'data' => $absensi,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Gagal mencatat absen masuk:', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Gagal mencatat absen masuk.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

public function absenPulang(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'tanggal' => 'required|date',
        'absensi_keluar' => 'required|date_format:Y-m-d H:i:s',

    ]);

    $absensi = LogAbsensi::where('user_id', $request->user_id)
        ->where('tanggal', $request->tanggal)
        ->first();

    if (!$absensi) {
        return response()->json(['message' => 'Data absen tidak ditemukan.'], 404);
    }

    $absensi->update([
        'absensi_keluar' => $request['absensi_keluar'],
    ]);

    return response()->json(['message' => 'Absen pulang berhasil!', 'data' => $absensi], 200);
}

// Fungsi untuk Absen Istirahat
public function absenIstirahat(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'tanggal' => 'required|date',
        'istirahat_mulai' => 'required|date_format:Y-m-d H:i:s',
    ]);

    $absensi = LogAbsensi::where('user_id', $request->user_id)
        ->where('tanggal', $request->tanggal)
        ->first();

    if (!$absensi) {
        return response()->json(['message' => 'Data absen tidak ditemukan.'], 404);
    }

    $absensi->update([
        'istirahat_mulai' => $request['istirahat_mulai'],
    ]);

    return response()->json(['message' => 'Absen istirahat berhasil!', 'data' => $absensi], 200);
}

// Fungsi untuk Absen Selesai Istirahat
public function absenIstirahatSelesai(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'tanggal' => 'required|date',
        'istirahat_selesai' => 'required|date_format:Y-m-d H:i:s',
    ]);

    $absensi = LogAbsensi::where('user_id', $request->user_id)
        ->where('tanggal', $request->tanggal)
        ->first();

    if (!$absensi) {
        return response()->json(['message' => 'Data absen tidak ditemukan.'], 404);
    }

    $absensi->update([
        'istirahat_selesai' => $request['istirahat_selesai'],
    ]);

    return response()->json(['message' => 'Absen selesai istirahat berhasil!', 'data' => $absensi], 200);
}


    public function getAbsensi(Request $request)
    {
        $userId = $request->user()->id; // Ambil user ID dari pengguna yang sedang login
        $absensis = LogAbsensi::where('user_id', $userId)->get();

        return response()->json($absensis, 200);
    }
}


