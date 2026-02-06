<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Hari;
use App\Models\Sesi;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with('ruangan', 'hari', 'sesi', 'guru', 'mapel');
        
        // Apply filters
        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        if ($request->filled('hari_id')) {
            $query->where('hari_id', $request->hari_id);
        }
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }
        if ($request->filled('mapel_id')) {
            $query->where('mapel_id', $request->mapel_id);
        }
        
        $jadwals = $query->orderBy('ruangan_id')->orderBy('hari_id')->orderBy('sesi_id')->get();
        
        // Get filter options
        $ruangans = Ruangan::orderBy('kode')->get();
        $haris = Hari::orderBy('id')->get();
        $gurus = Guru::orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama')->get();
        
        return view('admin.jadwal.index', compact('jadwals', 'ruangans', 'haris', 'gurus', 'mapels'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $haris = Hari::all();
        $sesis = Sesi::all();
        $gurus = Guru::all();
        $mapels = Mapel::all();
        return view('admin.jadwal.create', compact('ruangans', 'haris', 'sesis', 'gurus', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id',
            'hari_id' => 'required|exists:hari,id',
            'sesi_id' => 'required|exists:sesi,id',
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load('ruangan', 'hari', 'sesi', 'guru', 'mapel');
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $ruangans = Ruangan::all();
        $haris = Hari::all();
        $sesis = Sesi::all();
        $gurus = Guru::all();
        $mapels = Mapel::all();
        return view('admin.jadwal.edit', compact('jadwal', 'ruangans', 'haris', 'sesis', 'gurus', 'mapels'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id',
            'hari_id' => 'required|exists:hari,id',
            'sesi_id' => 'required|exists:sesi,id',
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
