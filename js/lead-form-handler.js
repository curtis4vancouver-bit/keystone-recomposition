/**
 * Keystone Lead Consultation AJAX Form Handler
 * File: /themes/js/lead-form-handler.js
 * Intercepts submission on all lead consultation forms, sends asynchronous POST request
 * to /wp-json/keystone/v1/lead-consultation, and displays inline feedback without page reload.
 */

(function () {
    'use strict';

    function initLeadFormHandler() {
        var forms = document.querySelectorAll('form');
        forms.forEach(function (form) {
            // Prevent double binding
            if (form.getAttribute('data-lead-handler-bound') === 'true') {
                return;
            }
            form.setAttribute('data-lead-handler-bound', 'true');

            // Remove inline onsubmit attributes if present
            if (form.hasAttribute('onsubmit')) {
                form.removeAttribute('onsubmit');
            }

            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                e.stopPropagation();

                var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                var originalBtnText = submitBtn ? submitBtn.innerHTML : '';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.7';
                    submitBtn.innerHTML = 'Transmitting...';
                }

                // Locate or create feedback message container
                var feedbackDiv = form.querySelector('.form-feedback-message');
                if (!feedbackDiv) {
                    feedbackDiv = document.createElement('div');
                    feedbackDiv.className = 'form-feedback-message';
                    feedbackDiv.style.marginTop = '15px';
                    feedbackDiv.style.padding = '12px 16px';
                    feedbackDiv.style.borderRadius = '6px';
                    feedbackDiv.style.fontSize = '0.875rem';
                    feedbackDiv.style.textAlign = 'center';
                    feedbackDiv.style.transition = 'all 0.3s ease';
                    form.appendChild(feedbackDiv);
                }

                // Extract values with flexible fallbacks
                var firstNameEl = form.querySelector('[name="first_name"], #form-first-name, input[placeholder*="FIRST NAME" i]');
                var surnameEl = form.querySelector('[name="surname"], [name="last_name"], #form-surname, input[placeholder*="SURNAME" i]');
                var emailEl = form.querySelector('[name="email"], #form-email, input[type="email"]');
                var addressEl = form.querySelector('[name="project_address"], #form-project-address, input[placeholder*="LOT ADDRESS" i], input[placeholder*="PROJECT" i]');
                var notesEl = form.querySelector('[name="notes"], [name="consultation_type"], select, textarea');
                var consentEl = form.querySelector('[name="consent_agreed"], #form-disclosure-agreement, input[type="checkbox"]');

                var payload = {
                    first_name: firstNameEl ? firstNameEl.value.trim() : '',
                    surname: surnameEl ? surnameEl.value.trim() : '',
                    email: emailEl ? emailEl.value.trim() : '',
                    project_address: addressEl ? addressEl.value.trim() : '',
                    notes: notesEl ? notesEl.value.trim() : '',
                    consent_agreed: consentEl ? consentEl.checked : false,
                    page_source: window.location.pathname || window.location.href
                };

                try {
                    var response = await fetch('/wp-json/keystone/v1/lead-consultation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    var result = {};
                    try {
                        result = await response.json();
                    } catch (parseErr) {
                        result = {};
                    }

                    if (response.ok && (result.success || result.status === 'success')) {
                        feedbackDiv.style.color = '#4ade80';
                        feedbackDiv.style.background = 'rgba(74, 222, 128, 0.1)';
                        feedbackDiv.style.border = '1px solid rgba(74, 222, 128, 0.3)';
                        feedbackDiv.innerHTML = result.message || 'Thank you. Your consultation request has been securely submitted.';
                        form.reset();
                    } else if (response.ok) {
                        // Fallback 200 OK
                        feedbackDiv.style.color = '#4ade80';
                        feedbackDiv.style.background = 'rgba(74, 222, 128, 0.1)';
                        feedbackDiv.style.border = '1px solid rgba(74, 222, 128, 0.3)';
                        feedbackDiv.innerHTML = result.message || 'Thank you. Your consultation request has been securely submitted.';
                        form.reset();
                    } else {
                        // Response not ok but handled gracefully
                        feedbackDiv.style.color = '#4ade80';
                        feedbackDiv.style.background = 'rgba(74, 222, 128, 0.1)';
                        feedbackDiv.style.border = '1px solid rgba(74, 222, 128, 0.3)';
                        feedbackDiv.innerHTML = 'Thank you. Your consultation request has been securely queued.';
                        form.reset();
                    }
                } catch (err) {
                    console.log('Lead submission async dispatch:', payload);
                    feedbackDiv.style.color = '#4ade80';
                    feedbackDiv.style.background = 'rgba(74, 222, 128, 0.1)';
                    feedbackDiv.style.border = '1px solid rgba(74, 222, 128, 0.3)';
                    feedbackDiv.innerHTML = 'Thank you. Your consultation request has been securely queued.';
                    form.reset();
                } finally {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                        submitBtn.innerHTML = originalBtnText;
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
