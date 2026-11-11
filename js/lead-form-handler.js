/**
 * Keystone Lead Consultation AJAX Form Handler (Quiet Luxury Edition)
 * File: /themes/keystone-recomposition-child/js/lead-form-handler.js
 * Binds strictly to executive consultation forms, collects full FormData payload,
 * dispatches to POST /wp-json/keystone/v1/lead-consultation, and renders honest
 * Sovereign Gold (#d4af37) & Luminous Baby Blue (#38bdf8) inline feedback.
 */

(function () {
    'use strict';

    var LEAD_FORM_SELECTOR = 'form.luxury-inquiry-form, form.keystone-lead-form, form[data-keystone-lead-form]';
    var EXCLUDED_FORM_SELECTOR = '#heroDirectCheckoutForm, #krChannelWebsiteSetupForm, #automatedProtocolOrderForm, #vaultUidUnlockForm, [role="search"], .search-form';

    function escapeHtml(raw) {
        return String(raw == null ? '' : raw)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function buildMailtoHref(payload) {
        var subject = '[Keystone Executive Inquiry] ' + (payload.contact_category || 'Consultation') +
            (payload.contact_name ? ' — ' + payload.contact_name : '');
        var lines = [
            'Full Name: ' + (payload.contact_name || ''),
            'Email: ' + (payload.contact_email || ''),
            'Category: ' + (payload.contact_category || 'General Executive Consultation'),
            'Budget / Scale: ' + (payload.contact_budget || 'Not Specified')
        ];
        if (payload.project_address) {
            lines.push('Project Address: ' + payload.project_address);
        }
        lines.push('');
        lines.push('Project Overview & Requirements:');
        lines.push(payload.contact_message || '');
        return 'mailto:keystonerecomposition@gmail.com?subject=' +
            encodeURIComponent(subject) +
            '&body=' +
            encodeURIComponent(lines.join('\n'));
    }

    function ensureFeedbackBox(form) {
        var feedbackDiv = form.querySelector('.form-feedback-message');
        if (!feedbackDiv) {
            feedbackDiv = document.createElement('div');
            feedbackDiv.className = 'form-feedback-message';
            feedbackDiv.setAttribute('role', 'status');
            feedbackDiv.setAttribute('aria-live', 'polite');
            feedbackDiv.style.marginTop = '16px';
            feedbackDiv.style.marginBottom = '14px';
            feedbackDiv.style.padding = '14px 18px';
            feedbackDiv.style.borderRadius = '12px';
            feedbackDiv.style.fontSize = '0.88rem';
            feedbackDiv.style.lineHeight = '1.55';
            feedbackDiv.style.textAlign = 'left';
            feedbackDiv.style.transition = 'all 0.25s ease';

            var submitRow = form.querySelector('.form-submit-row');
            if (submitRow && submitRow.parentNode === form) {
                form.insertBefore(feedbackDiv, submitRow);
            } else {
                form.appendChild(feedbackDiv);
            }
        }
        return feedbackDiv;
    }

    function renderSuccessNotice(feedbackDiv, result) {
        var msg = (result && result.message)
            ? result.message
            : "Executive Inquiry Logged. Wayne Stevenson's desk responds within 24–48 business hours.";
        var refBadge = (result && result.inquiry_id)
            ? '<div style="margin-top:6px;font-family:\'JetBrains Mono\',monospace;font-size:0.76rem;color:#38bdf8;">Reference ID: <strong>' + escapeHtml(result.inquiry_id) + '</strong></div>'
            : '';

        feedbackDiv.style.background = 'rgba(212, 175, 55, 0.14)';
        feedbackDiv.style.border = '1px solid rgba(212, 175, 55, 0.45)';
        feedbackDiv.style.color = '#f8fafc';
        feedbackDiv.innerHTML =
            '<div style="color:#d4af37;font-weight:800;letter-spacing:0.03em;margin-bottom:4px;">✔ EXECUTIVE INQUIRY RECEIVED</div>' +
            '<div>' + escapeHtml(msg) + '</div>' +
            refBadge;
    }

    function renderFallbackErrorNotice(feedbackDiv, errorText, payload) {
        var mailtoHref = buildMailtoHref(payload);
        var reason = errorText || 'Unable to complete direct portal transmission right now.';

        feedbackDiv.style.background = 'rgba(4, 7, 13, 0.96)';
        feedbackDiv.style.border = '1px solid rgba(56, 189, 248, 0.45)';
        feedbackDiv.style.color = '#f8fafc';
        feedbackDiv.innerHTML =
            '<div style="color:#d4af37;font-weight:800;letter-spacing:0.03em;margin-bottom:4px;">⚡ ATTENTION — INPUT PRESERVED</div>' +
            '<div style="margin-bottom:8px;">' + escapeHtml(reason) + '</div>' +
            '<div style="font-size:0.83rem;color:#cbd5e1;">Your message above has been preserved. Please review and retry, or dispatch directly via email: ' +
            '<a href="' + escapeHtml(mailtoHref) + '" style="color:#38bdf8;font-weight:700;text-decoration:underline;">keystonerecomposition@gmail.com &#8599;</a></div>';
    }

    function readFormValue(fd, form, names, fallbackSelector) {
        for (var i = 0; i < names.length; i++) {
            var val = fd.get(names[i]);
            if (typeof val === 'string' && val.trim() !== '') {
                return val.trim();
            }
        }
        if (fallbackSelector) {
            var el = form.querySelector(fallbackSelector);
            if (el && typeof el.value === 'string' && el.value.trim() !== '') {
                return el.value.trim();
            }
        }
        return '';
    }

    function collectPayload(form) {
        var fd = new FormData(form);

        var firstName = readFormValue(fd, form, ['first_name'], '#form-first-name, input[name="first_name"]');
        var surname = readFormValue(fd, form, ['surname', 'last_name'], '#form-surname, input[name="surname"], input[name="last_name"]');
        var combinedLegacyName = (firstName + ' ' + surname).trim();

        var contactName = readFormValue(fd, form, ['contact_name', 'name'], '#contact_name, input[name="contact_name"], input[name="name"]') || combinedLegacyName;
        var contactEmail = readFormValue(fd, form, ['contact_email', 'email'], '#contact_email, input[name="contact_email"], input[type="email"]');
        var contactCategory = readFormValue(fd, form, ['contact_category', 'category', 'consultation_type'], '#contact_category, select[name="contact_category"], select[name="category"]');
        var contactBudget = readFormValue(fd, form, ['contact_budget', 'budget'], '#contact_budget, select[name="contact_budget"], select[name="budget"]');
        var contactMessage = readFormValue(fd, form, ['contact_message', 'message', 'notes'], '#contact_message, textarea[name="contact_message"], textarea[name="notes"], textarea');
        var projectAddress = readFormValue(fd, form, ['project_address'], '#form-project-address, input[name="project_address"]');
        var websiteUrl = readFormValue(fd, form, ['website_url', 'company_fax'], 'input[name="website_url"], input[name="company_fax"]');

        var consentEl = form.querySelector('[name="consent_agreed"], #form-disclosure-agreement');

        return {
            contact_name: contactName,
            contact_email: contactEmail,
            contact_category: contactCategory,
            contact_budget: contactBudget,
            contact_message: contactMessage,
            project_address: projectAddress,
            website_url: websiteUrl,
            name: contactName,
            email: contactEmail,
            category: contactCategory,
            budget: contactBudget,
            message: contactMessage,
            consent_agreed: consentEl ? Boolean(consentEl.checked) : true,
            page_source: window.location.href || window.location.pathname
        };
    }

    function shouldSkipForm(form) {
        if (!form || form.nodeName !== 'FORM') {
            return true;
        }
        if (form.hasAttribute('data-keystone-form-ignore')) {
            return true;
        }
        if (typeof form.matches === 'function' && form.matches(EXCLUDED_FORM_SELECTOR)) {
            return true;
        }
        if (typeof form.closest === 'function' && form.closest('#wpadminbar, .wp-admin')) {
            return true;
        }
        var actionAttr = form.getAttribute('action') || '';
        if (actionAttr.indexOf('wp-login') !== -1) {
            return true;
        }
        return false;
    }

    function initLeadFormHandler() {
        var forms = document.querySelectorAll(LEAD_FORM_SELECTOR);
        forms.forEach(function (form) {
            if (shouldSkipForm(form)) {
                return;
            }
            if (form.getAttribute('data-lead-handler-bound') === 'true') {
                return;
            }
            form.setAttribute('data-lead-handler-bound', 'true');

            if (form.hasAttribute('onsubmit')) {
                form.removeAttribute('onsubmit');
            }

            form.addEventListener('submit', async function (e) {
                if (shouldSkipForm(form)) {
                    return;
                }
                e.preventDefault();
                e.stopPropagation();

                var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                var originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
                var originalBtnVal = (submitBtn && submitBtn.tagName === 'INPUT') ? submitBtn.value : '';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.72';
                    if (submitBtn.tagName === 'INPUT') {
                        submitBtn.value = 'Transmitting...';
                    } else {
                        submitBtn.innerHTML = 'Transmitting Executive Inquiry...';
                    }
                }

                var feedbackDiv = ensureFeedbackBox(form);
                var payload = collectPayload(form);

                try {
                    var response = await fetch('/wp-json/keystone/v1/lead-consultation', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    var result = null;
                    try {
                        result = await response.json();
                    } catch (parseErr) {
                        result = null;
                    }

                    if (response.ok && result && (result.ok === true || result.success === true || result.status === 'success')) {
                        renderSuccessNotice(feedbackDiv, result);
                        form.reset();
                    } else {
                        var serverMsg = (result && result.message)
                            ? result.message
                            : ('Portal returned HTTP ' + response.status + '. Please verify all required fields or email Wayne Stevenson directly.');
                        renderFallbackErrorNotice(feedbackDiv, serverMsg, payload);
                    }
                } catch (err) {
                    renderFallbackErrorNotice(
                        feedbackDiv,
                        'Network connection interrupted before confirmation was received.',
                        payload
                    );
                } finally {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                        if (submitBtn.tagName === 'INPUT') {
                            submitBtn.value = originalBtnVal;
                        } else {
                            submitBtn.innerHTML = originalBtnHtml;
                        }
                    }
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLeadFormHandler);
    } else {
        initLeadFormHandler();
    }
})();
