<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-6 bg-gradient-to-br from-indigo-50 to-white">
        <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-xl rounded-2xl">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900">Create Account ✨</h1>
                <p class="mt-1 text-sm text-gray-500">Join us and start your journey today</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.755 6.879 2.046M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <x-text-input id="name" type="text" name="name"
                            class="block w-full pl-10 pr-3 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                        <x-text-input id="username" type="text" name="username"
                            class="block w-full pl-10 pr-3 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            :value="old('username')" required autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Email -->
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
                            :value="old('email')" required autocomplete="email" />
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
                            required autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 21V7a2 2 0 00-2-2H6a2 2 0 00-2 2v14l8-4 8 4z" />
                            </svg>
                        </span>
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                            class="block w-full pl-10 pr-3 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required autocomplete="new-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <x-primary-button
                    class="w-full justify-center py-2.5 text-sm font-medium rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
                    {{ __('Register') }}
                </x-primary-button>
            </form>

            <!-- Login Link -->
            <p class="text-sm text-center text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Log in
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
