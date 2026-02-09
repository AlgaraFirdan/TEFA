@extends('admin.layout')

@section('title', 'Preview Tampilan')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Preview Information Lab</h3>
    <p class="text-gray-600 mb-6">Pilih kombinasi ruangan, hari, dan sesi untuk melihat preview tampilan Information Lab.</p>

    <!-- Filter Form -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
            <select id="ruanganSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($ruangan as $r)
                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
            <select id="hariSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($hari as $h)
                    <option value="{{ $h->id }}">{{ $h->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sesi / Fase Waktu</label>
            <select id="sesiSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pembelajaran Selesai --</option>
                <option value="belum_dimulai">🌙 Pembelajaran Belum Dimulai</option>
                @php $sesiNum = 0; @endphp
                @foreach($sesi as $s)
                    @if($s->is_istirahat)
                        <option value="{{ $s->id }}">🕐 {{ $s->nama }} ({{ \Carbon\Carbon::parse($s->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($s->jam_selesai)->format('H:i') }})</option>
                    @else
                        @php $sesiNum++; @endphp
                        <option value="{{ $s->id }}">📚 Jam Ke-{{ $sesiNum }} ({{ \Carbon\Carbon::parse($s->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($s->jam_selesai)->format('H:i') }})</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button onclick="openPreview()" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Lihat Preview
            </button>
        </div>
    </div>

    <!-- Quick Preview Buttons -->
    <div class="border-t pt-6">
        <h4 class="text-md font-semibold text-gray-700 mb-4">Preview Cepat - Semua Fase Waktu</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            <button onclick="quickPreview('belum_dimulai')" 
                class="px-4 py-3 bg-indigo-100 text-indigo-800 rounded-lg hover:bg-indigo-200 transition text-sm font-medium">
                Belum Dimulai<br>
                <span class="text-xs">00:00 - Sesi 1</span>
            </button>
            @php $sesiNum = 0; @endphp
            @foreach($sesi as $s)
                @if($s->is_istirahat)
                    <button onclick="quickPreview({{ $s->id }})" 
                        class="px-4 py-3 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition text-sm font-medium">
                        {{ $s->nama }}<br>
                        <span class="text-xs">{{ \Carbon\Carbon::parse($s->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($s->jam_selesai)->format('H:i') }}</span>
                    </button>
                @else
                    @php $sesiNum++; @endphp
                    <button onclick="quickPreview({{ $s->id }})" 
                        class="px-4 py-3 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition text-sm font-medium">
                        Jam Ke-{{ $sesiNum }}<br>
                        <span class="text-xs">{{ \Carbon\Carbon::parse($s->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($s->jam_selesai)->format('H:i') }}</span>
                    </button>
                @endif
            @endforeach
            <button onclick="quickPreview('')" 
                class="px-4 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm font-medium">
                Selesai<br>
                <span class="text-xs">Di luar jam</span>
            </button>
        </div>
    </div>

    <!-- Preview Frame -->
    <div class="border-t pt-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-md font-semibold text-gray-700">Preview</h4>
            <button onclick="openInNewTab()" class="text-blue-600 hover:text-blue-800 text-sm">
                Buka di Tab Baru ↗
            </button>
        </div>
        <div class="border rounded-lg overflow-hidden bg-gray-100" style="height: 600px;">
            <iframe id="previewFrame" src="{{ route('information-lab.index') }}" class="w-full h-full"></iframe>
        </div>
    </div>
</div>

<script>
    let currentUrl = '{{ route("information-lab.index") }}';

    function buildPreviewUrl() {
        const ruanganId = document.getElementById('ruanganSelect').value;
        const hariId = document.getElementById('hariSelect').value;
        const sesiId = document.getElementById('sesiSelect').value;
        
        let url = '{{ route("information-lab.index") }}?ruangan_id=' + ruanganId + '&preview_hari_id=' + hariId;
        if (sesiId) {
            url += '&preview_sesi_id=' + sesiId;
        }
        return url;
    }

    function openPreview() {
        currentUrl = buildPreviewUrl();
        document.getElementById('previewFrame').src = currentUrl;
    }

    function quickPreview(sesiId) {
        const ruanganId = document.getElementById('ruanganSelect').value;
        const hariId = document.getElementById('hariSelect').value;
        
        let url = '{{ route("information-lab.index") }}?ruangan_id=' + ruanganId + '&preview_hari_id=' + hariId;
        if (sesiId) {
            url += '&preview_sesi_id=' + sesiId;
            document.getElementById('sesiSelect').value = sesiId;
        } else {
            document.getElementById('sesiSelect').value = '';
        }
        
        currentUrl = url;
        document.getElementById('previewFrame').src = currentUrl;
    }

    function openInNewTab() {
        window.open(currentUrl, '_blank');
    }

    // Initial load with default settings
    document.addEventListener('DOMContentLoaded', function() {
        // Set default hari to current day
        const today = new Date().getDay();
        const hariId = today === 0 ? 7 : today;
        document.getElementById('hariSelect').value = hariId;
    });
</script>
@endsection
