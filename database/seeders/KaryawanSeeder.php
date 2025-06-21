<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Karyawan::create (["user_id"=>1,"nama_karyawan"=>"Muhammad Revan Hakim","alamat"=>"Cirebon","no_hp"=>"08123456789","jabatan"=>"Magang"]);
    }
}
