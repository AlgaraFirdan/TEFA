<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangans = [
            ['nama' => 'Lab 1', 'kode' => 'LAB1', 'penanggung_jawab_id' => 8], // Yusuf Effendy
            ['nama' => 'Lab 2', 'kode' => 'LAB2', 'penanggung_jawab_id' => null],
            ['nama' => 'Lab 3', 'kode' => 'LAB3', 'penanggung_jawab_id' => null],
            ['nama' => 'Lab 4', 'kode' => 'LAB4', 'penanggung_jawab_id' => null],
            ['nama' => 'Lab 5', 'kode' => 'LAB5', 'penanggung_jawab_id' => null],
            ['nama' => 'Lab TBS', 'kode' => 'TBS', 'penanggung_jawab_id' => null],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}
