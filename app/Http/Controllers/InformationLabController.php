<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\Hari;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InformationLabController extends Controller
{
    public function index(Request $request)
    {
        $ruanganId = $request->query('ruangan_id', 1); // Default Lab 1
        
        $ruangan = Ruangan::findOrFail($ruanganId);
        $allRuangan = Ruangan::orderBy('kode')->get();
        
        $today = now()->dayOfWeek; // 0=Sunday, 1=Monday, ..., 6=Saturday
        $hariId = $today === 0 ? 7 : $today; // Convert Sunday to 7 for database
        
        // Get all schedules for today in this lab
        $jadwalHariIni = Jadwal::with(['sesi', 'guru', 'mapel', 'hari'])
            ->where('ruangan_id', $ruanganId)
            ->where('hari_id', $hariId)
            ->join('sesi', 'jadwal.sesi_id', '=', 'sesi.id')
            ->orderBy('sesi.jam_mulai')
            ->get();

        // Get current and next schedule
        $sekarang = now();
        $jadwalSekarang = $jadwalHariIni->first(function ($jadwal) use ($sekarang) {
            $mulai = Carbon::createFromTimeString($jadwal->sesi->jam_mulai);
            $selesai = Carbon::createFromTimeString($jadwal->sesi->jam_selesai);
            return $sekarang->between($mulai, $selesai);
        });

        return view('information-lab.index', [
            'ruangan' => $ruangan,
            'allRuangan' => $allRuangan,
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalSekarang' => $jadwalSekarang,
        ]);
    }

    public function getJadwalSekarang(Request $request)
    {
        $ruanganId = $request->query('ruangan_id', 1);
        $today = now()->dayOfWeek;
        $hariId = $today === 0 ? 7 : $today;
        $sekarang = now();

        $jadwal = Jadwal::with(['sesi', 'guru', 'mapel', 'ruangan'])
            ->where('ruangan_id', $ruanganId)
            ->where('hari_id', $hariId)
            ->join('sesi', 'jadwal.sesi_id', '=', 'sesi.id')
            ->orderBy('sesi.jam_mulai')
            ->get()
            ->first(function ($jadwal) use ($sekarang) {
                $mulai = Carbon::createFromTimeString($jadwal->sesi->jam_mulai);
                $selesai = Carbon::createFromTimeString($jadwal->sesi->jam_selesai);
                return $sekarang->between($mulai, $selesai);
            });

        return response()->json($jadwal);
    }
}