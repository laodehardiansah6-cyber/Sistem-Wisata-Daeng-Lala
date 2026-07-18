@if(Auth::check() && Auth::user()->role === 'admin')
    <!-- ========================================== -->
    <!-- MENU SIDEBAR ADMIN — Nuansa Pantai & Laut -->
    <!-- ========================================== -->
    <nav class="w-64 flex-shrink-0 bg-gradient-to-b from-cyan-600 via-sky-700 to-blue-900 flex flex-col h-full shadow-xl relative overflow-hidden">

        <!-- Ornamen gelembung cahaya laut -->
        <div class="absolute -right-10 top-20 w-40 h-40 bg-cyan-300/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 bottom-32 w-48 h-48 bg-sky-300/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Logo -->
        <div class="h-16 flex items-center justify-center border-b border-white/10 relative z-10 bg-white/5 backdrop-blur-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col leading-none hover:scale-105 transition-transform text-center mt-2">
                <span class="text-[10px] font-bold text-cyan-200 uppercase tracking-widest">Wisata</span>
                <span class="text-xl font-black text-white tracking-tighter">Daeng <span class="text-cyan-300">Lala</span></span>
            </a>
        </div>

        <!-- Menu -->
        <div class="flex-1 overflow-y-auto py-6 px-4 relative z-10">
            <div class="flex flex-col space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    🏠 Dashboard Admin
                </a>

                <a href="{{ route('admin.pemesanan') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.pemesanan') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    📥 Pesanan Masuk
                </a>

                <a href="{{ route('admin.pemesanan.riwayat') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.pemesanan.riwayat') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    🗄️ Riwayat Transaksi
                </a>

                <a href="{{ route('fasilitas.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('fasilitas.*') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    🏨 Fasilitas
                </a>

                <a href="{{ route('kuliner.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('kuliner.*') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    🥘 Kuliner
                </a>

                <a href="{{ route('admin.ulasan.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.ulasan.*') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    ⭐ Data Ulasan
                </a>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.users') ? 'bg-white text-blue-800 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                    👥 Kelola User
                </a>
            </div>
        </div>

        <!-- Ombak dekoratif tipis di atas panel profil -->
        <svg class="relative z-10 -mb-1 text-white/5" viewBox="0 0 300 24" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,12 C50,24 100,0 150,10 C200,20 250,24 300,12 L300,24 L0,24 Z"></path>
        </svg>

        <!-- Profil Admin & Logout -->
        <div class="p-4 bg-white/95 backdrop-blur-md relative z-10 rounded-t-2xl">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 mb-4 hover:bg-cyan-50 p-2 rounded-xl transition-colors border border-transparent hover:border-cyan-100">
                <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-cyan-400 flex-shrink-0 shadow-sm shadow-cyan-400/50">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full bg-gradient-to-br from-cyan-400 to-blue-600 text-white flex items-center justify-center font-extrabold text-lg uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-extrabold text-blue-950 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-cyan-600 uppercase font-bold tracking-wider">Admin</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-center px-4 py-2 text-sm font-bold text-red-500 bg-red-50 hover:bg-red-500 hover:text-white border border-red-100 rounded-xl transition-all shadow-sm">
                    Keluar
                </a>
            </form>
        </div>
    </nav>
@else
    <!-- ========================================== -->
    <!-- MENU ATAS USER — Nuansa Pantai & Laut     -->
    <!-- ========================================== -->
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-cyan-600 via-sky-600 to-blue-700 shadow-lg relative z-50 overflow-hidden">

        <!-- Ornamen gelembung cahaya laut -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute left-1/3 -bottom-16 w-48 h-48 bg-cyan-300/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo Wisata Daeng Lala -->
                    <div class="shrink-0 flex items-center mr-6">
                        <a href="{{ route('dashboard') }}" class="flex flex-col leading-none hover:scale-105 transition-transform text-center group">
                            <span class="text-[10px] font-bold text-cyan-100 uppercase tracking-widest">Wisata</span>
                            <span class="text-xl font-black text-white tracking-tighter">Daeng <span class="text-cyan-200 group-hover:text-white transition-colors">Lala</span></span>
                        </a>
                    </div>

                    <!-- Link Menu Pengunjung -->
                    <div class="hidden space-x-1 sm:-my-px sm:ms-6 sm:flex sm:items-center">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-white text-blue-700 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                            Beranda
                        </a>
                        <a href="{{ route('user.fasilitas') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('user.fasilitas') ? 'bg-white text-blue-700 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                            Fasilitas Pantai
                        </a>
                        <a href="{{ route('user.kuliner') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('user.kuliner') ? 'bg-white text-blue-700 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                            Kuliner
                        </a>
                        <a href="{{ route('user.riwayat') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('user.riwayat') ? 'bg-white text-blue-700 shadow-md' : 'text-cyan-50 hover:bg-white/10' }}">
                            Pesanan Saya
                        </a>
                    </div>
                </div>

                <!-- Bagian Profil User Kanan Atas -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-full hover:bg-white/10 transition border border-transparent hover:border-white/20">
                        <div class="h-8 w-8 rounded-full overflow-hidden border-2 border-white/60 flex-shrink-0 shadow-sm">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-cyan-300 to-blue-500 text-white flex items-center justify-center font-extrabold text-sm uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <span class="text-sm font-bold text-white">{{ Auth::user()->name }}</span>
                    </a>

                    <div class="h-6 w-px bg-white/20"></div>

                    <!-- Tombol Log Out -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="inline-flex items-center justify-center px-4 py-2 bg-white/10 text-white hover:bg-red-500 font-bold text-xs uppercase tracking-wider rounded-full transition-all border border-white/20 shadow-sm hover:shadow-md">
                            Keluar
                        </a>
                    </form>

                </div>

                <!-- Tombol hamburger mobile -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-lg text-white hover:bg-white/10 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Ombak dekoratif di bagian bawah navbar -->
        <svg class="relative z-10 -mb-1 text-white/10" viewBox="0 0 1440 24" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,12 C240,24 480,0 720,10 C960,20 1200,24 1440,12 L1440,24 L0,24 Z"></path>
        </svg>

        <!-- Menu Mobile -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden relative z-10 bg-blue-700/95 backdrop-blur-sm border-t border-white/10">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('dashboard') ? 'bg-white text-blue-700' : 'text-cyan-50 hover:bg-white/10' }}">Beranda</a>
                <a href="{{ route('user.fasilitas') }}" class="block px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('user.fasilitas') ? 'bg-white text-blue-700' : 'text-cyan-50 hover:bg-white/10' }}">Fasilitas Pantai</a>
                <a href="{{ route('user.kuliner') }}" class="block px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('user.kuliner') ? 'bg-white text-blue-700' : 'text-cyan-50 hover:bg-white/10' }}">Kuliner</a>
                <a href="{{ route('user.riwayat') }}" class="block px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('user.riwayat') ? 'bg-white text-blue-700' : 'text-cyan-50 hover:bg-white/10' }}">Pesanan Saya</a>
            </div>

            <div class="pt-4 pb-3 border-t border-white/10 px-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 mb-3">
                    <div class="h-9 w-9 rounded-full overflow-hidden border-2 border-white/60 flex-shrink-0">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-cyan-300 to-blue-500 text-white flex items-center justify-center font-extrabold text-sm uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <span class="text-sm font-bold text-white">{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block text-center px-4 py-2 bg-white/10 text-white font-bold text-xs uppercase tracking-wider rounded-lg hover:bg-red-500 transition">
                        Keluar
                    </a>
                </form>
            </div>
        </div>
    </nav>
@endif