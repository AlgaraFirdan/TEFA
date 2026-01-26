<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            // Lab 1 - Senin
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 1, 'guru_id' => 1, 'mapel_id' => 1],
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 3, 'guru_id' => 1, 'mapel_id' => 1],
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 5, 'guru_id' => 2, 'mapel_id' => 2],
            
            // Lab 1 - Selasa
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 1, 'guru_id' => 3, 'mapel_id' => 3],
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 3, 'guru_id' => 4, 'mapel_id' => 4],
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 7, 'guru_id' => 5, 'mapel_id' => 5],
            
            // Lab 2 - Senin
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 1, 'guru_id' => 2, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 3, 'guru_id' => 3, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 7, 'guru_id' => 6, 'mapel_id' => 6],
            
            // Lab 2 - Selasa
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 1, 'guru_id' => 4, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 3, 'guru_id' => 5, 'mapel_id' => 5],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 5, 'guru_id' => 1, 'mapel_id' => 1],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
