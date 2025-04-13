let page = 1;
let loading = false;

window.addEventListener('scroll', function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300 && !loading) {
        loading = true;
        page++;
        document.getElementById('loading-indicator').classList.remove('hidden');

        fetch(`${loadMoreUrl}?page=${page}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('404 - Data tidak ditemukan');
            }
            return response.json();
        })
        .then(data => {
            if (data.html && data.html.trim() !== '') {
                document.getElementById('post-container').insertAdjacentHTML('beforeend', data.html);
            } else {
                document.getElementById('loading-indicator').innerText = "Tidak ada lagi data.";
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('loading-indicator').innerText = "Gagal memuat data.";
        })
        .finally(() => {
            loading = false;
            document.getElementById('loading-indicator').classList.add('hidden');
        });
    }
});
