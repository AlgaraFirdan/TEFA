<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\Hari;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InformationLabController extends Controller
{
    public function index(Request $request)
    {
        $ruanganId = $request->query('ruangan_id', 1); // Default Lab 1
        $previewSesiId = $request->query('preview_sesi_id'); // For preview mode
        $previewHariId = $request->query('preview_hari_id'); // For preview mode
        
        $ruangan = Ruangan::with('penanggungJawab')->findOrFail($ruanganId);
        $allRuangan = Ruangan::orderBy('kode')->get();
        
        // Use preview day or current day
        if ($previewHariId) {
            $hariId = $previewHariId;
        } else {
            $today = now()->dayOfWeek; // 0=Sunday, 1=Monday, ..., 6=Saturday
            $hariId = $today === 0 ? 7 : $today; // Convert Sunday to 7 for database
        }
        $hari = Hari::find($hariId);
        
        // Get all sessions including breaks
        $allSesi = Sesi::orderBy('jam_mulai')->get();
        
        // Get all schedules for today in this lab
        $jadwalHariIni = Jadwal::with(['sesi', 'guru', 'mapel', 'hari'])
            ->where('ruangan_id', $ruanganId)
            ->where('hari_id', $hariId)
            ->get()
            ->keyBy('sesi_id');

        // Get current time and schedule
        $sekarang = now();
        $currentSesi = null;
        $jadwalSekarang = null;
        $sesiNumber = null;
        $sesiCounter = 0;
        $isBelumDimulai = false;
        
        // Preview mode: use specified session
        if ($previewSesiId && $previewSesiId !== 'belum_dimulai') {
            $previewSesi = Sesi::find($previewSesiId);
            if ($previewSesi) {
                foreach ($allSesi as $sesi) {
                    if (!$sesi->is_istirahat) {
                        $sesiCounter++;
                    }
                    if ($sesi->id == $previewSesiId) {
                        $currentSesi = $sesi;
                        if (!$sesi->is_istirahat) {
                            $sesiNumber = $sesiCounter;
                            $jadwalSekarang = $jadwalHariIni->get($sesi->id);
                        }
                        break;
                    }
                }
            }
        } elseif ($previewSesiId === 'belum_dimulai') {
            // Preview "belum dimulai" state
            $isBelumDimulai = true;
        } elseif ($previewHariId) {
            // Preview mode with no sesi selected = "selesai" state
            // Leave $currentSesi as null
        } else {
            // Normal mode: use current time
            foreach ($allSesi as $sesi) {
                $mulai = Carbon::today()->setTimeFromTimeString($sesi->jam_mulai);
                $selesai = Carbon::today()->setTimeFromTimeString($sesi->jam_selesai);
                
                if (!$sesi->is_istirahat) {
                    $sesiCounter++;
                }
                
                if ($sekarang->between($mulai, $selesai)) {
                    $currentSesi = $sesi;
                    if (!$sesi->is_istirahat) {
                        $sesiNumber = $sesiCounter;
                        $jadwalSekarang = $jadwalHariIni->get($sesi->id);
                    }
                    break;
                }
            }

            // If no session matched, check if before first session (belum dimulai)
            if (!$currentSesi) {
                $firstSesi = $allSesi->first();
                if ($firstSesi) {
                    $firstMulai = Carbon::today()->setTimeFromTimeString($firstSesi->jam_mulai);
                    if ($sekarang->lt($firstMulai)) {
                        $isBelumDimulai = true;
                    }
                }
            }
        }

        return view('information-lab.index', [
            'ruangan' => $ruangan,
            'allRuangan' => $allRuangan,
            'allSesi' => $allSesi,
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalSekarang' => $jadwalSekarang,
            'currentSesi' => $currentSesi,
            'sesiNumber' => $sesiNumber,
            'hari' => $hari,
            'isBelumDimulai' => $isBelumDimulai,
            'isPreviewMode' => $previewSesiId !== null || $previewHariId !== null,
        ]);
    }

    public function preview()
    {
        $ruangan = Ruangan::orderBy('kode')->get();
        $sesi = Sesi::orderBy('jam_mulai')->get();
        $hari = Hari::orderBy('id')->get();
        
        return view('admin.preview', [
            'ruangan' => $ruangan,
            'sesi' => $sesi,
            'hari' => $hari,
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
            ->get()
            ->first(function ($jadwal) use ($sekarang) {
                $mulai = Carbon::today()->setTimeFromTimeString($jadwal->sesi->jam_mulai);
                $selesai = Carbon::today()->setTimeFromTimeString($jadwal->sesi->jam_selesai);
                return $sekarang->between($mulai, $selesai);
            });

        return response()->json([
            'jadwal' => $jadwal,
            'time' => now()->format('H:i:s'),
        ]);
    }
}