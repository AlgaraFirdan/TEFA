@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Guru</h2>
        <a href="{{ route('admin.guru.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Guru</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($gurus as $guru)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $guru->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $guru->nip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($guru->foto)
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto" class="w-10 h-10 rounded-full">
                        @else
                            <span class="text-gray-400">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.guru.show', $guru) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                        <a href="{{ route('admin.guru.edit', $guru) }}" class="ml-2 text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.guru.destroy', $guru) }}" class="inline ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data guru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
