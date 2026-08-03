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
            nav.classList.toggle('open', !open);
        });

        // Close on Escape so keyboard users are not trapped in the menu.
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('open')) {
                nav.classList.remove('open');
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
        var wantsReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        target.scrollIntoView({ behavior: wantsReduced ? 'auto' : 'smooth', block: 'start' });

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

    /* ---- WhatsApp chat popup ---- */
    var waBtn  = document.querySelector('.wa-fab');
    var waPopup = document.getElementById('waPopup');
    var waClose = document.getElementById('waClose');
    var waInput = document.getElementById('waInput');
    var waSend  = document.getElementById('waSend');

    if (waBtn && waPopup) {
        function openWa() {
            waPopup.removeAttribute('hidden');
            waBtn.setAttribute('aria-expanded', 'true');
            if (!waInput.value) waInput.value = getContextMessage();
            waInput.focus();
            // Trap focus inside the dialog
            waPopup.addEventListener('keydown', trapFocus);
        }
        function closeWa() {
            waPopup.setAttribute('hidden', '');
            waBtn.setAttribute('aria-expanded', 'false');
            waBtn.focus();
            waPopup.removeEventListener('keydown', trapFocus);
        }
        function trapFocus(e) {
            if (e.key !== 'Tab') return;
            var focusable = waPopup.querySelectorAll('button, textarea, [href], input, select');
            if (!focusable.length) return;
            var first = focusable[0];
            var last = focusable[focusable.length - 1];
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        }
        function getContextMessage() {
            var h1 = document.querySelector('h1');
            var page = h1 ? h1.textContent.trim() : document.title;
            return 'Hi! I need help with: ' + page;
        }

        waBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (waPopup.hasAttribute('hidden')) { openWa(); }
            else { closeWa(); }
        });

        waClose.addEventListener('click', closeWa);

        waSend.addEventListener('click', function() {
            var msg = encodeURIComponent(waInput.value.trim() || 'Hi, I need help with my computer.');
            window.open('https://wa.me/61423680596?text=' + msg, '_blank', 'noopener');
            closeWa();
            waInput.value = '';
        });

        waInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                waSend.click();
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !waPopup.hasAttribute('hidden')) {
                closeWa();
            }
        });
    }
}());
