@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Guru</h2>
    <div class="mb-4">
        <strong>Nama:</strong> {{ $guru->nama }}
    </div>
    <div class="mb-4">
        <strong>NIP:</strong> {{ $guru->nip }}
    </div>
    <div class="mb-4">
        <strong>Foto:</strong>
        @if($guru->foto)
            <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto" class="w-20 h-20 rounded-full">
        @else
            <span class="text-gray-400">Tidak ada foto</span>
        @endif
    </div>
    <div class="flex justify-end">
        <a href="{{ route('admin.guru.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Kembali</a>
        <a href="{{ route('admin.guru.edit', $guru) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
    </div>
</div>
@endsection
