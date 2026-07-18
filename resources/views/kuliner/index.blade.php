<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kuliner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Menu Makanan & Minuman</h3>
                    <a href="{{ route('kuliner.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-semibold text-sm">
                        + Tambah Menu
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Gambar</th>
                                <th class="py-3 px-6 text-left">Nama Menu</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-right">Harga</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($kuliners as $index => $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_menu }}" class="w-16 h-16 object-cover rounded-md shadow-sm border border-gray-200">
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left font-medium">{{ $item->nama_menu }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if($item->status == 'Tersedia')
                                            <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs">Tersedia</span>
                                        @else
                                            <span class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs">Habis</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-right font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            
                                            <a href="{{ route('kuliner.edit', $item->id) }}" class="px-3 py-1.5 bg-yellow-400 text-white text-xs font-bold rounded hover:bg-yellow-500 transition shadow-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('kuliner.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 bg-red-500 text-white text-xs font-bold rounded hover:bg-red-600 transition shadow-sm">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">Belum ada menu kuliner.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
