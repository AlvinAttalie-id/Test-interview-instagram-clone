<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- ✅ Dashboard untuk Admin --}}
                    @role('admin')
                        <h3 class="text-lg font-semibold mb-2">Halo, Admin 👑</h3>
                        <p>Ini adalah halaman dashboard khusus admin.</p>
                        {{-- Tambahkan fitur admin di sini --}}
                    @else
                        {{-- ✅ Dashboard untuk User --}}
                        <h3 class="text-lg font-semibold mb-2">Halo, Pengguna 👋</h3>
                        <p>Selamat datang di dashboard pengguna.</p>
                        {{-- Tambahkan fitur user di sini --}}
                    @endrole

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
