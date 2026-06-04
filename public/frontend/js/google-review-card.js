/**
 * Google review card — clamp 4 lines, Xem thêm / Thu gọn
 * Dùng event delegation (tương thích Swiper loop clone).
 */
(function (window, document) {
    'use strict';

    var MAX_LINES = 4;
    var MIN_CHARS = 120;
    var bound = false;

    function updateToggleLabels(btn, expanded) {
        var more = btn.querySelector('.google-review-card__toggle-more');
        var less = btn.querySelector('.google-review-card__toggle-less');
        if (more) {
            more.hidden = expanded;
        }
        if (less) {
            less.hidden = !expanded;
        }
    }

    function measureOverflow(text) {
        var content = (text.textContent || '').trim();
        if (content.length >= MIN_CHARS) {
            return true;
        }

        var wrap = text.parentElement;
        var width = text.offsetWidth || (wrap && wrap.offsetWidth) || 0;
        if (width < 40 && wrap) {
            width = wrap.getBoundingClientRect().width;
        }
        if (width < 40) {
            return content.length > 80;
        }

        var clone = text.cloneNode(true);
        clone.removeAttribute('id');
        clone.classList.remove('is-clamped', 'is-expanded');
        clone.style.cssText =
            'position:absolute;left:-9999px;top:0;visibility:hidden;' +
            'display:block;height:auto;width:' +
            width +
            'px;overflow:visible;-webkit-line-clamp:unset;';

        document.body.appendChild(clone);
        var fullHeight = clone.offsetHeight;
        document.body.removeChild(clone);

        var lineHeight = parseFloat(window.getComputedStyle(text).lineHeight);
        if (!lineHeight || isNaN(lineHeight)) {
            lineHeight = (parseFloat(window.getComputedStyle(text).fontSize) || 17) * 1.65;
        }

        return fullHeight > lineHeight * MAX_LINES + 2;
    }

    function setCollapsed(wrap) {
        var text = wrap.querySelector('.google-review-card__text');
        var btn = wrap.querySelector('[data-review-toggle]');
        if (!text || !btn) {
            return;
        }

        text.classList.remove('is-expanded');
        text.classList.add('is-clamped');
        btn.setAttribute('aria-expanded', 'false');
        updateToggleLabels(btn, false);
    }

    function checkWrap(wrap) {
        var text = wrap.querySelector('.google-review-card__text');
        var btn = wrap.querySelector('[data-review-toggle]');
        if (!text || !btn) {
            return;
        }

        if (text.classList.contains('is-expanded')) {
            btn.hidden = false;
            return;
        }

        setCollapsed(wrap);
        btn.hidden = !measureOverflow(text);
        if (btn.hidden) {
            text.classList.remove('is-clamped');
        }
    }

    function bindDelegation() {
        if (bound) {
            return;
        }
        bound = true;

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-review-toggle]');
            if (!btn) {
                return;
            }

            e.preventDefault();

            var wrap = btn.closest('[data-review-text-wrap]');
            if (!wrap) {
                return;
            }

            var text = wrap.querySelector('.google-review-card__text');
            if (!text) {
                return;
            }

            var expanded = !text.classList.contains('is-expanded');
            text.classList.toggle('is-expanded', expanded);
            text.classList.toggle('is-clamped', !expanded);
            btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            btn.hidden = false;
            updateToggleLabels(btn, expanded);
        });
    }

    function initReviewTextToggles(root) {
        bindDelegation();
        (root || document).querySelectorAll('[data-review-text-wrap]').forEach(checkWrap);
    }

    function scheduleInit() {
        initReviewTextToggles(document);
        window.setTimeout(function () {
            initReviewTextToggles(document);
        }, 400);
        window.setTimeout(function () {
            initReviewTextToggles(document);
        }, 1200);
    }

    window.initReviewTextToggles = initReviewTextToggles;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', scheduleInit);
    } else {
        scheduleInit();
    }

    window.addEventListener('load', function () {
        initReviewTextToggles(document);
    });
})(window, document);
