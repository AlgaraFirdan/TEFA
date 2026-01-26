<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Guru;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('penanggungJawab')->get();
        return view('admin.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        $gurus = Guru::all();
        return view('admin.ruangan.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:ruangan',
            'penanggung_jawab_id' => 'nullable|exists:guru,id',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Ruangan $ruangan)
    {
        $ruangan->load('penanggungJawab');
        return view('admin.ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        $gurus = Guru::all();
        return view('admin.ruangan.edit', compact('ruangan', 'gurus'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:ruangan,kode,' . $ruangan->id,
            'penanggung_jawab_id' => 'nullable|exists:guru,id',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
