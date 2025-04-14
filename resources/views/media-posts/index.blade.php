<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Semua Postingan Media
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Post List -->
        <div id="post-container" class="space-y-6">
            @foreach ($posts as $post)
                @include('media-posts.partials.post', ['post' => $post])
            @endforeach
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden mt-4 text-center">
            <span>Loading...</span>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/post-card.css') }}">
    @endpush

    @push('scripts')
        <script>
            const loadMoreUrl = "{{ route('media-posts.load') }}";
        </script>
        <script src="{{ asset('js/scroll.js') }}" defer></script>

        <script>
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

                            // Toggle warna tombol
                            if (response.liked) {
                                button.removeClass('text-gray-500').addClass('text-pink-500');
                            } else {
                                button.removeClass('text-pink-500').addClass('text-gray-500');
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
