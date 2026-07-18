<section class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <header class="mb-8 border-b border-gray-100 pb-4">
        <h2 class="text-2xl font-extrabold text-gray-800">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Perbarui foto, nama, dan alamat email akun Anda di sini.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center sm:flex-row sm:items-start gap-6 bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-inner">
            
            <input type="file" id="profile_photo" name="profile_photo" class="hidden" x-ref="photo"
                x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => { photoPreview = e.target.result; };
                    reader.readAsDataURL($refs.photo.files[0]);
                " accept="image/*">

            <div class="relative group cursor-pointer" x-on:click="$refs.photo.click()">
                
                <div x-show="!photoPreview" class="h-32 w-32 rounded-full overflow-hidden shadow-lg border-4 border-white bg-indigo-100 flex items-center justify-center transition transform group-hover:scale-105">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Foto Profil" class="h-full w-full object-cover">
                    @else
                        <span class="text-indigo-800 font-extrabold text-5xl">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    @endif
                </div>

                <div x-show="photoPreview" class="h-32 w-32 rounded-full overflow-hidden shadow-lg border-4 border-indigo-500 bg-gray-100 flex items-center justify-center transition transform group-hover:scale-105" style="display: none;">
                    <img x-bind:src="photoPreview" class="h-full w-full object-cover">
                </div>

                <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>

            <div class="text-center sm:text-left flex flex-col justify-center mt-2 sm:mt-0">
                <h3 class="text-xl font-extrabold text-gray-800">{{ Auth::user()->name }}</h3>
                <p class="text-sm font-medium text-indigo-600 mb-4 bg-indigo-50 inline-block px-3 py-1 rounded-full mt-1 w-max mx-auto sm:mx-0">
                    Akun {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengunjung' }}
                </p>
                
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-bold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all" x-on:click="$refs.photo.click()">
                    📸 Pilih Foto Baru
                </button>
                <x-input-error class="mt-2 text-center sm:text-left" :messages="$errors->get('profile_photo')" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-gray-700" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition-colors" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="font-bold text-gray-700" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition-colors" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <p class="text-sm text-yellow-800 font-medium">
                    {{ __('Alamat email Anda belum diverifikasi.') }}
                    <button form="send-verification" class="ml-2 underline font-bold hover:text-yellow-900 focus:outline-none">
                        {{ __('Kirim ulang email verifikasi.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-bold text-sm text-green-600">
                        {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 mt-6">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-bold text-green-700 bg-green-100 px-4 py-2 rounded-full shadow-sm"
                >✔️ Perubahan Disimpan!</p>
            @endif
            
            <button type="submit" class="px-8 py-3 bg-indigo-600 border border-transparent rounded-lg font-extrabold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all shadow-md transform hover:-translate-y-0.5">
                {{ __('SIMPAN PROFIL') }}
            </button>
        </div>
    </form>
</section>