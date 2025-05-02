@props([
    'message',
    'type' => 'success', // Bisa: success, error, info, warning
])

@php
    $bgColor = match ($type) {
        'success' => 'bg-green-600',
        'error' => 'bg-red-600',
        'info' => 'bg-blue-600',
        'warning' => 'bg-yellow-600 text-black',
        default => 'bg-gray-600',
    };
@endphp

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="fixed z-50 px-4 py-2 text-white {{ $bgColor }} rounded shadow top-4 right-4" x-transition>
    {{ $message }}
</div>
