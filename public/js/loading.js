// Ambil elemen form dan loading screen
const form = document.querySelector('form');
const loadingScreen = document.getElementById('loading-screen');

// Event listener ketika form disubmit
form.addEventListener('submit', function (event) {
    // Tampilkan loading screen
    loadingScreen.classList.remove('hidden');
    loadingScreen.classList.add('flex');
});

