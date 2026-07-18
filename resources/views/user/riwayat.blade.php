<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat & Status Pesanan Anda</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700 text-xs uppercase font-bold tracking-wider">
                                    <th class="py-3 px-4">ID Pesanan / Tanggal</th>
                                    <th class="py-3 px-4">Menu / Fasilitas</th>
                                    <th class="py-3 px-4">Total Biaya & Pembayaran</th>
                                    <th class="py-3 px-4">Status Pesanan</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @forelse($pesanans as $pesanan)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-4 px-4">
                                            <span class="font-mono text-xs font-bold text-blue-600 block">{{ $pesanan->id_pesanan }}</span>
                                            <span class="text-xs text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                                        </td>
                                        
                                        <td class="py-4 px-4">
                                            <span class="font-bold text-gray-800 block">{{ $pesanan->item_nama }} (x{{ $pesanan->jumlah }})</span>
                                            <span class="text-xs text-gray-500 uppercase">{{ $pesanan->jenis }}</span>
                                        </td>
                                        
                                        <td class="py-4 px-4">
                                            <span class="font-bold text-gray-800 block">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                                            
                                            <span class="text-[11px] font-extrabold mt-1 block uppercase tracking-wider
                                                {{ $pesanan->status_pembayaran == 'Lunas' ? 'text-green-600' : '' }}
                                                {{ $pesanan->status_pembayaran == 'Bayar Setengah' ? 'text-blue-600' : '' }}
                                                {{ $pesanan->status_pembayaran == 'Belum Bayar' ? 'text-red-500' : '' }}
                                            ">
                                                {{ $pesanan->status_pembayaran == 'Belum Bayar' ? 'Belum Lunas' : $pesanan->status_pembayaran }}
                                            </span>
                                        </td>
                                        
                                        <td class="py-4 px-4">
                                            @if($pesanan->status_pesanan == 'Pending')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold shadow-sm border border-yellow-200">Sedang Diproses Admin</span>
                                            @elseif($pesanan->status_pesanan == 'Sukses')
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold shadow-sm border border-green-200">Disetujui / Siap Saji</span>
                                            @else
                                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold shadow-sm border border-red-200">Ditolak / Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-gray-500 font-bold">Anda belum pernah membuat pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>