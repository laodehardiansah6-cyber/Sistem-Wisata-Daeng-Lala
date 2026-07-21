<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-t-4 border-cyan-500">
                <h2 class="text-2xl font-extrabold text-blue-900 mb-6">Tambah Promo Baru</h2>

                <form action="{{ route('promo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Promo <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_promo" required class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kode Promo (Opsional)</label>
                            <input type="text" name="kode_promo" placeholder="Contoh: DAENGLALA20" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm font-mono uppercase">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Diskon (%) <span class="text-red-500">*</span></label>
                            <input type="number" name="diskon_persen" placeholder="Contoh: 15" required min="0" max="100" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Batas Kuota <span class="text-red-500">*</span></label>
                            <input type="number" name="kuota" placeholder="Contoh: 15" required min="1" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar / Banner Promo <span class="text-red-500">*</span></label>
                        <input type="file" name="gambar" required accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-cyan-500 bg-gray-50">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('promo.index') }}" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-lg hover:bg-gray-300 transition-colors">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-cyan-600 to-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:scale-105 transition-transform">
                            Simpan Promo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>