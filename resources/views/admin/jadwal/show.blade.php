@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Jadwal</h2>
    <div class="mb-4">
        <strong>Ruangan:</strong> {{ $jadwal->ruangan->nama }}
    </div>
    <div class="mb-4">
        <strong>Hari:</strong> {{ $jadwal->hari->nama }}
    </div>
    <div class="mb-4">
        <strong>Sesi:</strong> {{ $jadwal->sesi->nama }}
    </div>
    <div class="mb-4">
        <strong>Guru:</strong> {{ $jadwal->guru->nama }}
    </div>
    <div class="mb-4">
        <strong>Mata Pelajaran:</strong> {{ $jadwal->mapel->nama }}
    </div>
    <div class="flex justify-end">
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Kembali</a>
        <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
    </div>
</div>
@endsection
