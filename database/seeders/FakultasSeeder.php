<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fakultas')->insert([
            'id_fakultas' => '7',
            'nama_fakultas' => 'Teknologi Informasi'
        ]);
    }
}
