<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-slate-50 px-4">
        <div class="w-full max-w-md">
            {{-- Card --}}
            <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl ring-1 ring-gray-100 p-8">
                
                {{-- Logo & title --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0m8 0a4 4 0 10-8 0m8 0v1a4 4 0 11-8 0V7"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 mt-3">Masuk ke SIPMAS</h1>
                    <p class="text-sm text-gray-500">Sistem Informasi Pengaduan Masyarakat</p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email"
                                      class="mt-1 block w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                      type="email"
                                      name="email"
                                      :value="old('email')"
                                      required autofocus autocomplete="username"
                                      placeholder="contoh@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password"
                                      class="mt-1 block w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password"
                                      placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                   name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-700 font-medium"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    {{-- Button --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 active:scale-[.98] transition shadow">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>

                {{-- Footer kecil --}}
                <p class="text-xs text-gray-400 text-center mt-6">
                    © {{ date('Y') }} SIPMAS • UNTAD Palu
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
