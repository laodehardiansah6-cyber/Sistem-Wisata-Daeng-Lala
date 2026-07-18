<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fasilitas Wisata') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl p-8">
                
                <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="Gazebo" {{ $fasilitas->kategori == 'Gazebo' ? 'selected' : '' }}>Gazebo</option>
                                <option value="Alat Selam" {{ $fasilitas->kategori == 'Alat Selam' ? 'selected' : '' }}>Alat Selam</option>
                                <option value="Kendaraan" {{ $fasilitas->kategori == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                <option value="Lainnya" {{ $fasilitas->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" value="{{ old('harga', $fasilitas->harga) }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Satuan Harga</label>
                            <input type="text" name="satuan" value="{{ old('satuan', $fasilitas->satuan) }}" placeholder="Contoh: per jam, per orang" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-6 p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                        <div class="flex items-center gap-4">
                            @if($fasilitas->gambar)
                                <img src="{{ asset($fasilitas->gambar) }}" alt="Foto Lama" class="w-20 h-20 object-cover rounded shadow">
                            @endif
                            <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                        </div>
                        <p class="text-xs text-gray-500 mt-2">*Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('fasilitas.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-bold transition">Batal</a>
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold transition">Update Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>