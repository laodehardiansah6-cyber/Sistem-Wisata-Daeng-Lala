<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Fasilitas & Alat Wisata</h3>
                    <a href="{{ route('fasilitas.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-semibold text-sm">
                        + Tambah Fasilitas
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Gambar</th>
                                <th class="py-3 px-6 text-left">Nama Fasilitas</th>
                                <th class="py-3 px-6 text-center">Kategori</th>
                                <th class="py-3 px-6 text-right">Harga</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($fasilitas as $index => $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $index + 1 }}</td>
                                    
                                    <td class="py-3 px-6 text-left">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_fasilitas }}" class="w-16 h-16 object-cover rounded-md border border-gray-200 shadow-sm">
                                        @else
                                            <span class="text-xs text-gray-400 italic">Tidak ada gambar</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-6 text-left font-medium">{{ $item->nama_fasilitas }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs">{{ $item->kategori }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-right font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }} <span class="text-xs font-normal text-gray-500">/ {{ $item->satuan }}</span></td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            
                                            <a href="{{ route('fasilitas.edit', $item->id) }}" class="w-8 h-8 flex items-center justify-center bg-yellow-400 text-white rounded hover:bg-yellow-500" title="Ubah Data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            
                                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600" title="Hapus Data">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">Data fasilitas belum ada. Silakan tambahkan data baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>