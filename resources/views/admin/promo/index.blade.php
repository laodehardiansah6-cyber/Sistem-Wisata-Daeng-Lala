<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Promo') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-cyan-50 via-sky-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-sm font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- ============================== -->
            <!-- HERO CARD BERNUANSA LAUT       -->
            <!-- ============================== -->
            <div class="relative overflow-hidden rounded-3xl shadow-xl mb-8 text-white bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-24 top-10 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
                <div class="absolute left-1/3 -bottom-20 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

                <svg class="absolute bottom-0 left-0 w-full text-white/10" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
                    <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
                </svg>

                <div class="relative z-10 p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Pantai Lakeba • Daeng Lala
                        </div>
                        <h2 class="text-2xl md:text-3xl font-extrabold mb-1">Manajemen Promo</h2>
                        <p class="text-cyan-50/90 text-sm">Kelola penawaran dan kode kupon untuk pengunjung Daeng Lala.</p>
                    </div>

                    <a href="{{ route('promo.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-white text-blue-700 font-bold rounded-xl hover:bg-cyan-50 transition shadow-lg text-sm whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Promo
                    </a>
                </div>
            </div>

            <!-- ============================== -->
            <!-- TABEL PROMO                    -->
            <!-- ============================== -->
            <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-cyan-50 text-cyan-700 text-xs uppercase font-bold tracking-wider">
                                <th class="py-4 px-6">Gambar</th>
                                <th class="py-4 px-6">Judul Promo</th>
                                <th class="py-4 px-6">Kode</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-cyan-50">
                            @forelse($promos as $item)
                            <tr class="hover:bg-cyan-50/50 transition">
                                <td class="py-3 px-6">
                                    <img src="{{ asset($item->gambar) }}" class="w-20 h-16 object-cover rounded-xl shadow-sm border border-cyan-100">
                                </td>
                                <td class="py-3 px-6 font-bold text-gray-800">{{ $item->judul_promo }}</td>
                                <td class="py-3 px-6">
                                    <span class="bg-cyan-50 text-cyan-700 px-3 py-1 rounded-full font-mono text-sm border border-cyan-200">{{ $item->kode_promo ?? '-' }}</span>
                                </td>
                                <td class="py-3 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('promo.edit', $item->id) }}" class="w-9 h-9 flex items-center justify-center bg-amber-100 text-amber-600 rounded-lg hover:bg-amber-400 hover:text-white transition shadow-sm" title="Ubah Data">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>

                                        <form action="{{ route('promo.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus promo ini?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-9 h-9 flex items-center justify-center bg-red-100 text-red-600 rounded-lg hover:bg-red-500 hover:text-white transition shadow-sm" title="Hapus Data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-16 px-6 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-cyan-50 flex items-center justify-center">
                                        <span class="text-3xl">🎫</span>
                                    </div>
                                    <p class="text-gray-700 font-bold">Belum ada promo dibuat.</p>
                                    <p class="text-gray-400 text-sm mt-1">Silakan tambahkan promo baru.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>