const menuToggle = document.getElementById('menuToggle');
const mainNav = document.getElementById('mainNav');
const notifWrap = document.getElementById('notifWrap');
const notifToggle = document.getElementById('notifToggle');

const pageLoader = document.getElementById('pageLoader');

window.addEventListener('load', () => {
    document.body.classList.add('loaded');
    document.body.classList.remove('is-loading');

    if (pageLoader) {
        pageLoader.setAttribute('aria-hidden', 'true');
    }
});

document.querySelectorAll('a[href]').forEach((link) => {
    link.addEventListener('click', (event) => {
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#')) {
            return;
        }

        const url = new URL(link.href, window.location.href);
        const isSamePage = url.pathname === window.location.pathname && url.search === window.location.search;
        const isExternal = url.origin !== window.location.origin;

        if (event.ctrlKey || event.metaKey || link.target === '_blank' || isExternal || isSamePage) {
            return;
        }

        event.preventDefault();
        document.body.classList.add('page-leaving');
        setTimeout(() => {
            window.location.href = url.href;
        }, 220);
    });
});

if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
        mainNav.classList.toggle('open');
    });
}

if (notifWrap && notifToggle) {
    notifToggle.addEventListener('click', () => {
        const isOpen = notifWrap.classList.toggle('open');
        notifToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', (event) => {
        if (!notifWrap.contains(event.target)) {
            notifWrap.classList.remove('open');
            notifToggle.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            notifWrap.classList.remove('open');
            notifToggle.setAttribute('aria-expanded', 'false');
        }
    });
}

const revealElements = document.querySelectorAll('.reveal');

if (revealElements.length) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
        }
    );

    revealElements.forEach((el) => observer.observe(el));
}

const counters = document.querySelectorAll('.counter');

if (counters.length) {
    const counterObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting || entry.target.dataset.counted === 'true') {
                    return;
                }

                entry.target.dataset.counted = 'true';
                const target = Number(entry.target.dataset.target || 0);
                const suffix = entry.target.dataset.suffix || '';
                const duration = 1200;
                const startTime = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = target * eased;
                    const value = target < 10 ? current.toFixed(1) : Math.round(current).toString();
                    entry.target.textContent = `${value}${suffix}`;

                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    }
                };

                requestAnimationFrame(tick);
                counterObserver.unobserve(entry.target);
            });
        },
        {
            threshold: 0.45,
        }
    );

    counters.forEach((counter) => counterObserver.observe(counter));
}

const track = document.getElementById('testimonialTrack');
if (track) {
    const cards = track.querySelectorAll('.testimonial-card');
    let current = 0;

    if (cards.length > 1) {
        setInterval(() => {
            cards[current].classList.remove('active');
            current = (current + 1) % cards.length;
            cards[current].classList.add('active');
        }, 3800);
    }
}
