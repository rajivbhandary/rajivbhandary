/* Perks Properties: the site's only custom script.
 * Mobile menu, search form niceties, photo gallery and enquiry forms.
 * Everything here is progressive: pages work without it. */
(function () {
    'use strict';

    var csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content;

    /* ---------- Mobile menu ---------- */
    var toggle = document.querySelector('.pp-menu-toggle');
    var nav = document.getElementById('pp-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.querySelector('i').className = open ? 'fa fa-times' : 'fa fa-bars';
        });
    }

    /* ---------- Search: only show "Commercial type" for commercial ---------- */
    document.querySelectorAll('.pp-search').forEach(function (form) {
        form.classList.add('is-js');
        var type = form.querySelector('[data-subtype-target]');
        if (!type) { return; }
        var wrap = form.querySelector(type.getAttribute('data-subtype-target'));
        var sync = function () {
            var commercial = type.value === 'commercial';
            if (commercial) { wrap.removeAttribute('data-subtype-hidden'); }
            else { wrap.setAttribute('data-subtype-hidden', ''); wrap.querySelector('select').value = ''; }
        };
        type.addEventListener('change', sync);
        sync();
    });

    /* ---------- Sort dropdown submits its form ---------- */
    document.querySelectorAll('[data-autosubmit]').forEach(function (el) {
        el.addEventListener('change', function () { el.form.submit(); });
        var btn = el.form.querySelector('[data-autosubmit-fallback]');
        if (btn) { btn.hidden = true; }
    });

    /* ---------- Photo gallery ---------- */
    document.querySelectorAll('[data-gallery]').forEach(function (gallery) {
        var main = gallery.querySelector('[data-gallery-main]');
        gallery.querySelectorAll('[data-gallery-thumb]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                main.src = btn.getAttribute('data-src');
                main.alt = btn.querySelector('img').alt;
                gallery.querySelectorAll('[data-gallery-thumb]').forEach(function (b) { b.removeAttribute('aria-current'); });
                btn.setAttribute('aria-current', 'true');
            });
        });
    });

    /* ---------- Enquiry modal: remember which listing it is about ---------- */
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-enquire]');
        if (!trigger) { return; }
        var form = document.getElementById('enquiryForm');
        if (!form) { return; }
        form.querySelector('[name="model"]').value = trigger.getAttribute('data-model') || '';
        form.querySelector('[name="model_id"]').value = trigger.getAttribute('data-id') || '';
        var about = document.getElementById('enquiryAbout');
        var title = trigger.getAttribute('data-title');
        if (about) {
            about.textContent = title ? 'About: ' + title : 'Tell us what you are looking for and we will call you back.';
        }
    });

    /* ---------- Enquiry forms (modal + contact page) ---------- */
    document.querySelectorAll('[data-enquiry-form]').forEach(function (form) {
        var status = form.querySelector('[data-form-status]');
        var button = form.querySelector('[type="submit"]');

        function clearErrors() {
            form.querySelectorAll('.pp-field.has-error').forEach(function (f) { f.classList.remove('has-error'); });
            form.querySelectorAll('.pp-error').forEach(function (e) { e.remove(); });
            form.querySelectorAll('[aria-invalid]').forEach(function (i) { i.removeAttribute('aria-invalid'); });
        }

        function showStatus(kind, text) {
            status.hidden = false;
            status.className = 'pp-form-status pp-form-status--' + kind;
            status.textContent = text;
            status.focus();
        }

        function showFieldErrors(errors) {
            var first = null;
            Object.keys(errors).forEach(function (name) {
                var input = form.querySelector('[name="' + name + '"]');
                if (!input || input.type === 'hidden' || input.closest('.pp-honeypot')) { return; }
                var field = input.closest('.pp-field');
                field.classList.add('has-error');
                input.setAttribute('aria-invalid', 'true');
                var msg = document.createElement('span');
                msg.className = 'pp-error';
                msg.id = input.id + '-error';
                msg.textContent = errors[name][0];
                field.appendChild(msg);
                input.setAttribute('aria-describedby', msg.id);
                first = first || input;
            });
            if (first) { first.focus(); }
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            clearErrors();
            if (!form.checkValidity()) { form.reportValidity(); return; }

            button.disabled = true;
            var label = button.innerHTML;
            button.textContent = 'Sending…';

            fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                body: new FormData(form)
            }).then(function (res) {
                return res.json().catch(function () { return {}; }).then(function (data) { return { res: res, data: data }; });
            }).then(function (r) {
                if (r.res.ok) {
                    form.reset();
                    showStatus('ok', r.data.message || 'Thank you! We will call you shortly.');
                    if (window.gtag) { window.gtag('event', 'generate_lead', { form: form.id || 'enquiry' }); }
                } else if (r.res.status === 422 && r.data.errors) {
                    showStatus('error', 'Please check the highlighted details.');
                    showFieldErrors(r.data.errors);
                } else if (r.res.status === 429) {
                    showStatus('error', 'Too many attempts. Please wait a minute and try again.');
                } else {
                    showStatus('error', form.getAttribute('data-fallback') || 'Something went wrong. Please try again.');
                }
            }).catch(function () {
                showStatus('error', form.getAttribute('data-fallback') || 'You seem to be offline. Please try again.');
            }).then(function () {
                button.disabled = false;
                button.innerHTML = label;
            });
        });
    });
})();
