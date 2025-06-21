<?php

namespace Database\Seeders;

use App\Models\PengajuanIzin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajuanIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PengajuanIzin::create (["id_pengajuan"=>1,"nama"=>"Revan","tipe_izin"=>"S","jabatan"=>"Magang","tanggal"=>'2025-03-03',"alasan_izin"=>"Sakit Demam","lampiran"=>"foto.png"]);
    }
}
