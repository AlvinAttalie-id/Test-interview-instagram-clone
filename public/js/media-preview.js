function previewMedia(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('media-preview');
    const container = document.getElementById('preview-container');

    container.innerHTML = '';
    preview.classList.remove('hidden');

    if (file && file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = "object-cover w-full h-64";
        container.appendChild(img);
    } else if (file && file.type.startsWith('video/')) {
        const video = document.createElement('video');
        video.src = URL.createObjectURL(file);
        video.className = "object-cover w-full h-64";
        video.controls = true;
        container.appendChild(video);
    } else {
        container.innerHTML = "<p class='p-4 text-sm text-red-600'>Format tidak didukung</p>";
    }
}

function previewMedia(event) {
    const file = event.target.files[0];
    const maxSize = 150 * 1024 * 1024; // 150MB dalam byte

    if (file && file.size > maxSize) {
        alert("Ukuran file melebihi batas maksimum 150MB.");
        event.target.value = ''; // clear file input
        return;
    }

    const previewContainer = document.getElementById('preview-container');
    const mediaPreview = document.getElementById('media-preview');
    previewContainer.innerHTML = '';

    if (file) {
        mediaPreview.classList.remove('hidden');
        const url = URL.createObjectURL(file);

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = url;
            img.className = "object-contain w-full h-auto";
            previewContainer.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.className = "object-contain w-full h-auto";
            previewContainer.appendChild(video);
        }
    }
}
