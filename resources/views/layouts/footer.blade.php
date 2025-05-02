<footer class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 rounded-md shadow sm:hidden">
    <div class="flex justify-around text-gray-600">
        {{-- Post --}}
        <a href="{{ route('media-posts.index') }}"
            class="flex flex-col items-center justify-center w-full py-2 hover:text-blue-500 {{ request()->routeIs('media-posts.index') ? 'text-blue-500 font-semibold' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
            </svg>
            <span class="text-xs">Post</span>
        </a>

        {{-- Search User --}}
        <a href="{{ route('users.index') }}"
            class="flex flex-col items-center justify-center w-full py-2 hover:text-blue-500 {{ request()->routeIs('users.index', 'users.search.*') ? 'text-blue-500 font-semibold' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M7 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
                <path d="M23 11h-6" />
                <path d="M20 8v6" />
            </svg>
            <span class="text-xs">Search User</span>
        </a>

        {{-- Add Post --}}
        <a href="{{ route('media-posts.create') }}"
            class="flex flex-col items-center justify-center w-full py-2 hover:text-blue-500 {{ request()->routeIs('media-posts.create') ? 'text-blue-500 font-semibold' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-xs">Add</span>
        </a>

        {{-- Profile --}}
        <a href="{{ route('profile.page') }}"
            class="flex flex-col items-center justify-center w-full py-2 hover:text-blue-500 {{ request()->routeIs('profile.page') ? 'text-blue-500 font-semibold' : '' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5.121 17.804A10 10 0 1112 22a9.978 9.978 0 01-6.879-4.196zM12 14a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            <span class="text-xs">Profile</span>
        </a>
    </div>
</footer>
