<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-t-4 border-cyan-500">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pertanyaan Baru</h2>
                
                <form action="{{ route('faq.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                        <input type="text" name="pertanyaan" placeholder="Contoh: Apakah ada area parkir?" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                    </div>
                    
                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jawaban</label>
                        <textarea name="jawaban" rows="5" placeholder="Tulis jawaban lengkap di sini..." class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500" required></textarea>
                    </div>
                    
                    <div class="flex items-center">
                        <button type="submit" class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg shadow">Simpan Data</button>
                        <a href="{{ route('faq.index') }}" class="text-gray-500 hover:text-gray-800 ml-4">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>