<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-600 to-cyan-500">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black text-white tracking-tight drop-shadow-md">Pondok Daeng Lala</h1>
            <p class="text-blue-50 font-medium mt-2">Silakan masuk ke akun Anda.</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl rounded-3xl border border-gray-100">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-bold text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('Password')" class="font-bold text-gray-700" />
                    <div class="relative">
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required 
                            class="block mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pr-10">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                            <!-- Ikon Mata Terbuka (Show) -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <!-- Ikon Mata Coret (Hide) -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 1-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="mt-6 flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" name="remember">
                        <span class="ms-2 font-medium">Ingat saya</span>
                    </label>
                    <a class="text-blue-600 hover:text-blue-900 font-bold" href="{{ route('password.request') }}">Lupa?</a>
                </div>

                <button class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3 rounded-xl transition shadow-lg">
                    LOG IN
                </button>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar sekarang</a>
                </p>
            </form>

            <!-- Separator -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="bg-white px-2 text-gray-400 font-medium">Atau</span></div>
            </div>

            <!-- Google Login -->
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 border border-gray-300 rounded-xl py-3 hover:bg-gray-50 transition font-bold text-gray-700">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-5 h-5" alt="Google">
                Lanjutkan dengan Google
            </a>
        </div>
    </div>
</x-guest-layout>