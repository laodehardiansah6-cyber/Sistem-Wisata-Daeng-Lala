<x-app-layout>
    <!-- Bagian Header/Hero Galeri -->
    <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 pb-20 pt-12 shadow-inner">
        <!-- Ornamen gelembung cahaya laut -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute right-32 top-6 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
        <div class="absolute left-1/4 -bottom-24 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4-3-7-6.5-7-10a7 7 0 1114 0c0 3.5-3 7-7 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                Pantai Lakeba • Daeng Lala
            </div>
            <h2 class="text-4xl font-black text-white tracking-tight mb-3 drop-shadow-md">Galeri Wisata</h2>
            <p class="text-cyan-50/90 text-lg font-medium max-w-xl mx-auto drop-shadow-sm">Dokumentasi keindahan dan keseruan di Pondok Daeng Lala</p>
        </div>

        <!-- Ombak dekoratif pemisah -->
        <svg class="absolute -bottom-1 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
        </svg>
    </div>

    <!-- Bagian Konten Galeri -->
    <div class="bg-gradient-to-b from-cyan-50 via-sky-50 to-white py-10 -mt-12 relative z-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($galeris->isEmpty())
                <!-- Tampilan Jika Galeri Sedang Kosong -->
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl p-16 text-center max-w-2xl mx-auto border border-cyan-100">
                    <div class="w-28 h-28 bg-gradient-to-br from-cyan-100 to-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-cyan-100">
                        <span class="text-5xl">📸</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-blue-950 mb-3">Belum Ada Foto</h3>
                    <p class="text-gray-500 text-lg">Album kenangan kita masih kosong. Nanti foto-foto keindahan pantai dan kuliner akan ditampilkan di sini.</p>
                </div>
            @else
                <!-- Grid Foto Galeri -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galeris as $galeri)
                        <div class="relative group rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border border-cyan-100 bg-gray-200">
                            <!-- Gambar -->
                            <img src="{{ asset($galeri->gambar) }}" alt="{{ $galeri->judul_foto }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">

                            <!-- Overlay Judul (Muncul saat di-hover) -->
                            @if($galeri->judul_foto)
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-4 w-full">
                                    <h3 class="text-white font-bold text-lg drop-shadow-md truncate">{{ $galeri->judul_foto }}</h3>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>