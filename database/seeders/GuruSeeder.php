<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            ['nama' => 'Nurhanan Afifah, S.Pd.', 'nip' => '198501011234501', 'foto' => null],
            ['nama' => 'Zian Muzakkiyah Kosman, S.Pd, M.Pd.', 'nip' => '198501011234502', 'foto' => null],
            ['nama' => 'Ahmad Jumadi, S.Kom.', 'nip' => '198501011234503', 'foto' => null],
            ['nama' => 'Dhian Nur Rahayu, S.T, M.Kom.', 'nip' => '198501011234504', 'foto' => null],
            ['nama' => 'Hani Siti Nuraen, S.Pd.', 'nip' => '198501011234505', 'foto' => null],
            ['nama' => 'Drs. Deden Hamdani, M.M.', 'nip' => '198501011234506', 'foto' => null],
            ['nama' => 'Gunawan Busyaeri, S.Pd.', 'nip' => '198501011234507', 'foto' => null],
            ['nama' => 'Yusuf Effendy, S.T.', 'nip' => '198501011234508', 'foto' => null],
            ['nama' => 'Dewi Lestari Nengsih, S.IP.', 'nip' => '198501011234509', 'foto' => null],
            ['nama' => 'Darwis Prasetyo, S.Pd.', 'nip' => '198501011234510', 'foto' => null],
            ['nama' => 'Indria Listiani Ningrum, S.T.', 'nip' => '198501011234511', 'foto' => null],
            ['nama' => 'Acun, S.Pd.', 'nip' => '198501011234512', 'foto' => null],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}
