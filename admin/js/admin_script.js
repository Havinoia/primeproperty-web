// ===== THEME TOGGLE FOR ADMIN =====
const themeToggle = document.getElementById('theme-toggle');
const htmlElement = document.documentElement;

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        htmlElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        themeToggle.textContent = newTheme === 'dark' ? '🌙' : '☀️';
    });
}

// Set initial icon
const savedTheme = localStorage.getItem('theme') || 'light';
if (themeToggle) {
    themeToggle.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
}

// ===== MOBILE MENU TOGGLE FOR ADMIN =====
const menuToggle = document.getElementById('menu-toggle');
const navMenu = document.querySelector('nav');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : 'auto';
    });

    // Close menu when clicking links
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
}
