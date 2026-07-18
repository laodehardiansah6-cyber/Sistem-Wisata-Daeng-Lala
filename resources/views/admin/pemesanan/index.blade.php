<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan Masuk (Admin)') }}
        </h2>
    </x-slot>

    @php
        // 1. Hitung total penghasilan HANYA dari pesanan yang sudah Lunas
        $totalPenghasilan = $pemesanans->where('status_pembayaran', 'Lunas')->sum('total_harga');

        // 2. Saring (Filter) pesanan agar yang Lunas dan Batal HILANG dari daftar ini
        $pesananAktif = $pemesanans->reject(function($p) {
            return $p->status_pembayaran == 'Lunas' || $p->status_pesanan == 'Batal';
        });

        // 3. Pisahkan pesanan aktif menjadi 2 kategori
        $pesananFasilitas = $pesananAktif->where('jenis', 'Fasilitas');
        $pesananMakanan = $pesananAktif->where('jenis', 'Makanan');
    @endphp

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KARTU TOTAL PENGHASILAN -->
            <div class="bg-gradient-to-r from-cyan-600 to-blue-700 rounded-xl shadow-lg p-6 mb-8 text-white flex items-center justify-between">
                <div>
                    <h3 class="text-cyan-100 text-sm font-bold uppercase tracking-wider mb-1">Total Pendapatan (Lunas)</h3>
                    <p class="text-4xl font-black">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</p>
                </div>
                <div class="p-4 bg-white/20 rounded-full">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- KATALOG FASILITAS -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 mb-8">
                <div class="bg-indigo-50 border-b border-indigo-100 p-4">
                    <h3 class="text-lg font-extrabold text-indigo-900 flex items-center gap-2">
                        <span>🏨</span> Antrean Pesanan Fasilitas (Gazebo, dll)
                        <span class="bg-indigo-600 text-white text-xs px-2 py-1 rounded-full">{{ $pesananFasilitas->count() }}</span>
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4">Pengunjung</th>
                                <th class="py-3 px-4 min-w-[200px]">Detail Fasilitas</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-4">Biaya</th>
                                <th class="py-3 px-4 text-center">Bukti Bayar</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($pesananFasilitas as $pesanan)
                                @include('admin.pemesanan.partials.row-table', ['pesanan' => $pesanan])
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400 font-bold">Tidak ada pesanan fasilitas yang aktif.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- KATALOG MAKANAN & KULINER -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="bg-orange-50 border-b border-orange-100 p-4">
                    <h3 class="text-lg font-extrabold text-orange-900 flex items-center gap-2">
                        <span>🥘</span> Antrean Pesanan Kuliner (Seafood, dll)
                        <span class="bg-orange-600 text-white text-xs px-2 py-1 rounded-full">{{ $pesananMakanan->count() }}</span>
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4">Pengunjung</th>
                                <th class="py-3 px-4 min-w-[200px]">Detail Makanan</th>
                                <th class="py-3 px-4 text-center">Porsi</th>
                                <th class="py-3 px-4">Biaya</th>
                                <th class="py-3 px-4 text-center">Bukti Bayar</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($pesananMakanan as $pesanan)
                                @include('admin.pemesanan.partials.row-table', ['pesanan' => $pesanan])
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400 font-bold">Tidak ada pesanan kuliner yang aktif.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>