<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangans = [
            ['nama' => 'Lab 1', 'kode' => 'L1', 'penanggung_jawab_id' => 1],
            ['nama' => 'Lab 2', 'kode' => 'L2', 'penanggung_jawab_id' => 2],
            ['nama' => 'Lab 3', 'kode' => 'L3', 'penanggung_jawab_id' => 3],
            ['nama' => 'Lab 4', 'kode' => 'L4', 'penanggung_jawab_id' => 4],
            ['nama' => 'Lab 5', 'kode' => 'L5', 'penanggung_jawab_id' => 5],
            ['nama' => 'TBS', 'kode' => 'TBS', 'penanggung_jawab_id' => 6],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}
