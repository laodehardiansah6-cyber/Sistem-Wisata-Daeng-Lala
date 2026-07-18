<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan Masuk (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-b from-cyan-50 via-sky-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm font-semibold flex items-center gap-2">
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

                <div class="relative z-10 p-8">
                    <div class="flex items-center gap-2 mb-2 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Pantai Lakeba • Daeng Lala
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold mb-1">Daftar Transaksi Pengunjung</h3>
                    <p class="text-cyan-50/90 text-sm">Verifikasi bukti transfer dan kelola status pesanan masuk di sini.</p>
                </div>
            </div>

            <!-- ============================== -->
            <!-- TABEL PESANAN                  -->
            <!-- ============================== -->
            <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-cyan-50 text-cyan-700 text-xs uppercase font-bold tracking-wider">
                                <th class="py-4 px-4">ID / Pengunjung</th>
                                <th class="py-4 px-4 min-w-[200px]">Detail Item & Catatan</th>
                                <th class="py-4 px-4 text-center">Jumlah</th>
                                <th class="py-4 px-4">Total Biaya</th>
                                <th class="py-4 px-4 text-center">Bukti Bayar</th>
                                <th class="py-4 px-4">Status</th>
                                <th class="py-4 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-cyan-50">
                            @forelse($pemesanans as $pesanan)
                                <tr class="hover:bg-cyan-50/50 transition">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-xs font-bold text-blue-600 block">{{ $pesanan->id_pesanan }}</span>
                                        <span class="font-semibold text-gray-800 block mt-0.5">{{ $pesanan->user->name ?? 'User Terhapus' }}</span>
                                    </td>

                                    <td class="py-4 px-4">
                                        <span class="px-2 py-0.5 {{ $pesanan->jenis == 'Makanan' ? 'bg-orange-100 text-orange-700' : 'bg-cyan-100 text-cyan-700' }} rounded-full text-[10px] font-bold uppercase">{{ $pesanan->jenis }}</span>
                                        <span class="font-bold text-gray-700 block mt-1">{{ $pesanan->item_nama }}</span>

                                        <div class="mt-2 p-2 bg-cyan-50/60 border border-cyan-100 rounded-lg text-xs">
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

                                    <td class="py-4 px-4 font-extrabold text-blue-700">
                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                    </td>

                                    <td class="py-4 px-4 text-center">
                                        @if($pesanan->bukti_transfer)
                                            <a href="{{ asset($pesanan->bukti_transfer) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-cyan-50 border border-cyan-200 text-xs font-bold text-cyan-700 rounded-lg shadow-sm hover:bg-cyan-100 transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Lihat Foto
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
                                                {{ $pesanan->status_pembayaran == 'Bayar Setengah' ? 'text-cyan-600 font-bold' : '' }}
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
                                            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1.5 rounded-lg text-center border border-gray-200">
                                                Selesai Diproses
                                            </span>

                                        @elseif($pesanan->status_pesanan == 'Pending')
                                            {{-- Pesanan baru masuk, belum diverifikasi sama sekali --}}
                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima">
                                                <button type="submit" class="w-full text-center py-1.5 bg-green-600 text-white text-[10px] font-bold rounded-lg hover:bg-green-700 transition shadow-sm uppercase tracking-wider">
                                                    TERIMA & LUNAS
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima_setengah">
                                                <button type="submit" class="w-full text-center py-1.5 bg-cyan-500 text-white text-[10px] font-bold rounded-lg hover:bg-cyan-600 transition shadow-sm uppercase tracking-wider">
                                                    TERIMA (SETENGAH)
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="tolak">
                                                <button type="submit" class="w-full text-center py-1.5 bg-red-600 text-white text-[10px] font-bold rounded-lg hover:bg-red-700 transition shadow-sm uppercase tracking-wider">
                                                    TOLAK PESANAN
                                                </button>
                                            </form>

                                        @else
                                            {{-- Sudah diterima tapi baru "Bayar Setengah": aksi tetap hidup
                                                 sampai admin menandai lunas atau menolaknya --}}
                                            <span class="text-[10px] font-semibold text-cyan-600 bg-cyan-50 border border-cyan-200 rounded-lg px-2 py-1 text-center mb-0.5">
                                                Menunggu pelunasan sisa bayar
                                            </span>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="terima">
                                                <button type="submit" class="w-full text-center py-1.5 bg-green-600 text-white text-[10px] font-bold rounded-lg hover:bg-green-700 transition shadow-sm uppercase tracking-wider">
                                                    TANDAI LUNAS
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="aksi" value="tolak">
                                                <button type="submit" class="w-full text-center py-1.5 bg-red-600 text-white text-[10px] font-bold rounded-lg hover:bg-red-700 transition shadow-sm uppercase tracking-wider">
                                                    TOLAK PESANAN
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-16 px-6 text-center">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-cyan-50 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <p class="text-gray-700 font-bold">Belum ada pesanan masuk dari pengunjung.</p>
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