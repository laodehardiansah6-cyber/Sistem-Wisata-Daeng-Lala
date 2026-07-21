<x-app-layout>
    <!-- Bagian Header/Hero Promo -->
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
            <h2 class="text-4xl font-black text-white tracking-tight mb-3 drop-shadow-md">Promo Spesial Daeng Lala</h2>
            <p class="text-cyan-50/90 text-lg font-medium max-w-xl mx-auto drop-shadow-sm">Nikmati penawaran eksklusif dan potongan harga untuk liburan Anda di pesisir Pantai Lakeba!</p>
        </div>

        <!-- Ombak dekoratif pemisah -->
        <svg class="absolute -bottom-1 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
        </svg>
    </div>

    <!-- Bagian Konten Promo -->
    <div class="bg-gradient-to-b from-cyan-50 via-sky-50 to-white py-10 -mt-12 relative z-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($promos->isEmpty())
                <!-- Tampilan Jika Promo Sedang Kosong -->
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl p-16 text-center max-w-2xl mx-auto border border-cyan-100">
                    <div class="w-28 h-28 bg-gradient-to-br from-cyan-100 to-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-cyan-100">
                        <span class="text-5xl">🎫</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-blue-950 mb-3">Belum Ada Promo Aktif</h3>
                    <p class="text-gray-500 text-lg">Pantau terus halaman ini, ya! Kami akan segera menghadirkan kejutan penawaran menarik untuk liburan Anda berikutnya.</p>
                </div>
            @else
                <!-- Grid Daftar Promo -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($promos as $promo)
                        <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group border border-cyan-100 flex flex-col">
                            <!-- Gambar Promo -->
                            <div class="h-56 bg-gray-200 relative overflow-hidden">
                                @if($promo->gambar)
                                    <img src="{{ asset($promo->gambar) }}" alt="{{ $promo->judul_promo }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <!-- Gambar default jika admin tidak mengupload foto -->
                                    <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-700">
                                        <span class="text-6xl text-white/50 drop-shadow-md">🎁</span>
                                    </div>
                                @endif
                                <!-- gradasi tipis di atas gambar biar konsisten tema laut -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                                <!-- Badge Status -->
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-pink-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full shadow-lg uppercase tracking-widest border border-red-400/50">
                                    Berlaku
                                </div>
                            </div>

                            <!-- Detail Promo -->
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-extrabold text-gray-900 mb-2 leading-tight group-hover:text-blue-700 transition-colors">{{ $promo->judul_promo }}</h3>
                                <p class="text-gray-600 text-sm mb-6 flex-1">{{ $promo->deskripsi }}</p>

                                @if($promo->kode_promo)
                                <div class="mt-auto pt-5 border-t border-dashed border-cyan-200 bg-cyan-50/50 -mx-6 -mb-6 px-6 pb-6 pt-4">
                                    <p class="text-[11px] text-gray-500 mb-2 uppercase font-bold tracking-wider text-center">Gunakan Kode Kupon:</p>
                                    <div class="bg-white text-blue-700 font-mono font-black py-2.5 rounded-xl text-center border-2 border-cyan-200 tracking-[0.2em] text-lg shadow-sm">
                                        {{ $promo->kode_promo }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>