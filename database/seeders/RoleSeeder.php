<?php

namespace Database\Seeders;  // Sesuaikan dengan struktur folder

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;  // Pastikan ini di-import

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'  // Guard default
        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web'  // Guard default
        ]);
    }
}
