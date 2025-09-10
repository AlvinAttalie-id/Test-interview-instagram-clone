<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-6 bg-gradient-to-br from-indigo-50 to-white">
        <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-xl rounded-2xl">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900">Welcome Back 👋</h1>
                <p class="mt-1 text-sm text-gray-500">Sign in to continue to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12H8m8 0a4 4 0 100-8 4 4 0 000 8zM8 12a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                        </span>
                        <x-text-input id="email" type="email" name="email"
                            class="block w-full pl-10 pr-3 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c.341 0 .674-.034.995-.1M12 11c-.341 0-.674-.034-.995-.1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <x-text-input id="password" type="password" name="password"
                            class="block w-full pl-10 pr-3 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox"
                            class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <x-primary-button
                    class="w-full justify-center py-2.5 text-sm font-medium rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>

            <!-- Register Link -->
            <p class="text-sm text-center text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
