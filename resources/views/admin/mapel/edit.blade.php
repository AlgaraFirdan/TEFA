@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Mata Pelajaran</h2>
    <form method="POST" action="{{ route('admin.mapel.update', $mapel) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
            <input type="text" name="kode" id="kode" value="{{ old('kode', $mapel->kode) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $mapel->nama) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.mapel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
