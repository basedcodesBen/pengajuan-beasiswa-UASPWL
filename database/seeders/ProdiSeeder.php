<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insert([
            'id_prodi' => '72',
            'nama_prodi' => 'Teknik Informatika',
            'id_fakultas' => '7'
        ]);
    }
}
