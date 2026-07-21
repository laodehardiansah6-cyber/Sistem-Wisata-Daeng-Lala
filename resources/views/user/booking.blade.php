<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-cyan-50 via-sky-50 to-white pb-16">

        <!-- ============================== -->
        <!-- HERO KECIL DI ATAS FORM        -->
        <!-- ============================== -->
        <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 text-white">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute left-1/4 -bottom-24 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 max-w-3xl mx-auto px-6 sm:px-8 pt-12 pb-16 text-center">
                <div class="inline-flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Satu Langkah Lagi
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Selesaikan Pesananmu 🌊</h1>
                <p class="text-cyan-50/90 max-w-lg mx-auto">Isi data di bawah, transfer, unggah bukti — tim kami langsung siapkan yang terbaik untuk liburanmu di Pantai Lakeba.</p>
            </div>

            <svg class="absolute bottom-0 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
                <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
            </svg>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- ============================== -->
            <!-- RINGKASAN ITEM YANG DIPESAN    -->
            <!-- ============================== -->
            <div class="bg-white rounded-2xl shadow-lg border border-cyan-100 p-5 mb-6 flex items-center gap-4">
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-cyan-100 to-sky-200 flex items-center justify-center text-cyan-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wide">{{ request('jenis') ?? 'Menu Kuliner / Fasilitas' }}</p>
                    <p class="text-lg font-extrabold text-gray-800">{{ request('item_nama') ?? 'Pilih Item' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">Harga Satuan</p>
                    <p class="text-lg font-extrabold text-blue-700">Rp {{ number_format(request('harga', 0), 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- ============================== -->
            <!-- INFO TRANSFER & KONTAK ADMIN   -->
            <!-- ============================== -->
            <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 mb-6">
                <h3 class="text-gray-800 font-bold mb-1 flex items-center gap-2">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Panduan Transfer
                </h3>
                <p class="text-sm text-gray-500 mb-4">
                    Silakan transfer total biaya pesanan Anda ke rekening resmi kami:
                </p>

                <div class="bg-gradient-to-br from-cyan-50 to-sky-50 p-4 rounded-xl inline-block border border-cyan-100 mb-4">
                    <p class="text-[11px] text-cyan-600 font-bold uppercase tracking-wide mb-1">Bank BRI</p>
                    <p class="font-black text-xl text-gray-800 tracking-wide">7315 0104 2811 532</p>
                    <p class="text-sm text-gray-500">a.n. Andi Riska Anisa</p>
                </div>

                <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl p-4">
                    <div class="w-9 h-9 flex-shrink-0 rounded-full bg-green-500 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 004.79 1.22h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.64-1.03-5.13-2.9-7-1.87-1.87-4.35-2.9-7-2.9zm0 18.1c-1.5 0-2.97-.4-4.25-1.16l-.3-.18-3.12.82.83-3.04-.2-.31a8.12 8.12 0 01-1.25-4.33c0-4.48 3.65-8.13 8.13-8.13 2.17 0 4.21.85 5.75 2.38a8.08 8.08 0 012.38 5.75c0 4.48-3.65 8.2-8.13 8.2z"/></svg>
                    </div>
                    <p class="text-xs text-green-800 leading-relaxed">
                        <strong>Penting:</strong> Admin kami akan menghubungi Anda melalui nomor WhatsApp resmi
                        <span class="font-bold bg-white px-2 py-0.5 rounded-md border border-green-200 tracking-wide inline-block mt-1">0823-2822-9225</span>
                        <br><em class="text-green-700/80">Simpan nomor ini agar Anda tahu jika kami menghubungi terkait pesanan Anda.</em>
                    </p>
                </div>
            </div>

            <!-- ============================== -->
            <!-- FORM PESANAN & KODE PROMO      -->
            <!-- ============================== -->
            <div class="bg-white rounded-2xl shadow-sm border border-cyan-100 p-6 sm:p-8">
                <h3 class="text-gray-800 font-bold mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Detail Pesanan
                </h3>

                <form action="{{ route('user.booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                    <input type="hidden" name="item_nama" value="{{ request('item_nama') }}">
                    <input type="hidden" id="total_harga_input" name="total_harga" value="{{ request('harga', 0) }}">
                    <!-- INPUT HIDDEN UNTUK MENGIRIM KODE PROMO KE DATABASE -->
                    <input type="hidden" id="kode_promo_dipakai" name="kode_promo_dipakai" value="">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Pesanan</label>
                            <input type="number" id="jumlah_input" name="jumlah" value="1" min="1" required class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Punya Kode Promo?</label>
                            <div class="flex gap-2">
                                <input type="text" id="kode_promo" placeholder="Masukkan kode" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 uppercase font-mono">
                                <button type="button" id="btn_cek_promo" class="bg-blue-800 text-white font-bold px-4 py-2 rounded-lg hover:bg-blue-900 transition">Klaim</button>
                            </div>
                            <p id="pesan_promo" class="text-xs mt-1 font-semibold hidden"></p>
                        </div>
                    </div>

                    <!-- Ringkasan Biaya -->
                    <div class="bg-sky-50 rounded-lg p-4 border border-cyan-100 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Subtotal</span>
                            <span class="text-sm font-bold text-gray-800" id="tampil_subtotal">Rp {{ number_format(request('harga', 0), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2 text-green-600 hidden" id="baris_diskon">
                            <span class="text-sm">Diskon Promo (<span id="teks_persen">0</span>%)</span>
                            <span class="text-sm font-bold" id="tampil_potongan">- Rp 0</span>
                        </div>
                        <hr class="border-cyan-200 my-2">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-bold text-blue-900">Total Pembayaran</span>
                            <span class="text-xl font-black text-blue-900" id="tampil_total">Rp {{ number_format(request('harga', 0), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- INPUT NOMOR WHATSAPP PENGUNJUNG -->
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor WhatsApp Anda <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-green-500 absolute left-3.5 top-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 004.79 1.22h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.64-1.03-5.13-2.9-7-1.87-1.87-4.35-2.9-7-2.9zm0 18.1c-1.5 0-2.97-.4-4.25-1.16l-.3-.18-3.12.82.83-3.04-.2-.31a8.12 8.12 0 01-1.25-4.33c0-4.48 3.65-8.13 8.13-8.13 2.17 0 4.21.85 5.75 2.38a8.08 8.08 0 012.38 5.75c0 4.48-3.65 8.2-8.13 8.2z"/></svg>
                            <input type="text" name="nomor_wa" required placeholder="Contoh: 081234567890" class="w-full pl-10 border-gray-200 rounded-xl shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm p-3">
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">Kami akan menghubungi nomor ini jika pesanan sudah siap atau butuh konfirmasi pembayaran.</p>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Contoh: Sambalnya dipisah, atau datang jam 14:00" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm p-3"></textarea>
                    </div>

                    <div class="mb-8 p-5 border-2 border-dashed border-cyan-200 rounded-xl bg-cyan-50/50 text-center">
                        <svg class="w-8 h-8 mx-auto mb-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Bukti Transfer <span class="text-red-500">*</span></label>
                        <input type="file" name="bukti_transfer" required accept="image/*" class="mx-auto w-full max-w-xs text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-cyan-100 file:text-cyan-700 hover:file:bg-cyan-200 cursor-pointer">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold py-4 px-4 rounded-xl transition-all shadow-lg shadow-cyan-500/30 hover:-translate-y-0.5 text-base flex items-center justify-center gap-2">
                        Kirim Pesanan Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Data & bukti transfer kamu aman, hanya dilihat admin Daeng Lala
                    </p>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT PENGHITUNG DINAMIS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const hargaSatuan = parseInt(urlParams.get('harga')) || 0;
            
            let jumlah = 1;
            let diskonPersen = 0;

            const inputJumlah = document.getElementById('jumlah_input');
            const btnCekPromo = document.getElementById('btn_cek_promo');
            const inputKodePromo = document.getElementById('kode_promo');
            const pesanPromo = document.getElementById('pesan_promo');
            const totalHargaInput = document.getElementById('total_harga_input');
            const kodePromoDipakaiInput = document.getElementById('kode_promo_dipakai'); // Variabel baru

            function hitungTotal() {
                jumlah = parseInt(inputJumlah.value) || 1;
                if(jumlah < 1) jumlah = 1; 
                
                let subtotal = hargaSatuan * jumlah;
                let nilaiDiskon = (subtotal * diskonPersen) / 100;
                let totalAkhir = subtotal - nilaiDiskon;

                document.getElementById('tampil_subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                document.getElementById('tampil_total').innerText = 'Rp ' + totalAkhir.toLocaleString('id-ID');
                totalHargaInput.value = totalAkhir; 
                
                if (diskonPersen > 0) {
                    document.getElementById('baris_diskon').classList.remove('hidden');
                    document.getElementById('teks_persen').innerText = diskonPersen;
                    document.getElementById('tampil_potongan').innerText = '- Rp ' + nilaiDiskon.toLocaleString('id-ID');
                } else {
                    document.getElementById('baris_diskon').classList.add('hidden');
                }
            }

            hitungTotal();

            inputJumlah.addEventListener('input', hitungTotal);

            btnCekPromo.addEventListener('click', function() {
                const kode = inputKodePromo.value.trim();
                if(!kode) return;

                btnCekPromo.innerText = 'Cek...';
                
                fetch("{{ route('cek.promo') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ kode_promo: kode })
                })
                .then(response => response.json())
                .then(data => {
                    btnCekPromo.innerText = 'Klaim';
                    pesanPromo.classList.remove('hidden');
                    
                    if(data.success) {
                        diskonPersen = data.diskon_persen;
                        pesanPromo.innerText = data.pesan;
                        pesanPromo.classList.remove('text-red-500');
                        pesanPromo.classList.add('text-green-600');
                        inputKodePromo.readOnly = true; 
                        btnCekPromo.classList.add('hidden');
                        
                        // SET KODE PROMO KE DALAM INPUT HIDDEN UNTUK DIKIRIM KE DATABASE
                        kodePromoDipakaiInput.value = kode; 
                    } else {
                        diskonPersen = 0;
                        pesanPromo.innerText = data.pesan;
                        pesanPromo.classList.remove('text-green-600');
                        pesanPromo.classList.add('text-red-500');
                        
                        // KOSONGKAN JIKA GAGAL
                        kodePromoDipakaiInput.value = ""; 
                    }
                    hitungTotal();
                })
                .catch(error => {
                    btnCekPromo.innerText = 'Klaim';
                    console.error('Error:', error);
                });
            });
        });
    </script>
</x-app-layout>