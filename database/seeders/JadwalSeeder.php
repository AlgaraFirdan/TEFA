<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Sesi;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping session_number to sesi_id based on time
        // Session 1: 07:15-07:55 (sesi_id=1)
        // Session 2: 07:55-08:35 (sesi_id=2)
        // Session 3: 08:35-09:15 (sesi_id=3)
        // ISHT 1: 09:15-09:30 (sesi_id=4 - istirahat)
        // Session 4: 09:30-10:10 (sesi_id=5)
        // Session 5: 10:10-10:50 (sesi_id=6)
        // Session 6: 10:50-11:30 (sesi_id=7)
        // Session 7: 11:30-12:10 (sesi_id=8)
        // ISHT 2: 12:10-13:00 (sesi_id=9 - istirahat)
        // Session 8: 13:00-13:40 (sesi_id=10)
        // Session 9: 13:40-14:20 (sesi_id=11)
        // Session 10: 14:20-15:00 (sesi_id=12)

        // Mapping dari session_number ke sesi_id (skip istirahat)
        $sessionToSesiMap = [
            1 => 1,   // 07:15-07:55
            2 => 2,   // 07:55-08:35
            3 => 3,   // 08:35-09:15
            4 => 5,   // 09:30-10:10 (skip ISHT 1)
            5 => 6,   // 10:10-10:50
            6 => 7,   // 10:50-11:30
            7 => 8,   // 11:30-12:10
            8 => 10,  // 13:00-13:40 (skip ISHT 2)
            9 => 11,  // 13:40-14:20
            10 => 12, // 14:20-15:00
        ];

        // Mapping hari
        $hariMap = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7,
        ];

        // Lab 1 mapping: lab_id 1 in SQL = ruangan_id 1
        // Lab 2 mapping: lab_id 3 in SQL = ruangan_id 2 (based on insert order)
        // Lab 3 mapping: lab_id 4 in SQL = ruangan_id 3
        // Lab 4 mapping: lab_id 5 in SQL = ruangan_id 4
        // Lab 5 mapping: lab_id 6 in SQL = ruangan_id 5
        // Lab TBS mapping: lab_id 7 in SQL = ruangan_id 6
        $labMap = [
            1 => 1,
            3 => 2,
            4 => 3,
            5 => 4,
            6 => 5,
            7 => 6,
        ];

        // Data jadwal dari SQL - LAB 1
        $jadwals = [
            // Lab 1 - Senin
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 1, 'guru_id' => 1, 'mapel_id' => 1],  // PST - Nurhanan
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 2, 'guru_id' => 1, 'mapel_id' => 1],  // PST - Nurhanan
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 3, 'guru_id' => 2, 'mapel_id' => 2],  // Inggris - Zian
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 5, 'guru_id' => 2, 'mapel_id' => 2],  // Inggris - Zian
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 6, 'guru_id' => 3, 'mapel_id' => 3],  // PWB - Ahmad
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 7, 'guru_id' => 3, 'mapel_id' => 3],  // PWB - Ahmad
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 8, 'guru_id' => 3, 'mapel_id' => 3],  // PWB - Ahmad
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 10, 'guru_id' => 3, 'mapel_id' => 3], // PWB - Ahmad
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 11, 'guru_id' => 3, 'mapel_id' => 3], // PWB - Ahmad
            ['ruangan_id' => 1, 'hari_id' => 1, 'sesi_id' => 12, 'guru_id' => 3, 'mapel_id' => 3], // PWB - Ahmad
            
            // Lab 1 - Selasa
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 1, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 2, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 3, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 5, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 6, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 7, 'guru_id' => 4, 'mapel_id' => 4],  // PBT - Dhian
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 8, 'guru_id' => 5, 'mapel_id' => 5],  // PAI - Hani
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 10, 'guru_id' => 6, 'mapel_id' => 6], // Indonesia - Deden
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 11, 'guru_id' => 6, 'mapel_id' => 6], // Indonesia - Deden
            ['ruangan_id' => 1, 'hari_id' => 2, 'sesi_id' => 12, 'guru_id' => 6, 'mapel_id' => 6], // Indonesia - Deden
            
            // Lab 1 - Rabu
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 1, 'guru_id' => 7, 'mapel_id' => 7],  // PKK - Gunawan
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 2, 'guru_id' => 7, 'mapel_id' => 7],  // PKK - Gunawan
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 7],  // PKK - Gunawan
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 5, 'guru_id' => 7, 'mapel_id' => 7],  // PKK - Gunawan
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 6, 'guru_id' => 7, 'mapel_id' => 7],  // PKK - Gunawan
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 7, 'guru_id' => 8, 'mapel_id' => 8],  // PPB - Yusuf
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 8, 'guru_id' => 8, 'mapel_id' => 8],  // PPB - Yusuf
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 10, 'guru_id' => 8, 'mapel_id' => 8], // PPB - Yusuf
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 11, 'guru_id' => 8, 'mapel_id' => 8], // PPB - Yusuf
            ['ruangan_id' => 1, 'hari_id' => 3, 'sesi_id' => 12, 'guru_id' => 8, 'mapel_id' => 8], // PPB - Yusuf
            
            // Lab 1 - Kamis
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 1, 'guru_id' => 1, 'mapel_id' => 1],  // PST - Nurhanan
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 2, 'guru_id' => 1, 'mapel_id' => 1],  // PST - Nurhanan
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 3, 'guru_id' => 2, 'mapel_id' => 2],  // Inggris - Zian
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 5, 'guru_id' => 2, 'mapel_id' => 2],  // Inggris - Zian
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 9],  // PPS - Dewi
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 7, 'guru_id' => 9, 'mapel_id' => 9],  // PPS - Dewi
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 8, 'guru_id' => 5, 'mapel_id' => 5],  // PAI - Hani
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 10, 'guru_id' => 5, 'mapel_id' => 5], // PAI - Hani
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 11, 'guru_id' => 10, 'mapel_id' => 10], // PFS - Darwis
            ['ruangan_id' => 1, 'hari_id' => 4, 'sesi_id' => 12, 'guru_id' => 10, 'mapel_id' => 10], // PFS - Darwis
            
            // Lab 1 - Jumat
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 1, 'guru_id' => 11, 'mapel_id' => 11], // BSD - Indria
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 2, 'guru_id' => 11, 'mapel_id' => 11], // BSD - Indria
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 3, 'guru_id' => 11, 'mapel_id' => 11], // BSD - Indria
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 5, 'guru_id' => 11, 'mapel_id' => 11], // BSD - Indria
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 6, 'guru_id' => 11, 'mapel_id' => 11], // BSD - Indria
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 7, 'guru_id' => 12, 'mapel_id' => 12], // MTK - Acun
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 10, 'guru_id' => 12, 'mapel_id' => 12], // MTK - Acun
            ['ruangan_id' => 1, 'hari_id' => 5, 'sesi_id' => 11, 'guru_id' => 12, 'mapel_id' => 12], // MTK - Acun
            
            // Lab 2 - Senin (from SQL lab_id=3)
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 1, 'guru_id' => 5, 'mapel_id' => 1],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 2, 'guru_id' => 6, 'mapel_id' => 1],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 5, 'guru_id' => 8, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 7, 'guru_id' => 10, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 8, 'guru_id' => 11, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 10, 'guru_id' => 12, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 11, 'guru_id' => 1, 'mapel_id' => 3],
            ['ruangan_id' => 2, 'hari_id' => 1, 'sesi_id' => 12, 'guru_id' => 2, 'mapel_id' => 3],
            
            // Lab 2 - Selasa
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 1, 'guru_id' => 2, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 2, 'guru_id' => 6, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 5, 'guru_id' => 8, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 7, 'guru_id' => 10, 'mapel_id' => 4],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 8, 'guru_id' => 11, 'mapel_id' => 5],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 10, 'guru_id' => 12, 'mapel_id' => 6],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 11, 'guru_id' => 1, 'mapel_id' => 6],
            ['ruangan_id' => 2, 'hari_id' => 2, 'sesi_id' => 12, 'guru_id' => 2, 'mapel_id' => 6],
            
            // Lab 2 - Rabu
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 1, 'guru_id' => 5, 'mapel_id' => 7],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 2, 'guru_id' => 6, 'mapel_id' => 7],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 7],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 5, 'guru_id' => 8, 'mapel_id' => 7],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 7],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 7, 'guru_id' => 10, 'mapel_id' => 8],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 8, 'guru_id' => 11, 'mapel_id' => 8],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 10, 'guru_id' => 12, 'mapel_id' => 8],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 11, 'guru_id' => 1, 'mapel_id' => 8],
            ['ruangan_id' => 2, 'hari_id' => 3, 'sesi_id' => 12, 'guru_id' => 2, 'mapel_id' => 8],
            
            // Lab 2 - Kamis
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 1, 'guru_id' => 5, 'mapel_id' => 1],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 2, 'guru_id' => 6, 'mapel_id' => 1],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 5, 'guru_id' => 8, 'mapel_id' => 2],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 9],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 7, 'guru_id' => 10, 'mapel_id' => 9],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 8, 'guru_id' => 11, 'mapel_id' => 5],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 10, 'guru_id' => 12, 'mapel_id' => 5],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 11, 'guru_id' => 1, 'mapel_id' => 10],
            ['ruangan_id' => 2, 'hari_id' => 4, 'sesi_id' => 12, 'guru_id' => 2, 'mapel_id' => 10],
            
            // Lab 2 - Jumat
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 1, 'guru_id' => 5, 'mapel_id' => 11],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 2, 'guru_id' => 6, 'mapel_id' => 11],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 3, 'guru_id' => 7, 'mapel_id' => 11],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 5, 'guru_id' => 8, 'mapel_id' => 11],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 6, 'guru_id' => 9, 'mapel_id' => 11],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 7, 'guru_id' => 10, 'mapel_id' => 12],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 10, 'guru_id' => 11, 'mapel_id' => 12],
            ['ruangan_id' => 2, 'hari_id' => 5, 'sesi_id' => 11, 'guru_id' => 12, 'mapel_id' => 12],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
