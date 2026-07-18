<x-app-layout>
    <style>
        .star-rating input { display: none; }
        .star-rating label { cursor: pointer; color: #D1D5DB; transition: color 0.2s; font-size: 1.5rem; line-height: 1; margin-right: 2px; }
        /* Efek bintang terisi dari kiri ke kanan */
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label { color: #FBBF24; }
    </style>

    <div class="min-h-screen bg-gradient-to-b from-cyan-50 via-sky-50 to-white">

        <!-- ============================== -->
        <!-- HERO BANNER -->
        <!-- ============================== -->
        <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 text-white">
            <!-- Ornamen gelembung / cahaya laut -->
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-32 top-6 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
            <div class="absolute left-1/4 -bottom-24 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-12 pb-20">
                <div class="flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4-3-7-6.5-7-10a7 7 0 1114 0c0 3.5-3 7-7 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    Pantai Lakeba • Daeng Lala
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Katalog Fasilitas & Alat Wisata</h1>
                <p class="text-cyan-50/90 max-w-xl">Sewa gazebo, paddle board, hingga alat mancing untuk liburanmu di pesisir Pantai Lakeba.</p>
            </div>

            <!-- Ombak dekoratif -->
            <svg class="absolute bottom-0 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
                <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 -mt-10 relative z-10 pb-16">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- ============================== -->
            <!-- FORM PENCARIAN                 -->
            <!-- ============================== -->
            <div class="mb-8 bg-white/90 backdrop-blur p-4 rounded-2xl shadow-lg border border-cyan-100">
                <form method="GET" action="{{ route('user.fasilitas') }}" class="flex flex-col md:flex-row gap-4">

                    <div class="flex-grow relative">
                        <svg class="w-4 h-4 text-cyan-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari fasilitas (misal: Gazebo, Alat Selam...)" class="w-full pl-9 rounded-xl border-gray-200 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm">
                    </div>

                    <div class="md:w-48">
                        <select name="status" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm text-gray-600">
                            <option value="">Semua Status</option>
                            <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia Saja</option>
                            <option value="Penuh" {{ request('status') == 'Penuh' ? 'selected' : '' }}>Sedang Penuh / Dipakai</option>
                        </select>
                    </div>

                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition shadow-sm shadow-cyan-200 text-sm">
                        Cari Fasilitas
                    </button>

                    @if(request('cari') || request('status'))
                        <a href="{{ route('user.fasilitas') }}" class="px-4 py-2 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition shadow-sm text-sm text-center border border-red-100 whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- ============================== -->
            <!-- GRID FASILITAS                 -->
            <!-- ============================== -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($fasilitas as $item)
                    <div x-data="{ openReview: false }" class="group bg-white rounded-2xl shadow-sm border border-cyan-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

                        <div class="relative">
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_fasilitas }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-cyan-100 to-sky-200 flex items-center justify-center text-cyan-600">
                                    <svg class="w-10 h-10 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                                </div>
                            @endif
                            <!-- gradasi tipis di atas gambar biar konsisten tema laut -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-white/90 backdrop-blur text-cyan-700 rounded-full text-xs font-bold shadow-sm">{{ $item->kategori }}</span>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-800 mt-1">{{ $item->nama_fasilitas }}</h3>
                            <p class="text-sm text-gray-600 mt-1 mb-4 flex-grow">{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                            <div class="mb-4">
                                <button @click="openReview = !openReview" type="button" class="text-xs font-bold text-cyan-700 hover:text-cyan-900 flex items-center gap-1 bg-cyan-50 px-2 py-1 rounded-lg w-max transition border border-cyan-100">
                                    <span x-show="!openReview">⭐ Beri Ulasan / Rating</span>
                                    <span x-show="openReview" x-cloak>Tutup Form Ulasan &uarr;</span>
                                </button>
                            </div>

                            <div x-show="openReview" x-transition x-cloak class="mb-4 p-3 bg-cyan-50/60 rounded-xl border border-cyan-100">
                                <form action="{{ route('ulasan.store') }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="jenis" value="Fasilitas">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                                    <div class="mb-2">
                                        <p class="text-[11px] font-bold text-gray-600 mb-1">Pilih Bintang:</p>
                                        <div class="star-rating flex flex-row-reverse justify-end">
                                            <input type="radio" id="f_star5_{{$item->id}}" name="rating" value="5" required/>
                                            <label for="f_star5_{{$item->id}}" title="5 Bintang">&#9733;</label>

                                            <input type="radio" id="f_star4_{{$item->id}}" name="rating" value="4" />
                                            <label for="f_star4_{{$item->id}}" title="4 Bintang">&#9733;</label>

                                            <input type="radio" id="f_star3_{{$item->id}}" name="rating" value="3" />
                                            <label for="f_star3_{{$item->id}}" title="3 Bintang">&#9733;</label>

                                            <input type="radio" id="f_star2_{{$item->id}}" name="rating" value="2" />
                                            <label for="f_star2_{{$item->id}}" title="2 Bintang">&#9733;</label>

                                            <input type="radio" id="f_star1_{{$item->id}}" name="rating" value="1" />
                                            <label for="f_star1_{{$item->id}}" title="1 Bintang">&#9733;</label>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <textarea name="komentar" rows="2" placeholder="Tulis pengalaman Anda menyewa fasilitas ini..." class="w-full text-xs rounded-lg border-gray-200 focus:border-cyan-500 focus:ring-cyan-500 p-2"></textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-blue-700 text-white text-xs font-bold py-2 rounded-lg hover:from-cyan-700 hover:to-blue-800 transition">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between border-t border-cyan-100 pt-4 mt-auto">
                                <span class="font-extrabold text-blue-700">Rp {{ number_format($item->harga, 0, ',', '.') }}<span class="text-xs font-normal text-gray-500"> / {{ $item->satuan }}</span></span>

                                <a href="{{ route('user.booking', ['jenis' => 'Fasilitas', 'item_nama' => $item->nama_fasilitas, 'harga' => $item->harga]) }}" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:from-cyan-600 hover:to-blue-700 transition shadow-sm shadow-cyan-200">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white rounded-2xl border border-cyan-100 shadow-sm py-16 px-6 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-cyan-50 flex items-center justify-center">
                                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                            </div>
                            <p class="text-gray-700 font-bold text-lg">Fasilitas tidak ditemukan.</p>
                            <p class="text-gray-400 text-sm mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>