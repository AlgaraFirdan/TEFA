@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Mata Pelajaran</h2>
    <div class="mb-4">
        <strong>Nama:</strong> {{ $mapel->nama }}
    </div>
    <div class="flex justify-end">
        <a href="{{ route('admin.mapel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Kembali</a>
        <a href="{{ route('admin.mapel.edit', $mapel) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
    </div>
</div>
@endsection
