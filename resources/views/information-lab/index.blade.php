@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Left: Jadwal Hari Ini -->
    <div class="w-1/4 bg-white border-r border-gray-300 overflow-y-auto">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Jadwal Hari Ini</h2>
            <div class="space-y-2">
                @forelse($jadwalHariIni as $jadwal)
                    <div class="p-3 rounded border {{ $jadwalSekarang && $jadwalSekarang->id === $jadwal->id ? 'bg-blue-100 border-blue-500' : 'bg-gray-50 border-gray-300' }}">
                        <p class="font-semibold text-sm text-gray-800">{{ $jadwal->sesi->nama }}</p>
                        <p class="text-xs text-gray-600">{{ $jadwal->sesi->jam_mulai }} - {{ $jadwal->sesi->jam_selesai }}</p>
                        @if(!$jadwal->sesi->is_istirahat)
                            <p class="text-xs text-blue-600 mt-1">{{ $jadwal->mapel->nama }}</p>
                        @else
                            <p class="text-xs text-orange-600 mt-1 italic">Istirahat</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Tidak ada jadwal hari ini</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Center: Detail Jadwal Sekarang -->
    <div class="w-1/2 bg-gradient-to-b from-blue-50 to-white flex flex-col items-center justify-center">
        @if($jadwalSekarang && !$jadwalSekarang->sesi->is_istirahat)
            <div class="text-center">
                <h1 class="text-5xl font-bold text-blue-600 mb-6">{{ $jadwalSekarang->mapel->nama }}</h1>
                <div class="space-y-4 text-lg text-gray-700">
                    <p><span class="font-semibold">Sesi:</span> {{ $jadwalSekarang->sesi->nama }}</p>
                    <p><span class="font-semibold">Jam:</span> {{ $jadwalSekarang->sesi->jam_mulai }} - {{ $jadwalSekarang->sesi->jam_selesai }}</p>
                    <p><span class="font-semibold">Guru:</span> {{ $jadwalSekarang->guru->nama }}</p>
                </div>
                <div class="mt-8 text-sm text-gray-500">
                    <p>{{ $ruangan->nama }} - Penanggung Jawab: {{ $ruangan->penanggungJawab?->nama ?? 'Belum ditentukan' }}</p>
                </div>
            </div>
        @else
            <div class="text-center">
                <p class="text-3xl font-semibold text-gray-600 mb-4">Istirahat</p>
                <p class="text-gray-500">Belum ada jadwal atau sedang istirahat</p>
            </div>
        @endif
    </div>

    <!-- Right: Dropdown Lab -->
    <div class="w-1/4 bg-white border-l border-gray-300 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Lab</h3>
        <select id="ruangganSelect" onchange="changeRuangan(this.value)" class="w-full p-3 border border-gray-300 rounded bg-white cursor-pointer">
            @foreach($allRuangan as $r)
                <option value="{{ $r->id }}" {{ $r->id == $ruangan->id ? 'selected' : '' }}>
                    {{ $r->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<script>
    function changeRuangan(ruanganId) {
        window.location.href = '{{ route("information-lab.index") }}?ruangan_id=' + ruanganId;
    }

    // Live update every 10 seconds
    setInterval(() => {
        const ruanganId = new URLSearchParams(window.location.search).get('ruangan_id') || 1;
        fetch(`{{ route('jadwal.sekarang') }}?ruangan_id=${ruanganId}`)
            .then(res => res.json())
            .then(data => {
                if (data) {
                    location.reload();
                }
            });
    }, 10000);
</script>
@endsection