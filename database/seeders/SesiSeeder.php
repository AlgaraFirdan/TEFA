<?php

namespace Database\Seeders;

use App\Models\Sesi;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    public function run(): void
    {
        $sesis = [
            ['nama' => 'Sesi 1', 'jam_mulai' => '07:00:00', 'jam_selesai' => '08:30:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat 1', 'jam_mulai' => '08:30:00', 'jam_selesai' => '08:45:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 2', 'jam_mulai' => '08:45:00', 'jam_selesai' => '10:15:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat 2', 'jam_mulai' => '10:15:00', 'jam_selesai' => '10:30:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 3', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:00:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat Siang', 'jam_mulai' => '12:00:00', 'jam_selesai' => '13:00:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 4', 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:30:00', 'is_istirahat' => false],
            ['nama' => 'Istirahat 3', 'jam_mulai' => '14:30:00', 'jam_selesai' => '14:45:00', 'is_istirahat' => true],
            ['nama' => 'Sesi 5', 'jam_mulai' => '14:45:00', 'jam_selesai' => '16:15:00', 'is_istirahat' => false],
        ];

        foreach ($sesis as $sesi) {
            Sesi::create($sesi);
        }
    }
}
