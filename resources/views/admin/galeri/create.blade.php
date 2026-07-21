<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-t-4 border-cyan-500">
                <h2 class="text-2xl font-extrabold text-blue-900 mb-6">Upload Foto Galeri Baru</h2>

                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto (Opsional)</label>
                        <input type="text" name="judul_foto" placeholder="Contoh: Sunset di Pantai Lakeba" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih File Foto <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 hover:bg-gray-100 transition-colors">
                            <input type="file" name="gambar" required accept="image/*" class="w-full text-gray-700 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-3">Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal 2MB.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('galeri.index') }}" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-lg hover:bg-gray-300 transition-colors">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-cyan-600 to-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:scale-105 transition-transform">
                            Upload Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>