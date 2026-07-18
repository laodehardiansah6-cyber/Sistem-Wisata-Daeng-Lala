<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu Kuliner') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl p-8">
                
                <form action="{{ route('kuliner.update', $kuliner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Menu</label>
                        <input type="text" name="nama_menu" value="{{ old('nama_menu', $kuliner->nama_menu) }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" value="{{ old('harga', $kuliner->harga) }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="Tersedia" {{ $kuliner->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Habis" {{ $kuliner->status == 'Habis' ? 'selected' : '' }}>Habis</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi / Komposisi</label>
                        <textarea name="deskripsi" rows="3" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi', $kuliner->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-6 p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                        <div class="flex items-center gap-4">
                            @if($kuliner->gambar)
                                <img src="{{ asset($kuliner->gambar) }}" alt="Foto Lama" class="w-20 h-20 object-cover rounded shadow">
                            @endif
                            <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('kuliner.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-bold transition">Batal</a>
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold transition">Update Menu</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>