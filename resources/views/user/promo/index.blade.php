@extends('layouts.app') <!-- Sesuaikan dengan nama layout utama Anda -->

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-center mb-8 text-blue-900">Promo & Penawaran Spesial</h2>
    <p class="text-center text-gray-600 mb-10">Nikmati liburan hemat di Pondok Daeng Lala dengan penawaran menarik kami!</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($promos as $promo)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <!-- Gambar Promo -->
            @if($promo->gambar)
                <img src="{{ asset('storage/' . $promo->gambar) }}" alt="{{ $promo->judul }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Gambar Promo</div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">{{ $promo->judul }}</h3>
                <p class="text-gray-600 mb-4 h-16 overflow-hidden">{{ $promo->deskripsi }}</p>
                
                @if($promo->kode_promo)
                <div class="bg-blue-50 border border-blue-200 rounded p-3 text-center mb-4">
                    <span class="block text-sm text-gray-500 mb-1">Gunakan Kode Kupon:</span>
                    <strong class="text-lg text-blue-700 tracking-wider">{{ $promo->kode_promo }}</strong>
                </div>
                @endif
                
                <a href="{{ route('booking.index') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Pesan Sekarang
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-10">
            <h3 class="text-xl text-gray-500">Belum ada promo yang aktif saat ini.</h3>
        </div>
        @endforelse
    </div>
</div>
@endsection