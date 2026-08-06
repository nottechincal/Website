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

    /* ------------------------------------------------------ mobile nav ----
     *
     * This is the ONLY mobile-nav implementation on the site. The homepage
     * used to carry a second copy in an inline <script>, and the two fought
     * each other: the inline handler opened the panel and set
     * aria-expanded="true", then this handler read that same attribute,
     * concluded the menu was already open and closed it again. One click,
     * two handlers, net effect nothing — the menu appeared to be dead while
     * the backdrop still went up and the page still locked behind it.
     *
     * The backdrop and the scroll lock are optional: pages without a
     * .nav-backdrop element simply skip them.
     */

    var toggle = document.querySelector('.menu-toggle');
    var nav = document.getElementById('primary-nav');
    var backdrop = document.querySelector('.nav-backdrop');

    if (toggle && nav) {
        var setNav = function (open) {
            toggle.classList.toggle('open', open);
            toggle.setAttribute('aria-expanded', String(open));
            nav.classList.toggle('open', open);
            if (backdrop) { backdrop.classList.toggle('open', open); }
            document.body.style.overflow = open ? 'hidden' : '';
        };

        toggle.addEventListener('click', function () {
            setNav(!nav.classList.contains('open'));
        });

        if (backdrop) {
            backdrop.addEventListener('click', function () { setNav(false); });
        }

        // Following a link should not leave the panel covering the page it
        // just scrolled to.
        nav.addEventListener('click', function (e) {
            if (e.target.closest('a')) { setNav(false); }
        });

        // Close on Escape so keyboard users are not trapped in the menu.
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('open')) {
                setNav(false);
                toggle.focus();
            }
        });

        // The panel is only off-canvas below 860px. Resizing past that point
        // while it is open otherwise leaves body overflow locked on desktop.
        window.matchMedia('(min-width: 861px)').addEventListener('change', function (e) {
            if (e.matches && nav.classList.contains('open')) { setNav(false); }
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

    /* ---------------------------------------------------------------- a11y ---- */

    // Hide decorative emoji from screen readers. Walk text nodes and wrap
    // emoji runs in aria-hidden spans so assistive tech skips them.
    function hideDecorativeEmoji() {
        var emojiRe = /[\u{1F300}-\u{1F9FF}\u{2600}-\u{27BF}\u{FE00}-\u{FEFF}\u{200D}\u{20E3}\u{FE0F}\u{00A9}\u{00AE}\u{2122}\u{23CF}\u{23E9}-\u{23F3}\u{23F8}-\u{23FA}\u{25AA}-\u{25AB}\u{25B6}\u{25C0}\u{25FB}-\u{25FE}\u{2934}-\u{2935}\u{2B05}-\u{2B07}\u{2B1B}-\u{2B1C}\u{2B50}\u{2B55}\u{3030}\u{303D}\u{3297}\u{3299}]+/gu;
        var skipSelectors = 'input,textarea,select,script,style,code,pre,[aria-hidden="true"]';
        var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
            acceptNode: function(node) {
                if (node.parentElement && (node.parentElement.matches(skipSelectors) || node.parentElement.closest(skipSelectors))) {
                    return NodeFilter.FILTER_REJECT;
                }
                return emojiRe.test(node.textContent) ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
            }
        });
        var nodes = [];
        while (walker.nextNode()) { nodes.push(walker.currentNode); }
        nodes.forEach(function(textNode) {
            var frag = document.createDocumentFragment();
            var text = textNode.textContent;
            var match, lastIdx = 0;
            emojiRe.lastIndex = 0;
            while ((match = emojiRe.exec(text)) !== null) {
                if (match.index > lastIdx) {
                    frag.appendChild(document.createTextNode(text.slice(lastIdx, match.index)));
                }
                var span = document.createElement('span');
                span.setAttribute('aria-hidden', 'true');
                span.textContent = match[0];
                frag.appendChild(span);
                lastIdx = emojiRe.lastIndex;
            }
            if (lastIdx < text.length) {
                frag.appendChild(document.createTextNode(text.slice(lastIdx)));
            }
            if (frag.childNodes.length) {
                textNode.parentNode.replaceChild(frag, textNode);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', hideDecorativeEmoji);
    } else {
        hideDecorativeEmoji();
    }

    /* Pause reviews scroller on keyboard focus */
    (function() {
        var scroller = document.querySelector('.reviews-scroll');
        if (!scroller) { return; }
        var paused = false;
        var pause = function() { paused = true; };
        var resume = function() { paused = false; };
        scroller.addEventListener('mouseenter', pause);
        scroller.addEventListener('mouseleave', resume);
        scroller.addEventListener('focusin', pause);
        scroller.addEventListener('focusout', function(e) {
            if (!scroller.contains(e.relatedTarget)) { resume(); }
        });
        // Override auto-advance to respect pause state
        var origAdvance = window.advanceReviews;
        if (typeof origAdvance === 'function') {
            window.advanceReviews = function() {
                if (!paused) { origAdvance(); }
            };
        }
    })();
}());
