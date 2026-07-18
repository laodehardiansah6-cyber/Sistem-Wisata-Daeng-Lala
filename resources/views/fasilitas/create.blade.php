<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Fasilitas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_fasilitas" class="block text-sm font-medium text-gray-700">Nama Fasilitas / Alat</label>
                        <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Gazebo Utama" required value="{{ old('nama_fasilitas') }}">
                        @error('nama_fasilitas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Tempat Istirahat" {{ old('kategori') == 'Tempat Istirahat' ? 'selected' : '' }}>Tempat Istirahat (Gazebo, Pondok)</option>
                            <option value="Alat Air" {{ old('kategori') == 'Alat Air' ? 'selected' : '' }}>Alat Air (Snorkeling, Pelampung)</option>
                            <option value="Transportasi" {{ old('kategori') == 'Transportasi' ? 'selected' : '' }}>Transportasi (Perahu, Speedboat)</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan fasilitas ini...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <input type="number" name="harga" id="harga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="50000" required value="{{ old('harga') }}">
                            @error('harga') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: per Jam, per Hari" required value="{{ old('satuan') }}">
                            @error('satuan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Upload Gambar Foto Fasilitas</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        <p class="text-xs text-gray-500 mt-1">Format jpg, png, jpeg. Maksimal 2MB.</p>
                        @error('gambar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('fasilitas.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-semibold text-sm transition">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm transition">Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
