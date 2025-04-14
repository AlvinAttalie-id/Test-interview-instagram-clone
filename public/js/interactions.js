document.addEventListener('DOMContentLoaded', function () {
    // Like Button
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.dataset.id;
            fetch(`/media-posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                this.querySelector('.like-count').textContent = data.likes_count;
                document.querySelector(`.like-count-${postId}`).textContent = data.likes_count;
            });
        });
    });

    // Toggle Comment Section
    document.querySelectorAll('.comment-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.dataset.id;
            const commentSection = document.getElementById(`comments-${postId}`);
            commentSection.classList.toggle('hidden');
        });
    });

    // Submit Comment
    document.querySelectorAll('.comment-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const postId = this.dataset.id;
            const commentInput = this.querySelector('input[name="comment"]');
            const comment = commentInput.value;

            fetch(`/media-posts/${postId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ comment })
            })
            .then(res => res.json())
            .then(data => {
                const commentsList = document.querySelector(`.comments-list-${postId}`);
                const newComment = document.createElement('li');
                newComment.innerHTML = `<strong>${data.user}</strong>: ${data.comment} <small class="text-gray-400">(baru saja)</small>`;
                commentsList.prepend(newComment);

                document.querySelector(`.comment-count-${postId}`).textContent = data.comments_count;
                form.reset();
            });
        });
    });
});
