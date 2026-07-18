<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi Selesai & Batal') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="bg-gray-100 border-b border-gray-200 p-4">
                    <h3 class="text-lg font-extrabold text-gray-700 flex items-center gap-2">
                        <span>🗄️</span> Arsip Pesanan Daeng Lala
                        <span class="bg-gray-600 text-white text-xs px-2 py-1 rounded-full">{{ $pemesanans->count() }}</span>
                    </h3>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4">Tgl Selesai</th>
                                <th class="py-3 px-4">ID / Pengunjung</th>
                                <th class="py-3 px-4">Kategori & Detail</th>
                                <th class="py-3 px-4">Biaya (Jumlah)</th>
                                <th class="py-3 px-4 text-center">Status Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($pemesanans as $pesanan)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="py-4 px-4 text-xs font-semibold text-gray-500">
                                        {{ $pesanan->updated_at->format('d/m/Y H:i') }}
                                    </td>
                                    
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-xs font-bold text-gray-600 block">{{ $pesanan->id_pesanan }}</span>
                                        <span class="font-semibold text-gray-800 block mt-0.5">{{ $pesanan->user->name ?? 'User Terhapus' }}</span>
                                    </td>
                                    
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-0.5 {{ $pesanan->jenis == 'Makanan' ? 'bg-orange-100 text-orange-700' : 'bg-indigo-100 text-indigo-700' }} rounded-full text-[10px] font-bold uppercase">{{ $pesanan->jenis }}</span>
                                        <span class="font-bold text-gray-700 block mt-1">{{ $pesanan->item_nama }}</span>
                                    </td>
                                    
                                    <td class="py-4 px-4 font-extrabold text-gray-800">
                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                        <span class="text-xs text-gray-500 font-normal block">Qty: {{ $pesanan->jumlah }}</span>
                                    </td>
                                    
                                    <td class="py-4 px-4 text-center">
                                        @if($pesanan->status_pesanan == 'Batal')
                                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-800 border border-red-200">
                                                ❌ DIBATALKAN
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-800 border border-green-200">
                                                ✅ LUNAS & SELESAI
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-400 font-bold">Belum ada riwayat transaksi yang selesai atau dibatalkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>