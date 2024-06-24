<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name' => 'Admin User',
                'nrp' => 'admin001',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Replace 'password' with the desired password
                'role' => 'admin',
                'aktif'=> true,
                'created_at' => now(),
                'updated_at' => now(),],
            ['name' => 'Mahasiswa',
                'nrp' => '2272003',
                'email' => 'user@example.com',
                'password' => Hash::make('password'), // Replace 'password' with the desired password
                'role' => 'mahasiswa',
                'aktif'=> true,
                'created_at' => now(),
                'updated_at' => now(),],
            ['name' => 'Mahasiswa',
                'nrp' => '2272002',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'), // Replace 'password' with the desired password
                'role' => 'mahasiswa',
                'aktif'=> false,
                'created_at' => now(),
                'updated_at' => now(),]
        ];
        DB::table('users')->insert($users);
    }
}
