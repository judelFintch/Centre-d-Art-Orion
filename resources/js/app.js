// ─── Scroll Reveal ─────────────────────────────────────────────
function initReveal() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );
    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
}

// ─── Mobile Navigation Toggle ──────────────────────────────────
function initNav() {
    const burger = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-overlay');
    const closeButton = document.getElementById('mobile-close');

    if (!burger || !mobileMenu) return;

    function open() {
        mobileMenu.classList.remove('-translate-x-full');
        mobileMenu.classList.add('translate-x-0');
        overlay?.classList.remove('opacity-0', 'pointer-events-none');
        overlay?.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
        burger.setAttribute('aria-expanded', 'true');
    }
    function close() {
        mobileMenu.classList.add('-translate-x-full');
        mobileMenu.classList.remove('translate-x-0');
        overlay?.classList.add('opacity-0', 'pointer-events-none');
        overlay?.classList.remove('opacity-100');
        document.body.style.overflow = '';
        burger.setAttribute('aria-expanded', 'false');
    }

    burger.addEventListener('click', () => {
        mobileMenu.classList.contains('-translate-x-full') ? open() : close();
    });
    closeButton?.addEventListener('click', close);
    overlay?.addEventListener('click', close);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
    });
    document.querySelectorAll('.mobile-nav-link').forEach((l) => l.addEventListener('click', close));
}

// ─── Sticky Header ─────────────────────────────────────────────
function initStickyHeader() {
    const header = document.getElementById('main-header');
    if (!header) return;
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}

// ─── Counter Animation ─────────────────────────────────────────
function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = parseInt(el.dataset.counter, 10);
        let current = 0;
        const step = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = current.toLocaleString();
            if (current >= target) clearInterval(timer);
        }, 25);
    });
}

function initCounters() {
    const section = document.querySelector('.stats-section');
    if (!section) return;
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.disconnect();
                }
            });
        },
        { threshold: 0.3 }
    );
    observer.observe(section);
}

// ─── Hero Slider ───────────────────────────────────────────────
function initHeroSlider() {
    const container = document.getElementById('hero-slides-container');
    if (!container) return;

    const slides = container.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.getElementById('hero-prev');
    const nextBtn = document.getElementById('hero-next');

    if (slides.length < 2) return;

    let current = 0;
    let timer = null;
    const INTERVAL = 6000;

    function goTo(index) {
        slides[current].style.opacity = '0';
        dots[current].style.width = '12px';
        dots[current].style.background = 'rgba(255,255,255,0.25)';
        const prevProgress = dots[current].querySelector('.dot-progress');
        if (prevProgress) {
            prevProgress.style.transition = 'none';
            prevProgress.style.transform = 'scaleX(0)';
        }

        current = (index + slides.length) % slides.length;

        slides[current].style.opacity = '1';
        dots[current].style.width = '28px';
        dots[current].style.background = '#4caf7d';

        const activeProgress = dots[current].querySelector('.dot-progress');
        if (activeProgress) {
            activeProgress.style.transition = 'none';
            activeProgress.style.transform = 'scaleX(0)';
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    activeProgress.style.transition = `transform ${INTERVAL}ms linear`;
                    activeProgress.style.transform = 'scaleX(1)';
                });
            });
        }
    }

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(() => goTo(current + 1), INTERVAL);
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            goTo(parseInt(dot.dataset.index, 10));
            startAuto();
        });
    });

    prevBtn?.addEventListener('click', () => { goTo(current - 1); startAuto(); });
    nextBtn?.addEventListener('click', () => { goTo(current + 1); startAuto(); });

    // Pause on hover
    container.closest('section')?.addEventListener('mouseenter', () => clearInterval(timer));
    container.closest('section')?.addEventListener('mouseleave', startAuto);

    // Swipe support
    let touchStartX = 0;
    container.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
    container.addEventListener('touchend', (e) => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) > 50) { goTo(dx < 0 ? current + 1 : current - 1); startAuto(); }
    });

    goTo(0);
    startAuto();
}

// ─── Gallery Lightbox ──────────────────────────────────────────
function initLightbox() {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox) return;

    const img = lightbox.querySelector('#lightbox-img');
    const caption = lightbox.querySelector('#lightbox-caption');

    document.querySelectorAll('[data-lightbox]').forEach((el) => {
        el.addEventListener('click', () => {
            img.src = el.dataset.src || el.src;
            if (caption) caption.textContent = el.dataset.caption || '';
            lightbox.style.display = 'flex';
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightbox.style.display = '';
        document.body.style.overflow = '';
    }

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox || e.target.closest('#lightbox-close')) {
            closeLightbox();
        }
    });
}

// ─── Active Nav Link ───────────────────────────────────────────
function initActiveNav() {
    const path = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach((link) => {
        const href = link.getAttribute('href');
        if (href && (path === href || (href !== '/' && path.startsWith(href)))) {
            link.classList.add('active');
        }
    });
}

// ─── Contact Form ──────────────────────────────────────────────
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = form.querySelector('[type=submit]');
        btn.disabled = true;
        btn.textContent = 'Envoi en cours…';
        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    Accept: 'application/json',
                },
                body: new FormData(form),
            });
            const data = await res.json();
            if (res.ok) {
                showAlert('success', data.message || 'Message envoyé avec succès !');
                form.reset();
            } else {
                showAlert('error', data.message || 'Une erreur est survenue.');
            }
        } catch {
            showAlert('error', 'Impossible d\'envoyer le message.');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Envoyer le message';
        }
    });
}

function showAlert(type, msg) {
    const el = document.getElementById('form-alert');
    if (!el) return;
    el.textContent = msg;
    el.className = `mt-4 p-4 rounded text-sm font-medium ${
        type === 'success'
            ? 'bg-green-900/40 text-green-300 border border-green-700'
            : 'bg-red-900/40 text-red-300 border border-red-700'
    }`;
    el.classList.remove('hidden');
    setTimeout(() => el.classList.add('hidden'), 6000);
}

// ─── Bootstrap ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initNav();
    initStickyHeader();
    initCounters();
    initHeroSlider();
    initLightbox();
    initActiveNav();
    initContactForm();
});
