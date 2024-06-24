<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class beasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beasiswa = [
            ['jenis_beasiswa' => 'Beasiswa Akademik',
                'created_at' => now(),
                'updated_at' => now(),],
            ['jenis_beasiswa' => 'Beasiswa NonAkademik',
                'created_at' => now(),
                'updated_at' => now(),]
        ];
        $periode = [
            ['id_beasiswa' => 1,
                'tahun_ajaran' => now()->format('Y'),
                'triwulan' => 'genap',
                'start_date' => Carbon::parse('2024-06-10'),
                'end_date' => Carbon::parse('2024-07-10'),
                'created_at' => now(),
                'updated_at' => now(),],
            ['id_beasiswa' => 2,
                'tahun_ajaran' => now()->format('Y'),
                'triwulan' => 'genap',
                'start_date' => Carbon::parse('2024-06-10'),
                'end_date' => Carbon::parse('2024-07-10'),
                'created_at' => now(),
                'updated_at' => now(),]
        ];
        DB::table('beasiswa')->insert($beasiswa);
        DB::table('periode_beasiswa')->insert($periode);
    }
}
