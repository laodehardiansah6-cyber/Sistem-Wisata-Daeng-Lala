<tr class="hover:bg-gray-50/70 transition">
    <td class="py-4 px-4">
        <span class="font-mono text-xs font-bold text-cyan-600 block">{{ $pesanan->id_pesanan }}</span>
        <span class="font-semibold text-gray-800 block mt-0.5">{{ $pesanan->user->name ?? 'User Terhapus' }}</span>
        
        <!-- INI DIA BAGIAN NOMOR WA YANG DITAMBAHKAN -->
        @if($pesanan->nomor_wa)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesanan->nomor_wa) }}" target="_blank" class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold text-green-600 bg-green-50 border border-green-200 px-2 py-1 rounded hover:bg-green-500 hover:text-white transition-colors w-max shadow-sm">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WA: {{ $pesanan->nomor_wa }}
            </a>
        @endif
    </td>
    
    <td class="py-4 px-4">
        <span class="font-bold text-gray-700 block">{{ $pesanan->item_nama }}</span>
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
                👁️ Cek Foto Transfer
            </a>
        @else
            <span class="text-xs text-gray-400">Tidak ada</span>
        @endif
    </td>
    
    <td class="py-4 px-4">
        <span class="px-2 py-1 rounded text-[11px] font-bold block w-max uppercase bg-yellow-100 text-yellow-800">
            Sistem: {{ $pesanan->status_pesanan }}
        </span>
        <span class="text-[11px] font-medium block mt-1 text-gray-500">
            Uang: 
            <span class="
                {{ $pesanan->status_pembayaran == 'Bayar Setengah' ? 'text-blue-600 font-bold' : '' }}
                {{ $pesanan->status_pembayaran == 'Belum Bayar' ? 'text-red-500 font-bold' : '' }}
            ">{{ $pesanan->status_pembayaran }}</span>
        </span>
    </td>
    
    <td class="py-4 px-4 flex flex-col gap-1.5 min-w-[150px]">
        @if($pesanan->status_pesanan == 'Pending')
            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="aksi" value="terima">
                <button type="submit" class="w-full py-1 bg-green-600 text-white text-[10px] font-bold rounded hover:bg-green-700 shadow-sm uppercase tracking-wider">TERIMA & LUNAS</button>
            </form>
            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="aksi" value="terima_setengah">
                <button type="submit" class="w-full py-1 bg-blue-500 text-white text-[10px] font-bold rounded hover:bg-blue-600 shadow-sm uppercase tracking-wider">TERIMA (SETENGAH)</button>
            </form>
            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="aksi" value="tolak">
                <button type="submit" class="w-full py-1 bg-red-600 text-white text-[10px] font-bold rounded hover:bg-red-700 shadow-sm uppercase tracking-wider">TOLAK</button>
            </form>
        @else
            <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 border border-blue-200 rounded px-2 py-1 text-center mb-0.5">
                Menunggu Pelunasan
            </span>
            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="aksi" value="terima">
                <button type="submit" class="w-full py-1 bg-green-600 text-white text-[10px] font-bold rounded hover:bg-green-700 shadow-sm uppercase tracking-wider">TANDAI LUNAS</button>
            </form>
            <form action="{{ route('admin.pemesanan.status', $pesanan->id) }}" method="POST" class="m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="aksi" value="tolak">
                <button type="submit" class="w-full py-1 bg-red-600 text-white text-[10px] font-bold rounded hover:bg-red-700 shadow-sm uppercase tracking-wider">BATALKAN</button>
            </form>
        @endif
    </td>
</tr>