<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = [
            ['nama' => 'PST', 'kode' => 'PST'],
            ['nama' => 'Bahasa Inggris', 'kode' => 'INGGRIS'],
            ['nama' => 'Pemrograman Web dan Perangkat Bergerak', 'kode' => 'PWB'],
            ['nama' => 'Pemrograman Berbasis Teks', 'kode' => 'PBT'],
            ['nama' => 'Pendidikan Agama Islam', 'kode' => 'PAI'],
            ['nama' => 'Bahasa Indonesia', 'kode' => 'INDONESIA'],
            ['nama' => 'Produk Kreatif dan Kewirausahaan', 'kode' => 'PKK'],
            ['nama' => 'Pemrograman Perangkat Bergerak', 'kode' => 'PPB'],
            ['nama' => 'PPS', 'kode' => 'PPS'],
            ['nama' => 'PFS', 'kode' => 'PFS'],
            ['nama' => 'Basis Data', 'kode' => 'BSD'],
            ['nama' => 'Matematika', 'kode' => 'MTK'],
        ];

        foreach ($mapels as $mapel) {
            Mapel::create($mapel);
        }
    }
}
