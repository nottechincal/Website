/**
 * Rapid Tech Solutions — site behaviour.
 *
 * Replaces four separate inline <script> blocks that previously ran two
 * competing IntersectionObservers and drove the emergency banner by mutating
 * document.body.style.paddingTop on every scroll event, which guaranteed a
 * Cumulative Layout Shift penalty. The banner is now CSS position:sticky.
 */
(function () {
    'use strict';

    /* ------------------------------------------------------ mobile nav ---- */

    var toggle = document.querySelector('.menu-toggle');
    var nav = document.getElementById('primary-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            nav.classList.toggle('is-open', !open);
        });

        // Close on Escape so keyboard users are not trapped in the menu.
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }

    /* ----------------------------------------------- scroll animations ---- */

    var animated = document.querySelectorAll('[data-animate]');

    if (animated.length) {
        var reveal = function (el) { el.classList.add('is-visible'); };

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
            !('IntersectionObserver' in window)) {
            // Respect the user's motion preference: show everything at once.
            animated.forEach(reveal);
        } else {
            // threshold 0 with no negative rootMargin: the previous 0.1 /
            // -50px combination could be skipped entirely during fast or
            // programmatic scrolling, leaving elements stuck at opacity 0.
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        reveal(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0, rootMargin: '0px 0px 10% 0px' });

            animated.forEach(function (el) { observer.observe(el); });

            // Safety net. An animation is decoration; content being readable
            // is not. If anything is still hidden shortly after load, show it
            // regardless of whether the observer ever fired for it.
            window.addEventListener('load', function () {
                setTimeout(function () {
                    animated.forEach(function (el) {
                        if (!el.classList.contains('is-visible')) {
                            reveal(el);
                            observer.unobserve(el);
                        }
                    });
                }, 2500);
            });
        }
    }

    /* ---------------------------------------------------- smooth scroll --- */

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href^="#"]');
        if (!link) { return; }

        var id = link.getAttribute('href');
        if (id === '#') { return; }

        var target = document.querySelector(id);
        if (!target) { return; }

        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Keep the URL shareable and move focus for screen readers.
        history.pushState(null, '', id);
        target.setAttribute('tabindex', '-1');
        target.focus({ preventScroll: true });
    });

    /* ----------------------------------------------------- hero video ----- */

    var video = document.getElementById('bg-video');

    if (video) {
        var wantsMotion = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var isDesktop = window.matchMedia('(min-width: 1024px)').matches;
        var saveData = navigator.connection && navigator.connection.saveData;

        if (isDesktop && wantsMotion && !saveData) {
            var mp4 = document.createElement('source');
            mp4.src = video.dataset.src;
            mp4.type = 'video/mp4';
            video.appendChild(mp4);
            video.load();
        } else {
            // Mobile, reduced motion or Data Saver: the poster alone is enough.
            video.removeAttribute('autoplay');
            video.pause();
        }
    }

    /* ------------------------------------------------- deferred chat ------ */
    /*
     * Tawk.to is ~250KB of third-party JS. Loading it on first interaction
     * instead of on load keeps it out of the Largest Contentful Paint window.
     */

    var chatId = document.body.dataset.tawk;

    if (chatId) {
        var loaded = false;
        var load = function () {
            if (loaded) { return; }
            loaded = true;

            window.Tawk_API = window.Tawk_API || {};
            window.Tawk_LoadStart = new Date();

            var s = document.createElement('script');
            s.async = true;
            s.src = 'https://embed.tawk.to/' + chatId;
            s.charset = 'UTF-8';
            s.setAttribute('crossorigin', '*');
            document.head.appendChild(s);
        };

        ['pointerdown', 'keydown', 'touchstart'].forEach(function (evt) {
            window.addEventListener(evt, load, { once: true, passive: true });
        });

        // Guarantee it eventually loads even for a completely idle visitor.
        if ('requestIdleCallback' in window) {
            requestIdleCallback(load, { timeout: 15000 });
        } else {
            setTimeout(load, 15000);
        }
    }
}());
