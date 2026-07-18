@if(Auth::check() && Auth::user()->role === 'admin')
    <!-- ========================================== -->
    <!-- MENU SIDEBAR ADMIN -->
    <!-- ========================================== -->
    <nav class="w-64 flex-shrink-0 bg-gradient-to-b from-white via-cyan-50 to-blue-100 border-r border-cyan-200 flex flex-col h-full shadow-lg shadow-cyan-200/50 relative overflow-hidden">
        
        <!-- Ornamen Ombak Tipis di Latar Belakang -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-cyan-200/40 to-transparent pointer-events-none"></div>

        <div class="h-16 flex items-center justify-center border-b border-cyan-200/60 relative z-10 bg-white/50 backdrop-blur-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col leading-none hover:scale-105 transition-transform text-center mt-2">
                <span class="text-[10px] font-bold text-cyan-600 uppercase tracking-widest">Wisata</span>
                <span class="text-xl font-black text-blue-900 tracking-tighter">Daeng <span class="text-cyan-500">Lala</span></span>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 relative z-10">
            <div class="flex flex-col space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-500 text-white shadow-md shadow-cyan-500/30' : 'text-blue-900 hover:bg-cyan-100 hover:text-cyan-800' }}">🏠 Dashboard Admin</a>
                
                <a href="{{ route('admin.pemesanan') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('admin.pemesanan') ? 'bg-blue-500 text-white shadow-md shadow-blue-500/30' : 'text-blue-900 hover:bg-blue-100 hover:text-blue-800' }}">📥 Pesanan Masuk</a>
                
                <!-- TAMBAHAN MENU RIWAYAT TRANSAKSI -->
                <a href="{{ route('admin.pemesanan.riwayat') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('admin.pemesanan.riwayat') ? 'bg-blue-700 text-white shadow-md shadow-blue-700/30' : 'text-blue-900 hover:bg-blue-200 hover:text-blue-900' }}">🗄️ Riwayat Transaksi</a>

                <a href="{{ route('fasilitas.index') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('fasilitas.*') ? 'bg-indigo-500 text-white shadow-md shadow-indigo-500/30' : 'text-blue-900 hover:bg-indigo-100 hover:text-indigo-800' }}">🏨 Fasilitas</a>
                
                <a href="{{ route('kuliner.index') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('kuliner.*') ? 'bg-cyan-600 text-white shadow-md shadow-cyan-600/30' : 'text-blue-900 hover:bg-cyan-200 hover:text-cyan-900' }}">🥘 Kuliner</a>
                
                <a href="{{ route('admin.ulasan.index') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('admin.ulasan.*') ? 'bg-teal-500 text-white shadow-md shadow-teal-500/30' : 'text-blue-900 hover:bg-teal-100 hover:text-teal-800' }}">⭐ Data Ulasan</a>
                
                <a href="{{ route('admin.users') }}" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all {{ request()->routeIs('admin.users') ? 'bg-blue-800 text-white shadow-md shadow-blue-800/30' : 'text-blue-900 hover:bg-blue-200 hover:text-blue-900' }}">👥 Kelola User</a>
            </div>
        </div>

        <!-- Profil Admin & Logout (Nuansa Pasir/Terang) -->
        <div class="border-t border-cyan-200/60 p-4 bg-white/60 backdrop-blur-md relative z-10">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 mb-4 hover:bg-cyan-50 p-2 rounded-lg transition-colors border border-transparent hover:border-cyan-100">
                <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-cyan-400 flex-shrink-0 shadow-sm shadow-cyan-400/50">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full bg-gradient-to-br from-cyan-300 to-blue-500 text-white flex items-center justify-center font-extrabold text-lg uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-extrabold text-blue-950 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-cyan-600 uppercase font-bold tracking-wider">Kapten Admin</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-center px-4 py-2 text-sm font-bold text-red-500 bg-red-50 hover:bg-red-500 hover:text-white border border-red-100 rounded-lg transition-all shadow-sm">Berlabuh (Keluar)</a>
            </form>
        </div>
    </nav>
@else
    <!-- ========================================== -->
    <!-- MENU ATAS USER   -->
    <!-- ========================================== -->
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-cyan-50 via-white to-blue-50 border-b border-cyan-200 shadow-md shadow-cyan-100/50 relative z-50">
        
        <!-- Garis Tipis "Cakrawala Laut" di Paling Atas -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 via-blue-500 to-cyan-400"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-1">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo Wisata Daeng Lala -->
                    <div class="shrink-0 flex items-center mr-6">
                        <a href="{{ route('dashboard') }}" class="flex flex-col leading-none hover:scale-105 transition-transform text-center mt-1 group">
                            <span class="text-[10px] font-bold text-cyan-600 uppercase tracking-widest group-hover:text-cyan-500 transition-colors">Wisata</span>
                            <span class="text-xl font-black text-blue-900 tracking-tighter">Daeng <span class="text-cyan-500 group-hover:text-cyan-400 transition-colors">Lala</span></span>
                        </a>
                    </div>

                    <!-- Link Menu Pengunjung -->
                    <div class="hidden space-x-6 sm:-my-px sm:ms-6 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="{{ request()->routeIs('dashboard') ? 'text-cyan-700 border-cyan-500' : 'text-blue-800 hover:text-cyan-600 hover:border-cyan-300' }}">
                            {{ __('Beranda') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.fasilitas')" :active="request()->routeIs('user.fasilitas')" class="{{ request()->routeIs('user.fasilitas') ? 'text-cyan-700 border-cyan-500' : 'text-blue-800 hover:text-cyan-600 hover:border-cyan-300' }}">
                            {{ __('Fasilitas Pantai') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.kuliner')" :active="request()->routeIs('user.kuliner')" class="{{ request()->routeIs('user.kuliner') ? 'text-cyan-700 border-cyan-500' : 'text-blue-800 hover:text-cyan-600 hover:border-cyan-300' }}">
                            {{ __('Kuliner') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.riwayat')" :active="request()->routeIs('user.riwayat')" class="{{ request()->routeIs('user.riwayat') ? 'text-cyan-700 border-cyan-500' : 'text-blue-800 hover:text-cyan-600 hover:border-cyan-300' }}">
                            {{ __('Pesanan Saya') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Bagian Profil User Kanan Atas -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-full hover:bg-cyan-100/50 transition border border-transparent hover:border-cyan-200">
                        <div class="h-8 w-8 rounded-full overflow-hidden border-2 border-cyan-300 flex-shrink-0 shadow-sm">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-cyan-400 to-blue-500 text-white flex items-center justify-center font-extrabold text-sm uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <span class="text-sm font-bold text-blue-900">{{ Auth::user()->name }}</span>
                    </a>

                    <!-- Garis Pembatas Vertikal (Warna Pasir / Cream tipis) -->
                    <div class="h-6 w-px bg-cyan-200"></div>

                    <!-- Tombol Log Out -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); this.closest('form').submit();" 
                           class="inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white font-bold text-xs uppercase tracking-wider rounded-full transition-all border border-red-200 shadow-sm hover:shadow-md">
                            Keluar
                        </a>
                    </form>
                    
                </div>
            </div>
        </div>
    </nav>
@endif