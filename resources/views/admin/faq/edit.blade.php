<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-t-4 border-yellow-500">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit FAQ</h2>
                
                <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-5">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                        <input type="text" name="pertanyaan" value="{{ $faq->pertanyaan }}" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                    </div>
                    
                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jawaban</label>
                        <textarea name="jawaban" rows="5" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500" required>{{ $faq->jawaban }}</textarea>
                    </div>
                    
                    <div class="flex items-center">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow">Update Data</button>
                        <a href="{{ route('faq.index') }}" class="text-gray-500 hover:text-gray-800 ml-4">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>