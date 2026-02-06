<?php

namespace Database\Seeders;

use App\Models\Sesi;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    public function run(): void
    {
        // Sesi sesuai gambar Information Lab
        $sesis = [
            ['nama' => 'Sesi 1', 'jam_mulai' => '07:15:00', 'jam_selesai' => '07:55:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 2', 'jam_mulai' => '07:55:00', 'jam_selesai' => '08:35:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 3', 'jam_mulai' => '08:35:00', 'jam_selesai' => '09:15:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat 1', 'jam_mulai' => '09:15:00', 'jam_selesai' => '09:30:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 4', 'jam_mulai' => '09:30:00', 'jam_selesai' => '10:10:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 5', 'jam_mulai' => '10:10:00', 'jam_selesai' => '10:50:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 6', 'jam_mulai' => '10:50:00', 'jam_selesai' => '11:30:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 7', 'jam_mulai' => '11:30:00', 'jam_selesai' => '12:10:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat 2', 'jam_mulai' => '12:10:00', 'jam_selesai' => '13:00:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 8', 'jam_mulai' => '13:00:00', 'jam_selesai' => '13:40:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 9', 'jam_mulai' => '13:40:00', 'jam_selesai' => '14:20:00', 'is_istirahat' => false],
            ['nama' => 'Sesi 10', 'jam_mulai' => '14:20:00', 'jam_selesai' => '15:00:00', 'is_istirahat' => false],
        ];

        foreach ($sesis as $sesi) {
            Sesi::create($sesi);
        }
    }
}
