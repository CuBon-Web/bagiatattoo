/**
 * Google Translate VI / EN — bản đơn giản, ổn định
 *
 * Cần: #google_translate_element, .gt-lang [data-gt-lang]
 * Lưu lựa chọn: localStorage "gt_site_lang" + cookie googtrans (chỉ path=/)
 */
(function (global) {
    'use strict';

    var PAGE_LANG = 'vi';
    var STORAGE_KEY = 'gt_site_lang';
    var COOKIE_NAME = 'googtrans';
    var COOKIE_MAX_AGE = 60 * 60 * 24 * 365;

    function readCookie() {
        var match = document.cookie.match(/(?:^|;\s*)googtrans=([^;]*)/);
        return match ? decodeURIComponent(match[1]) : '';
    }

    function cookieValueForLang(lang) {
        return lang === 'en' ? '/' + PAGE_LANG + '/en' : '/' + PAGE_LANG + '/' + PAGE_LANG;
    }

    function purgeLegacyGoogTransCookies() {
        var expired = COOKIE_NAME + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
        var host = global.location.hostname;
        var domains = [null];

        if (host && host.indexOf('.') !== -1 && host !== 'localhost') {
            var root = host.replace(/^www\./, '');
            domains.push('.' + root, root);
            if (host.indexOf('www.') === 0) {
                domains.push(host);
            }
        }

        domains.forEach(function (domain) {
            document.cookie = domain ? expired + ';domain=' + domain : expired;
        });
    }

    function writeGoogTransCookie(lang) {
        var value = cookieValueForLang(lang);
        var secure = global.location.protocol === 'https:' ? ';Secure' : '';

        purgeLegacyGoogTransCookies();
        document.cookie =
            COOKIE_NAME +
            '=' +
            encodeURIComponent(value) +
            ';path=/;max-age=' +
            COOKIE_MAX_AGE +
            ';SameSite=Lax' +
            secure;
    }

    function getSavedLang() {
        try {
            var stored = global.localStorage.getItem(STORAGE_KEY);
            if (stored === 'en' || stored === 'vi') {
                return stored;
            }
        } catch (e) {}

        var cookie = readCookie();
        if (cookie.indexOf('/en') !== -1) {
            return 'en';
        }

        return PAGE_LANG;
    }

    function saveLang(lang) {
        try {
            global.localStorage.setItem(STORAGE_KEY, lang);
        } catch (e) {}
        writeGoogTransCookie(lang);
    }

    function updateButtons() {
        var active = getSavedLang();
        document.querySelectorAll('.gt-lang [data-gt-lang]').forEach(function (btn) {
            var lang = btn.getAttribute('data-gt-lang');
            var isActive = lang === active;
            btn.classList.toggle('is-active', isActive);
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    }

    function switchLanguage(lang) {
        if (lang !== 'vi' && lang !== 'en') {
            return;
        }
        if (lang === getSavedLang()) {
            return;
        }

        document.querySelectorAll('.gt-lang').forEach(function (el) {
            el.classList.add('is-loading');
        });

        saveLang(lang);
        global.location.reload();
    }

    function loadGoogleTranslate() {
        if (document.getElementById('google-translate-script')) {
            return;
        }

        global.googleTranslateElementInit = function () {
            if (!global.google || !global.google.translate) {
                updateButtons();
                return;
            }

            new global.google.translate.TranslateElement(
                {
                    pageLanguage: PAGE_LANG,
                    includedLanguages: 'vi,en',
                    autoDisplay: false,
                },
                'google_translate_element'
            );

            updateButtons();
        };

        var script = document.createElement('script');
        script.id = 'google-translate-script';
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        script.async = true;
        document.body.appendChild(script);
    }

    function bindSwitchers() {
        document.querySelectorAll('.gt-lang').forEach(function (root) {
            if (root.getAttribute('data-gt-inited') === '1') {
                return;
            }

            root.querySelectorAll('[data-gt-lang]').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    switchLanguage(btn.getAttribute('data-gt-lang'));
                });
            });

            root.setAttribute('data-gt-inited', '1');
        });

        updateButtons();
    }

    function init() {
        bindSwitchers();
        loadGoogleTranslate();
    }

    global.GTLang = {
        init: init,
        getSavedLang: getSavedLang,
        switchLanguage: switchLanguage,
        writeGoogTransCookie: writeGoogTransCookie,
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})(window);
