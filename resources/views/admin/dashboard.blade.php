<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengelola Wisata Pondok Daeng Lala') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-cyan-50 via-sky-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- ============================== -->
            <!-- HERO CARD BERNUANSA LAUT       -->
            <!-- ============================== -->
            <div class="relative overflow-hidden rounded-3xl shadow-xl mb-8 text-white bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800">

                <!-- Ornamen gelembung / cahaya laut -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-24 top-10 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
                <div class="absolute left-1/3 -bottom-20 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

                <!-- Ombak dekoratif di bagian bawah hero -->
                <svg class="absolute bottom-0 left-0 w-full text-white/10" viewBox="0 0 1440 120" fill="currentColor" preserveAspectRatio="none">
                    <path d="M0,64 C240,120 480,0 720,32 C960,64 1200,112 1440,64 L1440,120 L0,120 Z"></path>
                </svg>
                <svg class="absolute bottom-0 left-0 w-full text-white/5" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
                    <path d="M0,40 C320,100 640,0 960,40 C1200,70 1320,20 1440,40 L1440,100 L0,100 Z"></path>
                </svg>

                <div class="relative z-10 p-8 md:p-10">
                    <div class="flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4-3-7-6.5-7-10a7 7 0 1114 0c0 3.5-3 7-7 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                        Pantai Lakeba • Kota Baubau
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-cyan-50/90 text-lg max-w-xl">Kelola sistem informasi Wisata Pondok Daeng Lala — dari fasilitas, kuliner, hingga pesanan pengunjung, semua dalam satu dashboard.</p>
                </div>
            </div>

            <!-- ============================== -->
            <!-- STAT CARDS                     -->
            <!-- ============================== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- Pesanan -->
                <div class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-125 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pesanan</h5>
                        <p class="text-4xl font-extrabold text-blue-600 mt-1 mb-3">{{ $total_pesanan ?? 0 }}</p>
                        <a href="{{ route('admin.pemesanan') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800">
                            Kelola <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-125 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-11 h-11 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Fasilitas</h5>
                        <p class="text-4xl font-extrabold text-indigo-600 mt-1 mb-3">{{ $total_fasilitas ?? 0 }}</p>
                        <a href="{{ route('fasilitas.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                            Lihat <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Kuliner -->
                <div class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-125 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-11 h-11 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                        </div>
                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kuliner</h5>
                        <p class="text-4xl font-extrabold text-orange-600 mt-1 mb-3">{{ $total_kuliner ?? 0 }}</p>
                        <a href="{{ route('kuliner.index') }}" class="inline-flex items-center text-sm font-semibold text-orange-600 hover:text-orange-800">
                            Kelola <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Ulasan -->
                <div class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full group-hover:scale-125 transition-transform duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-11 h-11 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ulasan</h5>
                        <p class="text-4xl font-extrabold text-teal-600 mt-1 mb-3">{{ $total_ulasan ?? 0 }}</p>
                        <a href="{{ route('admin.ulasan.index') }}" class="inline-flex items-center text-sm font-semibold text-teal-600 hover:text-teal-800">
                            Lihat <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================== -->
            <!-- PANEL KONTROL                  -->
            <!-- ============================== -->
            <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 md:p-8">
                <!-- Garis ombak tipis di header panel -->
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16c1.5-2 3.5-2 5 0s3.5 2 5 0 3.5-2 5 0 3.5 2 5 0M3 12c1.5-2 3.5-2 5 0s3.5 2 5 0 3.5-2 5 0 3.5 2 5 0"/></svg>
                    <h3 class="text-lg font-bold text-gray-800">Panel Kontrol</h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('fasilitas.index') }}"
                       class="flex flex-col items-center justify-center gap-2 py-6 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-wider shadow-sm shadow-indigo-200 transition-all hover:-translate-y-0.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                        Fasilitas
                    </a>
                    <a href="{{ route('kuliner.index') }}"
                       class="flex flex-col items-center justify-center gap-2 py-6 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold uppercase tracking-wider shadow-sm shadow-orange-200 transition-all hover:-translate-y-0.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                        Kuliner
                    </a>
                    <a href="{{ route('admin.pemesanan') }}"
                       class="flex flex-col items-center justify-center gap-2 py-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold uppercase tracking-wider shadow-sm shadow-blue-200 transition-all hover:-translate-y-0.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                        Transaksi
                    </a>
                    <a href="{{ route('admin.ulasan.index') }}"
                       class="flex flex-col items-center justify-center gap-2 py-6 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold uppercase tracking-wider shadow-sm shadow-teal-200 transition-all hover:-translate-y-0.5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Data Ulasan
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>