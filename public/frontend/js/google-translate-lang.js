/**
 * Google Translate — VI / EN switcher (reusable)
 *
 * Requires:
 *   - #google_translate_element (hidden)
 *   - .gt-lang with buttons [data-gt-lang="vi|en"]
 *   - google-translate-lang.css
 *
 * Config via window.GT_LANG_CONFIG:
 *   { pageLanguage: 'vi', languages: ['vi', 'en'] }
 */
(function (global) {
    'use strict';

    var CONFIG = global.GT_LANG_CONFIG || {
        pageLanguage: 'vi',
        languages: ['vi', 'en'],
    };

    var COOKIE_NAME = 'googtrans';

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : '';
    }

  function getCookieDomains() {
        var hostname = window.location.hostname;
        var domains = [null];

        if (!hostname || hostname === 'localhost' || hostname.indexOf('.') === -1) {
            return domains;
        }

        var rootDomain = hostname.replace(/^www\./, '');
        domains.push('.' + rootDomain);
        domains.push(rootDomain);

        if (hostname.indexOf('www.') === 0) {
            domains.push(hostname);
        }

        return domains.filter(function (domain, index, list) {
            return list.indexOf(domain) === index;
        });
    }

    function setGoogTransCookie(lang) {
        var pageLang = CONFIG.pageLanguage || 'vi';
        var value = lang === pageLang ? '/' + pageLang + '/' + pageLang : '/' + pageLang + '/' + lang;
        var encoded = encodeURIComponent(value);
        var secure = window.location.protocol === 'https:' ? ';Secure' : '';
        var sameSite = ';SameSite=Lax';

        getCookieDomains().forEach(function (domain) {
            var base = COOKIE_NAME + '=' + encoded + ';path=/' + sameSite + secure;
            document.cookie = domain ? base + ';domain=' + domain : base;
        });
    }

    function clearGoogTransCookie() {
        var expired = COOKIE_NAME + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT;SameSite=Lax';
        var secure = window.location.protocol === 'https:' ? ';Secure' : '';

        getCookieDomains().forEach(function (domain) {
            var base = expired + secure;
            document.cookie = domain ? base + ';domain=' + domain : base;
        });
    }

    function getActiveLang() {
        var val = getCookie(COOKIE_NAME);
        var pageLang = CONFIG.pageLanguage || 'vi';

        if (!val) {
            return pageLang;
        }

        var parts = val.split('/').filter(Boolean);
        if (parts.length >= 2) {
            return parts[1];
        }

        if (val.indexOf('/en') !== -1) {
            return 'en';
        }

        return pageLang;
    }

    function updateButtons(root) {
        var active = getActiveLang();
        root.querySelectorAll('[data-gt-lang]').forEach(function (btn) {
            var lang = btn.getAttribute('data-gt-lang');
            btn.classList.toggle('is-active', lang === active);
            btn.setAttribute('aria-pressed', lang === active ? 'true' : 'false');
        });
    }

    function switchLanguage(lang) {
        var pageLang = CONFIG.pageLanguage || 'vi';
        if (lang === getActiveLang()) {
            return;
        }

        document.querySelectorAll('.gt-lang').forEach(function (el) {
            el.classList.add('is-loading');
        });

        // Google Translate needs an explicit /vi/vi cookie to restore Vietnamese on production.
        clearGoogTransCookie();
        setGoogTransCookie(lang);

        window.location.reload();
    }

    function loadGoogleTranslateScript() {
        if (document.getElementById('google-translate-script')) {
            return;
        }

        global.googleTranslateElementInit = function () {
            if (!global.google || !global.google.translate) {
                return;
            }
            new global.google.translate.TranslateElement(
                {
                    pageLanguage: CONFIG.pageLanguage || 'vi',
                    includedLanguages: (CONFIG.languages || ['vi', 'en']).join(','),
                    autoDisplay: false,
                    multilanguagePage: true,
                },
                'google_translate_element'
            );
        };

        var script = document.createElement('script');
        script.id = 'google-translate-script';
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        script.async = true;
        document.body.appendChild(script);
    }

    function bindSwitcher(root) {
        if (!root || root.getAttribute('data-gt-inited') === '1') {
            return;
        }

        updateButtons(root);

        root.querySelectorAll('[data-gt-lang]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                switchLanguage(btn.getAttribute('data-gt-lang'));
            });
        });

        root.setAttribute('data-gt-inited', '1');
    }

    function init() {
        loadGoogleTranslateScript();
        document.querySelectorAll('.gt-lang').forEach(bindSwitcher);
    }

    global.GTLang = {
        init: init,
        getActiveLang: getActiveLang,
        switchLanguage: switchLanguage,
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})(typeof window !== 'undefined' ? window : this);
