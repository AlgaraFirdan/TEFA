@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>
    <p class="text-gray-600">Manage your application data here.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-blue-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800">Guru</h3>
            <p class="text-blue-600">Manage teachers</p>
            <a href="{{ route('admin.guru.index') }}" class="text-blue-500 hover:text-blue-700">View All</a>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-green-800">Ruangan</h3>
            <p class="text-green-600">Manage rooms</p>
            <a href="{{ route('admin.ruangan.index') }}" class="text-green-500 hover:text-green-700">View All</a>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-yellow-800">Mata Pelajaran</h3>
            <p class="text-yellow-600">Manage subjects</p>
            <a href="{{ route('admin.mapel.index') }}" class="text-yellow-500 hover:text-yellow-700">View All</a>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-purple-800">Jadwal</h3>
            <p class="text-purple-600">Manage schedules</p>
            <a href="{{ route('admin.jadwal.index') }}" class="text-purple-500 hover:text-purple-700">View All</a>
        </div>
    </div>
</div>
@endsection
