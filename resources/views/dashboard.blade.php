<x-app-layout>

    <!-- HERO SECTION: Menampilkan pesona utama Daeng Lala -->
    <div class="relative w-full h-[calc(100vh-4rem)] flex items-center justify-start overflow-hidden">
        <!-- Foto latar utama dengan efek gelap -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/lakeba.jpeg') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/60 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-transparent to-gray-900/40"></div>

        <!-- Konten Teks -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <p class="text-cyan-400 font-bold tracking-widest uppercase mb-3 text-sm md:text-base drop-shadow-md">
                Pantai Lakeba, Batubuti • Kota Baubau
            </p>

            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6 tracking-tight max-w-3xl drop-shadow-lg">
                JELAJAHI PESONA <br>
                <span class="text-cyan-400">DAENG LALA</span>
            </h1>

            <p class="text-lg text-gray-200 mb-10 max-w-xl leading-relaxed drop-shadow-md">
                Halo, {{ Auth::user()->name }}! Nikmati suasana pesisir Pantai Lakeba yang tenang, hanya sekitar 15 menit dari pusat Kota Baubau. Rasakan gazebo tepi laut, aktivitas memancing, sunset yang memukau, dan seafood bakar khas Pondok Daeng Lala.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('user.fasilitas') }}" class="px-8 py-4 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold uppercase tracking-wider rounded-xl transition transform hover:-translate-y-1 shadow-lg shadow-cyan-500/30">
                    Jelajahi Sekarang
                </a>
                <a href="{{ route('user.kuliner') }}" class="px-8 py-4 bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white text-sm font-bold uppercase tracking-wider rounded-xl transition transform hover:-translate-y-1">
                    Lihat Menu
                </a>
            </div>
        </div>

        <!-- Indikator scroll -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>

        <!-- Ombak pemisah menuju section berikutnya -->
        <svg class="absolute -bottom-1 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
        </svg>
    </div>

    <!-- REKOMENDASI / HIGHLIGHT -->
    <div class="bg-gradient-to-b from-cyan-50 via-sky-50 to-white py-16 w-full">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row gap-12 items-center">

                <!-- Kumpulan Gambar (Kiri) -->
                <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="group relative bg-white p-2 rounded-xl shadow-sm border border-cyan-100 hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="overflow-hidden rounded-lg mb-3">
                            <img src="{{ asset('images/padelboard.jpeg') }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm px-1">Paddle Board Lakeba</h4>
                    </div>
                    <div class="group relative bg-white p-2 rounded-xl shadow-sm border border-cyan-100 hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="overflow-hidden rounded-lg mb-3">
                            <img src="{{ asset('images/kapal.jpeg') }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm px-1">Perahu & Snorkeling</h4>
                    </div>
                    <div class="group relative bg-white p-2 rounded-xl shadow-sm border border-cyan-100 hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="overflow-hidden rounded-lg mb-3">
                            <img src="{{ asset('images/batuputi.jpeg') }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm px-1">Batu Buti</h4>
                    </div>
                </div>

                <!-- Teks Informasi (Kanan) -->
                <div class="lg:w-1/3">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Pesona Pantai Lakeba yang Wajib Dikunjungi</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Terletak di Kelurahan Katobengke, Kecamatan Betoambari, Kota Baubau, Pondok Daeng Lala menyuguhkan panorama pesisir yang bersih dan asri, lengkap dengan spot paddle board, wisata perahu & snorkeling, hingga tebing karang ikonik Batu Buti.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center"><span class="text-3xl font-black text-blue-700 w-16">15'</span> <span class="text-gray-600 font-medium">Menit dari pusat kota</span></div>
                        <div class="flex items-center"><span class="text-3xl font-black text-blue-700 w-16">10+</span> <span class="text-gray-600 font-medium">Gazebo nyaman</span></div>
                    </div>

                    <a href="{{ route('user.fasilitas') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-cyan-400/30 transition transform hover:-translate-y-1">
                        Jelajahi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>