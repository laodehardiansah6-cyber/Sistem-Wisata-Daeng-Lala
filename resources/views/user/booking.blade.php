<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <!-- ========================================== -->
        <!-- INFO TRANSFER & KONTAK ADMIN               -->
        <!-- ========================================== -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h3 class="text-blue-800 font-bold mb-2">Panduan Transfer:</h3>
            <p class="text-sm text-blue-700 mb-4">
                Silakan transfer total biaya pesanan Anda ke rekening resmi kami:
            </p>
            
            <div class="bg-white p-4 rounded inline-block border border-blue-100 mb-4 shadow-sm">
                <p class="font-black text-lg text-gray-800">BRI: 7315 0104 2811 532</p>
                <p class="text-sm text-gray-600">Wisata Pondok Daeng Lala</p>
            </div>
            
            <hr class="border-blue-200 mb-4">
            
            <p class="text-xs text-blue-700 leading-relaxed">
                <strong>Penting:</strong> Admin kami akan menghubungi Anda melalui nomor WhatsApp resmi: 
                <span class="font-bold bg-green-100 text-green-800 px-2 py-0.5 rounded tracking-wide">0812-XXXX-XXXX</span>. 
                <br><em>*Silakan simpan nomor ini agar Anda tahu jika kami menghubungi terkait pesanan Anda.</em>
            </p>
        </div>

        <!-- ========================================== -->
        <!-- FORM PESANAN                               -->
        <!-- ========================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('user.booking.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Input hidden untuk mengirim data ke Controller -->
                <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                <input type="hidden" name="item_nama" value="{{ request('item_nama') }}">
                <input type="hidden" name="total_harga" value="{{ request('harga') }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pesanan</label>
                        <div class="w-full bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm p-2.5">
                            {{ request('jenis') ?? 'Menu Kuliner / Fasilitas' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu / Fasilitas</label>
                        <div class="w-full bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm p-2.5">
                            {{ request('item_nama') ?? 'Pilih Item' }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" name="jumlah" value="1" min="1" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Harga (Rp)</label>
                        <div class="w-full bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm p-2.5">
                            {{ request('harga') ?? '0' }}
                        </div>
                    </div>
                </div>

                <!-- INPUT NOMOR WHATSAPP PENGUNJUNG -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp Anda <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_wa" required placeholder="Contoh: 081234567890" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2.5">
                    <p class="text-xs text-gray-500 mt-1">Kami akan menghubungi nomor ini jika pesanan sudah siap atau butuh konfirmasi pembayaran.</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Sambalnya dipisah, atau datang jam 14:00" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2.5"></textarea>
                </div>

                <div class="mb-8 p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50 text-center">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Bukti Transfer <span class="text-red-500">*</span></label>
                    <input type="file" name="bukti_transfer" required accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors shadow-sm">
                    Kirim Pesanan
                </button>
            </form>
        </div>

    </div>
</x-app-layout>