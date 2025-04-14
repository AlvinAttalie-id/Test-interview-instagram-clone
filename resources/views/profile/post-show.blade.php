<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Postingan {{ $user->username }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-6 mx-auto">
        <div class="mb-4">
            <a href="{{ route('profile.page') }}" class="text-blue-600 hover:underline">&larr; Kembali ke profil</a>
        </div>

        <div class="p-4 mb-4 bg-white rounded-lg shadow-md post-card">
            {{-- Username dan dropdown --}}
            <div class="flex items-center justify-between mb-2">
                <span class="font-semibold">{{ $post->user->name }}</span>
                <div class="relative">
                    <button class="text-gray-500 hover:text-black focus:outline-none"
                        onclick="toggleDropdown(event)">⋯</button>
                    <div class="absolute right-0 z-10 hidden mt-2 bg-white border rounded shadow dropdown-menu">
                        <!-- Opsi untuk menghapus postingan -->
                        <form action="{{ route('profile.posts.delete', $post) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="block px-4 py-2 text-sm hover:bg-gray-100">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Media --}}
            <div class="mb-2">
                @if ($post->file_type === 'image')
                    <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post Image" class="w-full rounded-md">
                @elseif ($post->file_type === 'video')
                    <video controls class="w-full rounded-md">
                        <source src="{{ asset('storage/' . $post->file_path) }}">
                    </video>
                @endif
            </div>

            {{-- Caption --}}
            @if ($post->caption)
                <p class="mb-2 text-sm text-gray-700">{{ $post->caption }}</p>
            @endif

            {{-- Like & Comment Count --}}
            <div class="mb-2 text-xs text-gray-500">
                <span class="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span> Likes •
                <span class="comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span> Comments
            </div>

            {{-- Action buttons --}}
            <div class="flex items-center justify-around pt-2 mb-2 text-gray-600 border-t">
                @php
                    $isLiked = $post->likes->contains('user_id', auth()->id());
                @endphp

                {{-- Like Button --}}
                <button class="flex items-center gap-1 like-button {{ $isLiked ? 'text-pink-500' : 'text-gray-500' }}"
                    data-id="{{ $post->id }}">
                    <i class="fa-heart {{ $isLiked ? 'fas' : 'far' }} like-icon"></i>
                    <span class="like-count">{{ $post->likes->count() }}</span>
                </button>

                {{-- Comment Toggle --}}
                <button class="flex items-center gap-1 hover:text-blue-500 comment-toggle"
                    data-id="{{ $post->id }}">
                    💬 <span class="comment-count">{{ $post->comments->count() }}</span>
                </button>
            </div>

            {{-- Comment Section (hidden by default) --}}
            <div class="hidden comment-section" id="comments-{{ $post->id }}">
                <form class="flex gap-2 mb-2 comment-form" data-id="{{ $post->id }}">
                    <input type="text" name="comment" placeholder="Tulis komentar..." required
                        class="flex-1 px-3 py-1 text-sm border rounded">
                    <button type="submit" class="px-3 py-1 text-sm text-white bg-blue-500 rounded">Kirim</button>
                </form>

                <ul class="text-sm space-y-1 comments-list-{{ $post->id }}">
                    @foreach ($post->comments as $comment)
                        <li>
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                            <small class="text-gray-400">({{ $comment->created_at->diffForHumans() }})</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/post-card.css') }}">
    @endpush

    @push('scripts')
        <script>
            // Fungsi untuk menampilkan atau menyembunyikan dropdown menu
            function toggleDropdown(event) {
                event.stopPropagation();
                let dropdownMenu = event.target.closest('button').nextElementSibling;
                dropdownMenu.classList.toggle('hidden'); // Menyembunyikan atau menampilkan dropdown
            }

            // Tutup dropdown jika klik di luar elemen
            document.addEventListener('click', function(event) {
                let dropdownMenus = document.querySelectorAll('.dropdown-menu');
                dropdownMenus.forEach(function(menu) {
                    if (!menu.contains(event.target)) {
                        menu.classList.add('hidden');
                    }
                });
            });

            $(document).ready(function() {
                // Fungsi Like
                $(document).on('click', '.like-button', function() {
                    const button = $(this);
                    const postId = button.data('id');

                    $.ajax({
                        url: '{{ route('like.toggle') }}',
                        method: 'POST',
                        data: {
                            media_post_id: postId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Update jumlah like
                            $('.like-count-' + postId).text(response.likes_count);

                            // Toggle warna tombol dan ikon
                            if (response.liked) {
                                button.find('.like-icon').removeClass('far').addClass(
                                    'fas text-pink-500');
                            } else {
                                button.find('.like-icon').removeClass('fas text-pink-500').addClass(
                                    'far text-gray-500');
                            }

                            // Update angka like di dalam tombol
                            button.find('.like-count').text(response.likes_count);
                        },
                        error: function(xhr, status, error) {
                            console.error('Like Error:', error);
                        }
                    });
                });

                // Toggle komentar
                $(document).on('click', '.comment-toggle', function() {
                    const postId = $(this).data('id');
                    $('#comments-' + postId).toggleClass('hidden');
                });

                // Kirim komentar
                $(document).on('submit', '.comment-form', function(e) {
                    e.preventDefault();

                    const form = $(this);
                    const postId = form.data('id');
                    const commentText = form.find('input[name="comment"]').val();

                    $.ajax({
                        url: '{{ route('comments.store', ['mediaPost' => ':postId']) }}'.replace(
                            ':postId', postId),
                        method: 'POST',
                        data: {
                            comment: commentText,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response && response.comment && response.comment.user) {
                                const comment = response.comment;
                                const timeAgo = moment(comment.created_at).fromNow();

                                $('.comments-list-' + postId).append(`
                                    <li>
                                        <strong>${comment.user.name}</strong>: ${comment.comment}
                                        <small class="text-gray-400">(${timeAgo})</small>
                                    </li>
                                `);

                                // Update jumlah komentar
                                const commentCountEl = $('.comment-count-' + postId);
                                commentCountEl.text(parseInt(commentCountEl.text()) + 1);

                                form.find('input[name="comment"]').val('');
                            } else {
                                console.error('Komentar atau user tidak lengkap:', response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Comment Error:', error);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
