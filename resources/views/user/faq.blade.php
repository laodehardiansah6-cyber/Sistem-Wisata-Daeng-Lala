<x-app-layout>
    <!-- Bagian Header/Hero FAQ -->
    <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 pb-20 pt-12 shadow-inner">
        <!-- Ornamen gelembung cahaya laut -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute right-32 top-6 w-24 h-24 bg-cyan-300/20 rounded-full blur-2xl"></div>
        <div class="absolute left-1/4 -bottom-24 w-72 h-72 bg-sky-300/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 mb-3 text-cyan-100 text-xs font-bold uppercase tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4-3-7-6.5-7-10a7 7 0 1114 0c0 3.5-3 7-7 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                Pantai Lakeba • Daeng Lala
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight mb-3 drop-shadow-md sm:text-5xl">Pertanyaan yang Sering Diajukan</h1>
            <p class="text-cyan-50/90 text-lg font-medium max-w-2xl mx-auto drop-shadow-sm">Temukan jawaban cepat seputar informasi fasilitas, pemesanan, dan layanan kami.</p>
        </div>

        <!-- Ombak dekoratif pemisah -->
        <svg class="absolute -bottom-1 left-0 w-full text-cyan-50" viewBox="0 0 1440 100" fill="currentColor" preserveAspectRatio="none">
            <path d="M0,40 C240,90 480,0 720,24 C960,48 1200,90 1440,40 L1440,100 L0,100 Z"></path>
        </svg>
    </div>

    <!-- Bagian Konten FAQ -->
    <div class="bg-gradient-to-b from-cyan-50 via-sky-50 to-white py-10 -mt-12 relative z-20">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if($faqs->count() > 0)
                <div class="space-y-5">
                    @foreach($faqs as $item)
                        <div class="bg-white shadow-sm sm:rounded-2xl p-6 border border-cyan-100 border-l-4 border-l-cyan-500 hover:shadow-lg transition-shadow duration-300">
                            <h3 class="font-bold text-xl text-gray-800 mb-2 flex items-start gap-2">
                                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-cyan-100 text-cyan-700 text-sm font-black flex items-center justify-center">Q</span>
                                <span>{{ $item->pertanyaan }}</span>
                            </h3>
                            <p class="text-gray-600 leading-relaxed flex items-start gap-2 mt-3 pt-3 border-t border-cyan-50">
                                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 text-blue-600 text-sm font-black flex items-center justify-center">A</span>
                                <span>{{ $item->jawaban }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 bg-white/95 backdrop-blur-sm p-16 rounded-3xl shadow-xl border border-cyan-100 mb-8">
                    <div class="w-28 h-28 bg-gradient-to-br from-cyan-100 to-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-cyan-100">
                        <svg class="h-12 w-12 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-lg font-bold text-blue-950">Belum ada informasi FAQ yang tersedia saat ini.</p>
                </div>
            @endif

            <!-- FORMULIR KIRIM PERTANYAAN -->
            <div class="mt-12 relative overflow-hidden bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-800 rounded-3xl p-8 shadow-xl text-white">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute left-10 -bottom-14 w-40 h-40 bg-cyan-300/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Punya Pertanyaan Lain? 🌊</h3>
                    <p class="text-cyan-50/90 mb-6">Jangan ragu untuk bertanya. Admin kami akan segera menjawab pertanyaan Anda di halaman ini.</p>

                    @if(session('success'))
                        <div class="bg-white/95 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative mb-4 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('user.faq.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input type="text" name="pertanyaan" placeholder="Ketik pertanyaan Anda di sini..." class="shadow-sm appearance-none border-0 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-white" required>
                            <button type="submit" class="bg-white hover:bg-cyan-50 text-blue-700 font-bold py-3 px-8 rounded-xl shadow transition-colors whitespace-nowrap">
                                Kirim Pertanyaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>