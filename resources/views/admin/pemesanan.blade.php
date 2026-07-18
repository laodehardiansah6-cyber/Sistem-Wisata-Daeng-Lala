<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan Masuk (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Transaksi Pengunjung</h3>
                    
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-xs uppercase font-bold tracking-wider">
                                <th class="py-3 px-4">ID / Pengunjung</th>
                                <th class="py-3 px-4 min-w-[200px]">Detail Item & Catatan</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-4">Total Biaya</th>
                                <th class="py-3 px-4 text-center">Bukti Bayar</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($pemesanans as $pesanan)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-xs font-bold text-blue-600 block">{{ $pesanan->id_pesanan }}</span>
                                        <span class="font-semibold text-gray-800 block mt-0.5">{{ $pesanan->user->name ?? 'User Terhapus' }}</span>
                                    </td>
                                    
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-0.5 {{ $pesanan->jenis == 'Makanan' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }} rounded-full text-[10px] font-bold uppercase">{{ $pesanan->jenis }}</span>
                                        <span class="font-bold text-gray-700 block mt-1">{{ $pesanan->item_nama }}</span>
                                        
                                        <div class="mt-2 p-2 bg-gray-50 border border-gray-200 rounded text-xs">
                                            <span class="font-semibold text-gray-600">Ket:</span>
                                            @if($pesanan->catatan)
                                                <span class="text-gray-800 italic">"{{ $pesanan->catatan }}"</span>
                                            @else
                                                <span class="text-gray-400 italic">Tidak ada catatan</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-4 text-center font-semibold text-gray-700">
                                        {{ $pesanan->jumlah }}
                                    </td>
                                    
                                    <td class="py-4 px-4 font-extrabold text-gray-800">
                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="py-4 px-4 text-center">
                                        @if($pesanan->bukti_transfer)
                                            <a href="{{ asset($pesanan->bukti_transfer) }}" target="_blank" class="inline-flex items-center px-2.5 py-1.5 bg-gray-100 border border-gray-300 text-xs font-bold text-gray-700 rounded shadow-sm hover:bg-gray-200 transition">
                                                👁️ Lihat Foto
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">Tidak ada</span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-4 px-4">
                                        <span class="px-2 py-1 rounded text-[11px] font-bold block w-max uppercase
                                            {{ $pesanan->status_pesanan == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $pesanan->status_pesanan == 'Sukses' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $pesanan->status_pesanan == 'Batal' ? 'bg-red-100 text-red-800' : '' }}">
                                            Sistem: {{ $pesanan->status_pesanan }}
                                        </span>
                                        
                                        <span class="text-[11px] font-medium block mt-1 text-gray-500">
                                            Uang: 
                                            <span class="
                                                {{ $pesanan->status_pembayaran == 'Lunas' ? 'text-green-600 font-bold' : '' }}
                                                {{ $pesanan->status_pembayaran == 'Bayar Setengah' ? 'text-blue-600 font-bold' : '' }}
                                                {{ $pesanan->status_pembayaran == 'Belum Bayar' ? 'text-red-500 font-bold' : '' }}
                                            ">{{ $pesanan->status_pembayaran }}</span>
                                        </span>
                                    </td>
                                    
                                    <td class="py-4 px-4 flex flex-col gap-1.5 min-w-[150px]">
                                        @php
                                            // Aksi hanya benar-benar mati (selesai) jika:
                                            // 1) sudah Lunas, ATAU
                                            // 2) pesanan ditolak/Batal
                                            // Selama masih "Bayar Setengah" & belum Batal, aksi tetap tersedia.
                                            $sudahSelesai = $pesanan->status_pembayaran == 'Lunas' || $pesanan->status_pesanan == 'Batal';
                                        @endphp

                                        @if($sudahSelesai)
                                            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded text-center border border-gray-200">
                                                Selesai Diproses
                                            </span>

                                        @elseif($pesanan->status_pesanan == 'Pending')
                                            {{-- Pesanan baru masuk, belum diverifikasi sama sekali --}}
                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima">
                                                <button type="submit" class="w-full text-center py-1 bg-green-600 text-white text-[10px] font-bold rounded hover:bg-green-700 transition shadow-sm uppercase tracking-wider">
                                                    TERIMA & LUNAS
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima_setengah">
                                                <button type="submit" class="w-full text-center py-1 bg-blue-500 text-white text-[10px] font-bold rounded hover:bg-blue-600 transition shadow-sm uppercase tracking-wider">
                                                    TERIMA (SETENGAH)
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="tolak">
                                                <button type="submit" class="w-full text-center py-1 bg-red-600 text-white text-[10px] font-bold rounded hover:bg-red-700 transition shadow-sm uppercase tracking-wider">
                                                    TOLAK PESANAN
                                                </button>
                                            </form>

                                        @else
                                            {{-- Sudah diterima tapi baru "Bayar Setengah": aksi tetap hidup
                                                 sampai admin menandai lunas atau menolaknya --}}
                                            <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 border border-blue-200 rounded px-2 py-1 text-center mb-0.5">
                                                Menunggu pelunasan sisa bayar
                                            </span>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima">
                                                <button type="submit" class="w-full text-center py-1 bg-green-600 text-white text-[10px] font-bold rounded hover:bg-green-700 transition shadow-sm uppercase tracking-wider">
                                                    TANDAI LUNAS
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="tolak">
                                                <button type="submit" class="w-full text-center py-1 bg-red-600 text-white text-[10px] font-bold rounded hover:bg-red-700 transition shadow-sm uppercase tracking-wider">
                                                    TOLAK PESANAN
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-10 text-gray-500 font-bold">Belum ada pesanan masuk dari pengunjung.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>