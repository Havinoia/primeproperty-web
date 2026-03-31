// ===== DARK MODE TOGGLE =====
const themeToggle = document.getElementById("theme-toggle");
const currentTheme = localStorage.getItem("theme");

// Apply theme on load
if (currentTheme) {
    document.documentElement.setAttribute("data-theme", currentTheme);
    if (currentTheme === "dark") {
        themeToggle.innerHTML = "🌙";
    } else {
        themeToggle.innerHTML = "☀️";
    }
} else {
    // Default to light mode
    themeToggle.innerHTML = "☀️";
}

themeToggle.addEventListener("click", () => {
    let theme = "light";
    if (document.documentElement.getAttribute("data-theme") === "light" || !document.documentElement.getAttribute("data-theme")) {
        theme = "dark";
        themeToggle.innerHTML = "🌙";
    } else {
        theme = "light";
        themeToggle.innerHTML = "☀️";
    }
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
});

// ===== MOBILE MENU TOGGLE =====
const menuToggle = document.getElementById("menu-toggle");
const navMenu = document.querySelector("nav");

if (menuToggle && navMenu) {
    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navMenu.classList.toggle("active");
        document.body.style.overflow = navMenu.classList.contains("active") ? "hidden" : "auto";
    });

    // Close menu when clicking links
    const navLinks = navMenu.querySelectorAll("a");
    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            menuToggle.classList.remove("active");
            navMenu.classList.remove("active");
            document.body.style.overflow = "auto";
        });
    });
}

// ===== NAVBAR SCROLL EFFECT =====
window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    header.classList.toggle("scrolled", window.scrollY > 50);
});

// ===== REVEAL ANIMATION =====
const reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {
    reveals.forEach((element) => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;

        if (elementTop < windowHeight - 80) {
            element.classList.add("active");
        }
    });
}

window.addEventListener("scroll", revealOnScroll);
window.addEventListener("load", revealOnScroll);
revealOnScroll(); // Initial check