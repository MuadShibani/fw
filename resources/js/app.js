/* Wathba Platform — Public JS */
document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu
    const hamburger = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
    // Navbar scroll
    const navbar = document.getElementById('mainNav');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });
    }
    // Auto-dismiss alerts
    document.querySelectorAll('.alert').forEach(a => {
        setTimeout(() => { a.style.opacity='0'; setTimeout(()=>a.remove(),400); }, 4000);
    });
    // Smooth anchor scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const t = document.querySelector(anchor.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({behavior:'smooth'}); }
        });
    });
});
