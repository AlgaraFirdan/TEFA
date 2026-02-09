<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Information Lab - {{ config('app.name', 'TEFA') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pplg.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        // Determine if class is in session or finished
        $isPembelajaranAktif = $jadwalSekarang !== null;
        $isIstirahat = $currentSesi && $currentSesi->is_istirahat;
        $isBelumDimulai = $isBelumDimulai ?? false;
        
        // In preview mode or normal mode: dark mode only when no current session at all
        // Light mode when: pembelajaran aktif, istirahat, or preview mode with a session selected
        $isInSession = $currentSesi !== null; // Any session (pembelajaran or istirahat)
        $isDarkMode = !$isInSession;
        
        // Determine which ISHT number
        $currentIshtNumber = 0;
        if ($isIstirahat) {
            $ishtCount = 0;
            foreach($allSesi as $s) {
                if ($s->is_istirahat) {
                    $ishtCount++;
                    if ($currentSesi && $s->id === $currentSesi->id) {
                        $currentIshtNumber = $ishtCount;
                        break;
                    }
                }
            }
        }
        
        $isIsht2 = $isIstirahat && $currentIshtNumber === 2;
    @endphp
    <style>
        * { font-family: 'Poppins', sans-serif; }
        
        /* Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        @keyframes fadeInDown {
            from { 
                opacity: 0; 
                transform: translateY(-30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        @keyframes fadeInLeft {
            from { 
                opacity: 0; 
                transform: translateX(-30px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
        
        @keyframes fadeInRight {
            from { 
                opacity: 0; 
                transform: translateX(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
        
        @keyframes scaleIn {
            from { 
                opacity: 0; 
                transform: scale(0.9); 
            }
            to { 
                opacity: 1; 
                transform: scale(1); 
            }
        }
        
        @keyframes slideInFromLeft {
            from { 
                opacity: 0; 
                transform: translateX(-100%); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes slideDown {
            from { 
                opacity: 0;
                max-height: 0;
            }
            to { 
                opacity: 1;
                max-height: 100px;
            }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8); }
        }
        
        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out forwards;
        }
        
        .animate-fade-in-left {
            animation: fadeInLeft 0.5s ease-out forwards;
        }
        
        .animate-fade-in-right {
            animation: fadeInRight 0.5s ease-out forwards;
        }
        
        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }
        
        .animate-slide-in-left {
            animation: slideInFromLeft 0.6s ease-out forwards;
        }
        
        .animate-pulse-slow {
            animation: pulse 3s ease-in-out infinite;
        }
        
        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }
        
        /* Staggered animations for sidebar items */
        .sidebar-item {
            opacity: 0;
            animation: fadeInLeft 0.4s ease-out forwards;
        }
        
        .sidebar-item:nth-child(1) { animation-delay: 0.05s; }
        .sidebar-item:nth-child(2) { animation-delay: 0.1s; }
        .sidebar-item:nth-child(3) { animation-delay: 0.15s; }
        .sidebar-item:nth-child(4) { animation-delay: 0.2s; }
        .sidebar-item:nth-child(5) { animation-delay: 0.25s; }
        .sidebar-item:nth-child(6) { animation-delay: 0.3s; }
        .sidebar-item:nth-child(7) { animation-delay: 0.35s; }
        .sidebar-item:nth-child(8) { animation-delay: 0.4s; }
        .sidebar-item:nth-child(9) { animation-delay: 0.45s; }
        .sidebar-item:nth-child(10) { animation-delay: 0.5s; }
        .sidebar-item:nth-child(11) { animation-delay: 0.55s; }
        .sidebar-item:nth-child(12) { animation-delay: 0.6s; }
        
        /* Active sidebar item - combines fadeIn with glow */
        .sidebar-active {
            animation: fadeInLeft 0.4s ease-out forwards, glow 2s ease-in-out infinite 0.5s;
            background-color: rgb(59, 130, 246) !important;
        }
        
        /* Photo animation */
        .photo-container {
            animation: fadeInRight 0.8s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }
        
        /* Header animation */
        .header-animate {
            animation: fadeInDown 0.5s ease-out forwards;
        }
        
        /* Content sections animation delays */
        .content-header {
            animation: fadeInUp 0.5s ease-out forwards;
            animation-delay: 0.1s;
            opacity: 0;
        }
        
        .content-date {
            animation: fadeIn 0.5s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        .content-details {
            animation: fadeInUp 0.5s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }
        
        .content-lab {
            animation: fadeInUp 0.5s ease-out forwards;
            animation-delay: 0.5s;
            opacity: 0;
        }
        
        /* Dropdown animation */
        .dropdown-animate {
            animation: fadeInDown 0.4s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        /* Smooth transitions for interactive elements */
        .transition-smooth {
            transition: all 0.3s ease;
        }
        
        /* Video fade in */
        .video-fade {
            animation: fadeIn 1s ease-out forwards;
        }
    </style>
</head>
<body class="antialiased min-h-screen {{ $isDarkMode ? 'bg-gray-600' : 'bg-white' }}">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <header class="px-8 py-5 flex justify-between items-center bg-white shadow-lg header-animate">
            <a href="{{ route('admin.index') }}" class="cursor-pointer hover:opacity-80 transition-smooth hover:scale-105">
                <h1 class="text-5xl tracking-tight">
                    <span class="text-blue-500 italic font-semibold">Information</span> 
                    <span class="text-gray-800 font-bold">Lab</span>
                </h1>
            </a>
            <div class="flex items-center space-x-3 border-2 border-blue-400 rounded-xl px-4 py-2 dropdown-animate">
                <!-- Logo PPLG -->
                <div class="w-14 h-14 rounded-full flex items-center justify-center overflow-hidden transition-smooth hover:scale-110">
                    <img src="{{ asset('images/logo-pplg.png') }}" alt="Logo PPLG" class="w-14 h-14 object-contain">
                </div>
                <!-- Logo SMK -->
                <div class="w-14 h-14 rounded-full flex items-center justify-center overflow-hidden transition-smooth hover:scale-110">
                    <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK" class="w-14 h-14 object-contain">
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Left Sidebar: Jadwal Hari Ini -->
            <aside class="w-48 {{ $isDarkMode ? 'bg-gray-700' : 'bg-gray-50' }} border-r {{ $isDarkMode ? 'border-gray-600' : 'border-gray-200' }} flex flex-col animate-fade-in-left">
                <div class="flex flex-col justify-between h-full py-2">
                    @php 
                        $sesiCounter = 0;
                        $ishtCounter = 0;
                    @endphp
                    @foreach($allSesi as $sesi)
                        @php
                            $jadwal = $jadwalHariIni->get($sesi->id);
                            $isActive = $currentSesi && $currentSesi->id == $sesi->id;
                            if ($sesi->is_istirahat) {
                                $ishtCounter++;
                            } else {
                                $sesiCounter++;
                            }
                        @endphp
                        <div class="sidebar-item px-3 py-1 flex-1 flex items-center transition-smooth hover:bg-opacity-80 {{ $isActive ? 'bg-blue-500 sidebar-active text-white' : ($sesi->is_istirahat ? ($isDarkMode ? 'bg-gray-600' : 'bg-gray-100') : '') }}">
                            <div class="flex items-center justify-between w-full">
                                <span class="{{ $isActive ? 'text-white font-medium' : ($isDarkMode ? 'text-gray-300' : 'text-gray-600') }} text-sm">
                                    {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }} — {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }}
                                </span>
                                @if($sesi->is_istirahat)
                                    <span class="{{ $isActive ? 'text-white' : ($isDarkMode ? 'text-gray-400' : 'text-gray-500') }} text-xs font-medium">ISHT {{ $ishtCounter }}</span>
                                @elseif($jadwal)
                                    <span class="{{ $isActive ? 'text-white font-semibold' : ($isDarkMode ? 'text-gray-300' : 'text-gray-700') }} text-sm font-medium">{{ $jadwal->mapel->kode ?? substr($jadwal->mapel->nama, 0, 3) }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </aside>

            <!-- Center: Detail Jadwal Sekarang -->
            <main class="flex-1 flex flex-col justify-between py-8 px-12 {{ $isDarkMode ? 'bg-gray-600' : 'bg-white' }} relative overflow-hidden">
                
                <!-- Video Background for ISHT 2 -->
                @if($isIsht2)
                <div class="absolute inset-0 z-0 video-fade">
                    <video id="bgVideo" autoplay muted loop playsinline class="w-full h-full object-cover">
                        <source src="{{ asset('videos/lab-video.mp4') }}" type="video/mp4">
                    </video>
                    <!-- Dark overlay -->
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
                @endif

                <!-- Top Section: Status Header -->
                <div class="{{ $isIsht2 ? 'relative z-10' : '' }} content-header">
                    @if($isPembelajaranAktif)
                        <h2 class="text-4xl font-bold tracking-tight">
                            <span class="{{ $isDarkMode ? 'text-white' : 'text-gray-800' }}">Jam</span>
                            <span class="text-blue-500 ml-2">Ke-{{ $sesiNumber ?? '-' }}</span>
                        </h2>
                    @elseif($isIstirahat)
                        <h2 class="text-4xl font-bold tracking-tight">
                            <span class="{{ $isIsht2 ? 'text-white' : ($isDarkMode ? 'text-white' : 'text-gray-800') }}">Istirahat</span>
                            <span class="{{ $isIsht2 ? 'text-blue-400' : 'text-blue-500' }} ml-2">Ke-{{ $currentIshtNumber }}</span>
                        </h2>
                    @elseif($currentSesi && !$currentSesi->is_istirahat)
                        <h2 class="text-4xl font-bold tracking-tight">
                            <span class="{{ $isDarkMode ? 'text-white' : 'text-gray-800' }}">Jam</span>
                            <span class="text-blue-500 ml-2">Ke-{{ $sesiNumber ?? '-' }}</span>
                        </h2>
                    @elseif($isBelumDimulai)
                        <h2 class="text-4xl font-bold tracking-tight">
                            <span class="text-white">Pembelajaran</span>
                            <span class="text-blue-400 ml-2">Belum Dimulai</span>
                        </h2>
                    @else
                        <h2 class="text-4xl font-bold tracking-tight">
                            <span class="text-white">Pembelajaran</span>
                            <span class="text-blue-400 ml-2">Selesai</span>
                        </h2>
                    @endif
                </div>

                <!-- Middle Section: Clock and Date -->
                <div class="{{ $isIsht2 ? 'relative z-10' : '' }}">
                    <div class="mb-2">
                        <p id="digitalClock" class="text-8xl font-bold {{ $isIsht2 ? 'text-white' : ($isDarkMode ? 'text-white' : 'text-gray-800') }} tracking-tight" style="font-size: 7rem;" data-dark-mode="{{ $isDarkMode ? 'true' : 'false' }}" data-isht2="{{ $isIsht2 ? 'true' : 'false' }}">
                            {{ now()->format('H:i') }} <span class="text-6xl font-semibold">{{ now()->format('A') }}</span>
                        </p>
                    </div>
                    <p class="text-xl {{ $isIsht2 ? 'text-blue-400' : 'text-blue-500' }} font-medium content-date">
                        {{ $hari ? $hari->nama : now()->locale('id')->dayName }}, {{ now()->format('d') }} {{ now()->locale('id')->monthName }} {{ now()->format('Y') }}
                    </p>
                </div>

                <!-- Bottom Section: Teacher/PJ Info and Lab Name -->
                <div class="{{ $isIsht2 ? 'relative z-10' : '' }} content-details">
                    @if($isPembelajaranAktif)
                        <div class="space-y-1">
                            <p class="text-xl {{ $isDarkMode ? 'text-gray-300' : 'text-gray-600' }} font-light">
                                {{ \Carbon\Carbon::parse($jadwalSekarang->sesi->jam_mulai)->format('G:i') }} - {{ \Carbon\Carbon::parse($jadwalSekarang->sesi->jam_selesai)->format('H:i') }}
                            </p>
                            <p class="text-2xl text-blue-500 font-semibold">
                                {{ $jadwalSekarang->guru->nama }}
                            </p>
                            <p class="text-lg {{ $isDarkMode ? 'text-gray-300' : 'text-gray-600' }} font-light">
                                Guru Mapel {{ $jadwalSekarang->mapel->nama }}
                            </p>
                        </div>
                    @elseif($isIstirahat)
                        <div class="space-y-1">
                            <p class="text-xl {{ $isIsht2 ? 'text-gray-200' : ($isDarkMode ? 'text-gray-300' : 'text-gray-600') }} font-light">
                                {{ \Carbon\Carbon::parse($currentSesi->jam_mulai)->format('G:i') }} - {{ \Carbon\Carbon::parse($currentSesi->jam_selesai)->format('H:i') }}
                            </p>
                            <p class="text-2xl {{ $isIsht2 ? 'text-blue-400' : 'text-blue-500' }} font-semibold">
                                {{ $ruangan->penanggungJawab?->nama ?? 'Belum ditentukan' }}
                            </p>
                            <p class="text-lg {{ $isIsht2 ? 'text-gray-200' : ($isDarkMode ? 'text-gray-300' : 'text-gray-600') }} font-light">
                                Penanggung Jawab {{ $ruangan->nama }}
                            </p>
                        </div>
                    @elseif($currentSesi && !$currentSesi->is_istirahat)
                        <div class="space-y-1">
                            <p class="text-xl {{ $isDarkMode ? 'text-gray-300' : 'text-gray-600' }} font-light">
                                {{ \Carbon\Carbon::parse($currentSesi->jam_mulai)->format('G:i') }} - {{ \Carbon\Carbon::parse($currentSesi->jam_selesai)->format('H:i') }}
                            </p>
                            <p class="text-2xl text-blue-500 font-semibold">
                                {{ $ruangan->penanggungJawab?->nama ?? 'Belum ditentukan' }}
                            </p>
                            <p class="text-lg {{ $isDarkMode ? 'text-gray-300' : 'text-gray-600' }} font-light">
                                Penanggung Jawab {{ $ruangan->nama }}
                            </p>
                        </div>
                    @elseif($isBelumDimulai)
                        <div class="space-y-1">
                            <p class="text-2xl text-blue-400 font-semibold">
                                {{ $ruangan->penanggungJawab?->nama ?? 'Belum ditentukan' }}
                            </p>
                            <p class="text-lg text-gray-300 font-light">
                                Penanggung Jawab {{ $ruangan->nama }}
                            </p>
                        </div>
                    @else
                        <div class="space-y-1">
                            <p class="text-2xl text-blue-400 font-semibold">
                                {{ $ruangan->penanggungJawab?->nama ?? 'Belum ditentukan' }}
                            </p>
                            <p class="text-lg text-gray-300 font-light">
                                Penanggung Jawab {{ $ruangan->nama }}
                            </p>
                        </div>
                    @endif

                    <!-- Lab Name -->
                    <p class="text-2xl font-bold {{ $isIsht2 ? 'text-white' : ($isDarkMode ? 'text-white' : 'text-gray-800') }} mt-4 content-lab">
                        {{ $ruangan->nama }}
                    </p>
                </div>

                <!-- Teacher/PJ Photo (hidden during ISHT 2 with video) -->
                @if(!$isIsht2)
                <div class="flex-shrink-0 absolute right-0 bottom-0 photo-container">
                    @php
                        // Determine which photo to show
                        $showGuru = $isPembelajaranAktif;
                        $foto = null;
                        
                        if ($showGuru && $jadwalSekarang->guru->foto) {
                            $foto = asset('storage/' . $jadwalSekarang->guru->foto);
                        } elseif ($ruangan->penanggungJawab && $ruangan->penanggungJawab->foto) {
                            $foto = asset('storage/' . $ruangan->penanggungJawab->foto);
                        }
                    @endphp
                    
                    @if($foto)
                        <img src="{{ $foto }}" alt="Foto" class="h-[85vh] w-auto object-cover object-top">
                    @else
                        <div class="h-[85vh] w-80 bg-gradient-to-t from-gray-700 to-transparent flex items-end justify-center pb-12">
                            <svg class="w-48 h-48 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                @endif

                <!-- Dropdown Pindah Lab -->
                <div class="absolute top-8 right-8 {{ $isIsht2 ? 'z-10' : '' }} dropdown-animate">
                    <div class="relative">
                        <select id="ruanganSelect" onchange="changeRuangan(this.value)" 
                            class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-10 text-gray-700 font-medium cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm transition-smooth hover:shadow-md">
                            <option value="" disabled>Pindah</option>
                            @foreach($allRuangan as $r)
                                <option value="{{ $r->id }}" {{ $r->id == $ruangan->id ? 'selected' : '' }}>
                                    {{ $r->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Page transition animation
        document.addEventListener('DOMContentLoaded', function() {
            // Add loaded class to body for initial animations
            document.body.classList.add('page-loaded');
        });

        function changeRuangan(ruanganId) {
            // Add fade out animation before navigation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                window.location.href = '{{ route("information-lab.index") }}?ruangan_id=' + ruanganId;
            }, 300);
        }

        // Update clock every second
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes();
            const minutesStr = minutes.toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const timeStr = hours.toString().padStart(2, '0') + ':' + minutesStr;
            
            const clockElement = document.getElementById('digitalClock');
            clockElement.innerHTML = timeStr + ' <span class="text-6xl font-semibold">' + ampm + '</span>';
        }
        
        setInterval(updateClock, 1000);
        updateClock();

        // Ensure video loops continuously during ISHT 2
        @if($isIsht2)
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('bgVideo');
            if (video) {
                // Ensure video plays
                video.play().catch(function(error) {
                    console.log('Video autoplay failed:', error);
                });
                
                // Restart video when it ends (backup for loop attribute)
                video.addEventListener('ended', function() {
                    video.currentTime = 0;
                    video.play();
                });
                
                // Keep video playing if paused
                setInterval(function() {
                    if (video.paused) {
                        video.play();
                    }
                }, 1000);
            }
        });
        @endif

        // Live update with fade transition (every 30 seconds)
        @if(!$isIsht2 && !($isPreviewMode ?? false))
        setInterval(() => {
            // Fade out before reload
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                location.reload();
            }, 500);
        }, 30000);
        @endif

        // Add fade in on page load
        window.addEventListener('load', function() {
            document.body.style.opacity = '1';
            document.body.style.transition = 'opacity 0.5s ease';
        });

        // Set initial opacity for fade in effect
        document.body.style.opacity = '0';
    </script>
</body>
</html>