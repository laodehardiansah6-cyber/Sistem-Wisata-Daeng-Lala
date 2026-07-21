<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-t-4 border-blue-500">
                <h2 class="text-2xl font-extrabold text-blue-900 mb-6">Edit Foto Galeri</h2>

                <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Foto (Opsional)</label>
                        <input type="text" name="judul_foto" value="{{ $galeri->judul_foto }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>

                    <div class="flex items-center gap-4">
                        @if($galeri->gambar)
                            <img src="{{ asset($galeri->gambar) }}" class="w-32 h-24 object-cover rounded-lg border border-gray-200">
                        @endif
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                            <input type="file" name="gambar" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 focus:outline-none focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin ganti foto.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('galeri.index') }}" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-lg hover:bg-gray-300 transition-colors">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:scale-105 transition-transform">
                            Update Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>