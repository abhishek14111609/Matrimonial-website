const menuToggle = document.getElementById('menuToggle');
const mainNav = document.getElementById('mainNav');
const notifWrap = document.getElementById('notifWrap');
const notifToggle = document.getElementById('notifToggle');

const pageLoader = document.getElementById('pageLoader');
let navigationTimer = null;

const markPageReady = () => {
    document.body.classList.add('loaded');
    document.body.classList.remove('is-loading', 'page-leaving');

    if (pageLoader) {
        pageLoader.setAttribute('aria-hidden', 'true');
    }
};

window.addEventListener('load', () => {
    markPageReady();
});

// Fix back/forward cache restore where old transition classes can keep the page hidden.
window.addEventListener('pageshow', () => {
    if (navigationTimer) {
        clearTimeout(navigationTimer);
        navigationTimer = null;
    }
    markPageReady();
});

window.addEventListener('popstate', () => {
    markPageReady();
});

window.addEventListener('hashchange', () => {
    markPageReady();
});

window.addEventListener('pagehide', () => {
    if (navigationTimer) {
        clearTimeout(navigationTimer);
        navigationTimer = null;
    }
});

const shouldInterceptNavigation = (event, link) => {
    if (event.defaultPrevented || event.button !== 0) {
        return false;
    }

    if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) {
        return false;
    }

    if (link.target === '_blank' || link.hasAttribute('download') || link.dataset.noTransition === 'true') {
        return false;
    }

    const rawHref = link.getAttribute('href');
    if (!rawHref || rawHref.startsWith('#')) {
        return false;
    }

    const lowerHref = rawHref.toLowerCase();
    if (lowerHref.startsWith('mailto:') || lowerHref.startsWith('tel:') || lowerHref.startsWith('javascript:')) {
        return false;
    }

    const url = new URL(link.href, window.location.href);
    const isExternal = url.origin !== window.location.origin;
    const isSamePage = url.pathname === window.location.pathname && url.search === window.location.search;

    return !isExternal && !isSamePage;
};

document.querySelectorAll('a[href]').forEach((link) => {
    link.addEventListener('click', (event) => {
        if (!shouldInterceptNavigation(event, link)) {
            return;
        }

        const url = new URL(link.href, window.location.href);

        event.preventDefault();
        document.body.classList.add('page-leaving');

        if (navigationTimer) {
            clearTimeout(navigationTimer);
        }

        navigationTimer = setTimeout(() => {
            window.location.href = url.href;
            navigationTimer = null;
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
