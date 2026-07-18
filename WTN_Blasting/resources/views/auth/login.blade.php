<x-guest-layout>

    <div class="text-center mb-8">
        <a href="{{ route('landing.index') }}" class="inline-flex items-center gap-2 text-2xl font-extrabold tracking-tight text-white">
            WTN <span class="text-wtn-orange">BLASTING</span>
        </a>
        <p class="text-neutral-400 text-sm mt-2">Masuk ke Admin Panel</p>
    </div>

    <div class="bg-neutral-900/70 border border-white/10 backdrop-blur rounded-2xl p-8 shadow-[0_0_60px_-20px_rgba(255,106,0,.35)]">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1.5 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Lupa Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-neutral-400">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-white/20 bg-white/5 text-wtn-orange focus:ring-wtn-orange/50">
                    {{ __('Ingat saya') }}
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-neutral-400 hover:text-wtn-orange transition" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full">
                {{ __('Masuk') }}
            </x-primary-button>
        </form>
    </div>

    <p class="text-center text-xs text-neutral-500 mt-6">
        <a href="{{ route('landing.index') }}" class="hover:text-wtn-orange transition">&larr; Kembali ke Website</a>
    </p>

</x-guest-layout>
