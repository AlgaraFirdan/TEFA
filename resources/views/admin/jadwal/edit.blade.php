@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Jadwal</h2>
    <form method="POST" action="{{ route('admin.jadwal.update', $jadwal) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="ruangan_id" class="block text-sm font-medium text-gray-700">Ruangan</label>
            <select name="ruangan_id" id="ruangan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Pilih Ruangan</option>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}" {{ $jadwal->ruangan_id == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="hari_id" class="block text-sm font-medium text-gray-700">Hari</label>
            <select name="hari_id" id="hari_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Pilih Hari</option>
                @foreach($haris as $hari)
                    <option value="{{ $hari->id }}" {{ $jadwal->hari_id == $hari->id ? 'selected' : '' }}>{{ $hari->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="sesi_id" class="block text-sm font-medium text-gray-700">Sesi</label>
            <select name="sesi_id" id="sesi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Pilih Sesi</option>
                @foreach($sesis as $sesi)
                    <option value="{{ $sesi->id }}" {{ $jadwal->sesi_id == $sesi->id ? 'selected' : '' }}>{{ $sesi->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="guru_id" class="block text-sm font-medium text-gray-700">Guru</label>
            <select name="guru_id" id="guru_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Pilih Guru</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}" {{ $jadwal->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="mapel_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
            <select name="mapel_id" id="mapel_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}" {{ $jadwal->mapel_id == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
