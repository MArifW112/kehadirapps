<?php

namespace Database\Seeders;

use App\Models\HariLibur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HariLiburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HariLibur::create (["id_libur"=>1,"tanggal"=>'2025-01-01',"keterangan_libur"=>"Hari Kartini"]);
    }
}
