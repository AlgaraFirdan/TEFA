<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            ['nama' => 'Budi Santoso', 'nip' => '198501011234567', 'foto' => null],
            ['nama' => 'Siti Nurhaliza', 'nip' => '198702021234568', 'foto' => null],
            ['nama' => 'Ahmad Wijaya', 'nip' => '198803031234569', 'foto' => null],
            ['nama' => 'Eka Putri', 'nip' => '198904041234570', 'foto' => null],
            ['nama' => 'Rudi Hermawan', 'nip' => '199005051234571', 'foto' => null],
            ['nama' => 'Dwi Lestari', 'nip' => '199106061234572', 'foto' => null],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}
