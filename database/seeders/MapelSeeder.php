<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = [
            ['nama' => 'Pemrograman Web', 'kode' => 'PWB'],
            ['nama' => 'Basis Data', 'kode' => 'BDD'],
            ['nama' => 'Sistem Operasi', 'kode' => 'SOP'],
            ['nama' => 'Jaringan Komputer', 'kode' => 'JKO'],
            ['nama' => 'Teknik Digital', 'kode' => 'TDG'],
            ['nama' => 'Mikrokontroller', 'kode' => 'MKK'],
        ];

        foreach ($mapels as $mapel) {
            Mapel::create($mapel);
        }
    }
}
