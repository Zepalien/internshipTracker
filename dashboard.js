document.addEventListener('DOMContentLoaded', () => {
    // 1. Logik Toggle Sidebar
    const wrapper = document.getElementById('wrapper');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.toggle('toggled');
            
            // Simpan status sidebar dalam localStorage (Opsional)
            const isToggled = wrapper.classList.contains('toggled');
            localStorage.setItem('sidebarStatus', isToggled ? 'closed' : 'open');
        });
    }

    // 2. Logik Dark Mode (Bootstrap 5.3+)
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const htmlElement = document.documentElement;

    // Semak tema pilihan pengguna sebelum ini
    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-bs-theme', savedTheme);
    updateIcon(savedTheme);

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });
    }

    function updateIcon(theme) {
        if (!darkModeIcon) return;
        if (theme === 'dark') {
            darkModeIcon.className = 'bi bi-sun-fill'; // Tukar ke ikon matahari
        } else {
            darkModeIcon.className = 'bi bi-moon-stars-fill'; // Tukar ke ikon bulan
        }
    }

    // 3. Shortcut Papan Kekunci (Ctrl + K untuk Carian)
    document.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-input');
            if (searchInput) searchInput.focus();
        }
    });
});