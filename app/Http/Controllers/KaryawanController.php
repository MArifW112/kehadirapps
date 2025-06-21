<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



class KaryawanController extends Controller
{

    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan', ['karyawans' => $karyawans]);
    }
    public function getKaryawanByEmail(Request $request)
    {
        $email = $request->input('email');
        
        $karyawan = Karyawan::where('email', $email)->first();
    
        if ($karyawan) {
            return response()->json($karyawan);
        } else {
            return response()->json(['message' => 'Karyawan tidak ditemukan'], 404);
        }
    }

        // Menampilkan form tambah data
        public function create()
        {
            return view('karyawan.create');
        }
    
        // Menyimpan data karyawan
        public function store(Request $request)
        {   
            $validated = $request->validate([
                'nama_karyawan' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'no_hp' => 'required|string|max:15',
                'jabatan' => 'required|string|max:100',
                'password' => 'required|string|min:8',
            ]);
    
            // Cek apakah email sudah ada di tabel users
            $user = User::where('email', $validated['email'])->first();
    
            if ($user) {
                // Jika user sudah ada, gunakan user_id dari user tersebut
                // Cek apakah karyawan dengan email yang sama sudah ada
                $karyawan = Karyawan::where('email', $validated['email'])->first();
    
                if ($karyawan) {
                    // Jika karyawan sudah ada, berikan pesan
                    return redirect()->route('karyawan.index')->with('error', 'Karyawan dengan email ini sudah terdaftar.');
                } else {
                    // Jika karyawan belum ada, buat data karyawan baru dengan user_id yang ada
                    Karyawan::create([
                        'user_id' => $user->id,  // Gunakan user_id yang sudah ada
                        'nama_karyawan' => $validated['nama_karyawan'],
                        'alamat' => $validated['alamat'],
                        'email' => $validated['email'],
                        'no_hp' => $validated['no_hp'],
                        'jabatan' => $validated['jabatan'],
                    ]);
                    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan dengan user yang sudah ada.');
                }
            } else {
                // Jika user belum ada, buat user baru dan password sesuai input
                $user = User::create([
                    'name' => $validated['nama_karyawan'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']), // Gunakan password dari input pengguna yang terenkripsi
                ]);
    
                // Buat data karyawan baru dengan user_id yang baru
                Karyawan::create([
                    'user_id' => $user->id,  // Menetapkan user_id sesuai dengan user yang baru dibuat
                    'nama_karyawan' => $validated['nama_karyawan'],
                    'alamat' => $validated['alamat'],
                    'email' => $validated['email'],
                    'no_hp' => $validated['no_hp'],
                    'jabatan' => $validated['jabatan'],
                ]);
    
                return redirect()->route('karyawan.index')->with('success', 'Data karyawan dan user baru berhasil ditambahkan.');
            }
            dd($validated);
        }

        public function update(Request $request, $user_id)
        {
            Log::info('Request received for user_id:', ['user_id' => $user_id]);
            Log::info('Request data:', $request->all());
        
            $request->validate([
                'nama_karyawan' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'no_hp' => 'required|string|max:15',
                'jabatan' => 'required|string|max:100',
            ]);
        
            // Cari data karyawan berdasarkan user_id
            $karyawan = Karyawan::where('user_id', $user_id)->first();
        
            if (!$karyawan) {
                Log::error('Data Karyawan tidak ditemukan untuk user_id:', ['user_id' => $user_id]);
                return redirect()->back()->with('error', 'Data Karyawan tidak ditemukan.');
            }
        
            Log::info('Karyawan found:', $karyawan->toArray());
        
            // Perbarui data karyawan
            $karyawan->update([
                'nama_karyawan' => $request->nama_karyawan,
                'jabatan' => $request->jabatan,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);
        
            Log::info('Karyawan updated:', $karyawan->toArray());
        
            // Perbarui data user terkait
            if ($karyawan->user) {
                $karyawan->user->update([
                    'name' => $request->nama_karyawan,
                    'email' => $request->email,
                ]);
        
                Log::info('User updated:', $karyawan->user->toArray());
            }
        
            return redirect()->back()->with('success', 'Data Karyawan dan User berhasil diubah');
        }


    public function updateKaryawan(Request $request, $user_id)
    {

        Log::info(' Mobile Request received for user_id:', ['user_id' => $user_id]);
        Log::info('Mobile Request data:', $request->all());

        Log::info('Validation Start');

        
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'jabatan' => 'required|string|max:100',
        ]);

        Log::info('Validation passed');

        $karyawan = Karyawan::where('user_id', $user_id)->first();

        if (!$karyawan) {
            return response()->json(['message' => 'Data karyawan tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        // Update data karyawan
        $karyawan->nama_karyawan = $validatedData['nama_karyawan'];
        $karyawan->jabatan = $validatedData['jabatan'] ?? $karyawan->jabatan;
        $karyawan->alamat = $validatedData['alamat'] ?? $karyawan->alamat;
        $karyawan->email = $validatedData['email'];
        $karyawan->no_hp = $validatedData['no_hp'] ?? $karyawan->no_hp;

        $karyawan->save();

        if ($karyawan->user) {
            $karyawan->user->update([
                'name' => $validatedData['nama_karyawan'],  // Update nama
                'email' => $validatedData['email'],        // Update email
            ]);}

            
        return response()->json([
            'message' => 'Data karyawan berhasil diperbarui',
            'data' => $karyawan,
        ], Response::HTTP_OK);
    }

public function destroy($user_id)
{
    // Temukan karyawan berdasarkan user_id
    $karyawan = Karyawan::where('user_id', $user_id)->first();

    if ($karyawan) {
        // Hapus data karyawan
        $karyawan->delete();
        return redirect()->back()->with('success', 'Data Karyawan Berhasil Di Hapus');
    } else {
        return redirect()->back()->with('success', 'Data Karyawan Gagal Di Hapus');
    }
}

    
}

