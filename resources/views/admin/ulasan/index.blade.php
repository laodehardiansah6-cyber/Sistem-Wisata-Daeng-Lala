<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Ulasan & Rating') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                                <th class="p-4 border-b">User</th>
                                <th class="p-4 border-b">Jenis</th>
                                <th class="p-4 border-b">Rating</th>
                                <th class="p-4 border-b">Komentar</th>
                                <th class="p-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($ulasans as $ulasan)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium">{{ $ulasan->user->name ?? 'User Dihapus' }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs font-bold">
                                        {{ $ulasan->jenis }}
                                    </span>
                                    <span class="text-xs text-gray-400 block mt-1">ID: {{ $ulasan->item_id }}</span>
                                </td>
                                <td class="p-4 text-yellow-500 font-extrabold text-lg">
                                    {{ $ulasan->rating }} <span class="text-sm">★</span>
                                </td>
                                <td class="p-4 max-w-xs truncate">{{ $ulasan->komentar }}</td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.ulasan.destroy', $ulasan->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800 font-bold text-sm" onclick="return confirm('Hapus ulasan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-500 font-bold">Belum ada ulasan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>