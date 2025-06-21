<?php

namespace Database\Seeders;

use App\Models\LogAbsensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogAbsensi::create (["user_id"=>9,"tanggal"=> '2025-05-05',"nama"=> "Arif Wicaksono","absensi_masuk"=>'2025-06-05 08:30:00',"absensi_keluar"=>'2025-06-05 17:00:00',"istirahat_mulai"=>'2025-06-02 12:31:40',"istirahat_selesai"=>'2025-06-02 13:01:25']);
    }
    
}
