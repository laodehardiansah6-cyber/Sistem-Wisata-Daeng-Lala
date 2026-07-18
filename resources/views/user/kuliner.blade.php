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
        <!-- HERO BANNER BERNUANSA LAUT     -->
        <!-- ============================== -->
        <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 text-white">
            <!-- Ornamen gelembung / cahaya laut -->
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-32 top-6 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
            <div class="absolute left-1/4 -bottom-24 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-12 pb-20">
                <div class="flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                    Pantai Lakeba • Daeng Lala
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Daftar Menu Kuliner Khas</h1>
                <p class="text-cyan-50/90 max-w-xl">Nikmati seafood bakar dan hidangan khas pesisir hasil tangkapan langsung nelayan Daeng Lala.</p>
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
                <form method="GET" action="{{ route('user.kuliner') }}" class="flex flex-col md:flex-row gap-4">

                    <div class="flex-grow relative">
                        <svg class="w-4 h-4 text-orange-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari menu (misal: Ikan Bakar Ruma-Ruma, Parende...)" class="w-full pl-9 rounded-xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                    </div>

                    <div class="md:w-48">
                        <select name="status" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm text-gray-600">
                            <option value="">Semua Status</option>
                            <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia Saja</option>
                            <option value="Habis" {{ request('status') == 'Habis' ? 'selected' : '' }}>Sedang Habis</option>
                        </select>
                    </div>

                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold rounded-xl hover:from-orange-600 hover:to-red-600 transition shadow-sm shadow-orange-200 text-sm">
                        Cari Menu
                    </button>

                    @if(request('cari') || request('status'))
                        <a href="{{ route('user.kuliner') }}" class="px-4 py-2 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition shadow-sm text-sm text-center border border-red-100 whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- ============================== -->
            <!-- GRID MENU KULINER              -->
            <!-- ============================== -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @forelse($kuliners as $item)
                    <div x-data="{ openModal: false, openReview: false }" class="group bg-white rounded-2xl shadow-sm border border-cyan-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative">

                        <div class="relative">
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_menu }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-40 bg-gradient-to-br from-orange-100 to-amber-200 flex items-center justify-center text-orange-500">
                                    <svg class="w-8 h-8 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-md font-bold text-gray-800">{{ $item->nama_menu }}</h3>
                            <p class="text-xs text-gray-500 mt-1 mb-2 line-clamp-2">{{ $item->deskripsi ?? 'Menu lezat khas pesisir.' }}</p>

                            <div class="flex items-center mb-3 cursor-pointer bg-amber-50 hover:bg-amber-100 transition px-2 py-1 rounded-lg w-max border border-amber-100" @click="openModal = true">
                                <div class="text-yellow-500 font-bold text-xs flex items-center gap-1">
                                    ⭐ {{ number_format($item->avg_rating ?? 0, 1) }}
                                </div>
                                <span class="text-[10px] text-gray-500 ml-2 font-medium">(Lihat semua ulasan)</span>
                            </div>

                            <div class="mb-4">
                                <button @click="openReview = !openReview" type="button" class="text-[11px] font-semibold text-cyan-700 hover:text-cyan-900 transition flex items-center gap-1">
                                    <span x-show="!openReview">+ Tulis Ulasan</span>
                                    <span x-show="openReview" x-cloak>Tutup Form &uarr;</span>
                                </button>
                            </div>

                            <div x-show="openReview" x-transition x-cloak class="mb-4 p-3 bg-cyan-50/60 rounded-xl border border-cyan-100">
                                <form action="{{ route('ulasan.store') }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="jenis" value="Makanan">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                                    <div class="mb-2">
                                        <p class="text-[11px] font-bold text-gray-600 mb-1">Pilih Bintang:</p>
                                        <div class="star-rating flex flex-row-reverse justify-end">
                                            <input type="radio" id="star5_{{$item->id}}" name="rating" value="5" required/>
                                            <label for="star5_{{$item->id}}" title="5 Bintang">&#9733;</label>

                                            <input type="radio" id="star4_{{$item->id}}" name="rating" value="4" />
                                            <label for="star4_{{$item->id}}" title="4 Bintang">&#9733;</label>

                                            <input type="radio" id="star3_{{$item->id}}" name="rating" value="3" />
                                            <label for="star3_{{$item->id}}" title="3 Bintang">&#9733;</label>

                                            <input type="radio" id="star2_{{$item->id}}" name="rating" value="2" />
                                            <label for="star2_{{$item->id}}" title="2 Bintang">&#9733;</label>

                                            <input type="radio" id="star1_{{$item->id}}" name="rating" value="1" />
                                            <label for="star1_{{$item->id}}" title="1 Bintang">&#9733;</label>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <textarea name="komentar" rows="2" placeholder="Tulis pendapat Anda tentang menu ini..." class="w-full text-xs rounded-lg border-gray-200 focus:border-orange-500 focus:ring-orange-500 p-2" required></textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 to-blue-700 text-white text-xs font-bold py-2 rounded-lg hover:from-cyan-700 hover:to-blue-800 transition">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>

                            <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition x-cloak>
                                <div class="bg-white p-6 rounded-2xl w-96 max-h-[80vh] overflow-y-auto shadow-xl border border-cyan-100" @click.away="openModal = false">
                                    <div class="flex items-center justify-between border-b border-cyan-100 pb-3 mb-4">
                                        <h3 class="font-bold text-lg text-gray-800">Ulasan {{ $item->nama_menu }}</h3>
                                        <span class="text-sm font-bold text-yellow-500">⭐ {{ number_format($item->avg_rating ?? 0, 1) }}</span>
                                    </div>

                                    <div class="space-y-3">
                                        @forelse(\App\Models\Ulasan::where('item_id', $item->id)->where('jenis', 'Makanan')->latest()->get() as $ulasan)
                                            <div class="border-b border-gray-100 pb-2 last:border-0 text-sm">
                                                <div class="flex items-center justify-between">
                                                    <p class="font-bold text-gray-700">{{ $ulasan->user->name ?? 'Anonim' }}</p>
                                                    <span class="text-yellow-500 text-xs font-semibold">⭐ {{ $ulasan->rating }}</span>
                                                </div>
                                                <p class="text-gray-600 text-xs mt-1">{{ $ulasan->komentar ?? 'Tidak ada komentar tertulis.' }}</p>
                                            </div>
                                        @empty
                                            <p class="text-xs text-gray-400 text-center py-4">Belum ada ulasan untuk menu ini.</p>
                                        @endforelse
                                    </div>

                                    <button @click="openModal = false" class="mt-5 w-full bg-cyan-50 hover:bg-cyan-100 text-cyan-700 font-bold py-2 rounded-xl text-sm transition border border-cyan-100">
                                        Tutup
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col mt-auto border-t border-cyan-100 pt-3">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="font-extrabold text-orange-600 text-lg">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    @if($item->status == 'Tersedia')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase shadow-sm">Tersedia</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-[10px] font-bold uppercase shadow-sm">Habis</span>
                                    @endif
                                </div>

                                @if($item->status == 'Tersedia')
                                    <a href="{{ route('user.booking', ['jenis' => 'Makanan', 'item_nama' => $item->nama_menu, 'harga' => $item->harga]) }}" class="w-full block text-center px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white text-sm font-bold rounded-lg hover:from-orange-600 hover:to-red-600 transition shadow-sm shadow-orange-200">
                                        + Tambah Pesanan
                                    </a>
                                @else
                                    <button disabled class="w-full text-center px-4 py-2 bg-gray-200 text-gray-500 text-sm font-bold rounded-lg cursor-not-allowed">
                                        Sedang Kosong
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4">
                        <div class="bg-white rounded-2xl border border-cyan-100 shadow-sm py-16 px-6 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-orange-50 flex items-center justify-center">
                                <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                            </div>
                            <p class="text-gray-700 font-bold text-lg">Menu tidak ditemukan.</p>
                            <p class="text-gray-400 text-sm mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>