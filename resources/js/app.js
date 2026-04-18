document.addEventListener('DOMContentLoaded', () => {
    registerServiceWorker();

    const toastHost = ensureToastHost();

    const showToast = (title, description = '') => {
        const item = document.createElement('div');
        item.className = 'toast-item';

        const heading = document.createElement('strong');
        heading.textContent = title;
        item.appendChild(heading);

        if (description) {
            const detail = document.createElement('span');
            detail.textContent = description;
            item.appendChild(detail);
        }

        toastHost.appendChild(item);
        setTimeout(() => item.remove(), 2800);
    };

    bindInstallButtons(showToast);
    bindSmsForm(showToast);
});

function registerServiceWorker() {
    const supportsServiceWorker = 'serviceWorker' in navigator;
    const isLocalhost = ['localhost', '127.0.0.1'].includes(window.location.hostname);
    const canRegister = supportsServiceWorker && (window.isSecureContext || isLocalhost);

    if (!canRegister) {
        return;
    }

    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch((error) => {
            console.error('Service worker registration failed:', error);
        });
    });
}

function ensureToastHost() {
    let host = document.querySelector('[data-toast-host]');

    if (!host) {
        host = document.createElement('div');
        host.setAttribute('data-toast-host', '1');
        host.className = 'toast-wrap';
        document.body.appendChild(host);
    }

    return host;
}

function bindInstallButtons(showToast) {
    const buttons = Array.from(document.querySelectorAll('[data-install-app]'));

    if (!buttons.length) {
        return;
    }

    let deferredInstallPrompt = null;
    const isStandalone =
        (window.matchMedia && window.matchMedia('(display-mode: standalone)').matches) ||
        window.navigator.standalone === true;

    const setButtonsHidden = (hidden) => {
        buttons.forEach((button) => {
            button.classList.toggle('hidden', hidden);
        });
    };

    if (isStandalone) {
        setButtonsHidden(true);
    }

    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredInstallPrompt = event;
        if (!isStandalone) {
            setButtonsHidden(false);
        }
    });

    window.addEventListener('appinstalled', () => {
        deferredInstallPrompt = null;
        setButtonsHidden(true);
        showToast('App installed');
    });

    buttons.forEach((button) => {
        button.addEventListener('click', async () => {
            if (deferredInstallPrompt) {
                await deferredInstallPrompt.prompt();
                const choice = await deferredInstallPrompt.userChoice;

                if (choice && choice.outcome === 'accepted') {
                    showToast('Installing...');
                } else {
                    showToast('Install canceled');
                }

                deferredInstallPrompt = null;
                return;
            }

            const isIOS = /iphone|ipad|ipod/i.test(window.navigator.userAgent) && !/crios|fxios/i.test(window.navigator.userAgent);

            if (isIOS) {
                showToast('Install on iOS', "Tap Share, then 'Add to Home Screen'.");
                return;
            }

            if (!window.isSecureContext) {
                showToast('Install unavailable', 'Use HTTPS or localhost to install this app.');
                return;
            }

            showToast('Install not available yet', 'Open this site in Chrome or Edge on mobile or desktop.');
        });
    });
}

function bindSmsForm(showToast) {
    const smsForm = document.querySelector('[data-sms-form]');

    if (!smsForm) {
        return;
    }

    const phoneInput = smsForm.querySelector('[data-phone-input]');
    const messageInput = smsForm.querySelector('[data-message-input]');
    const phoneError = smsForm.querySelector('[data-phone-error]');
    const phoneHint = smsForm.querySelector('[data-phone-hint]');
    const messageError = smsForm.querySelector('[data-message-error]');
    const charCount = smsForm.querySelector('[data-char-count]');

    if (!phoneInput || !messageInput) {
        return;
    }

    const normalizePhone = (raw) => {
        let value = raw.replace(/[^\d+]/g, '');

        if (value.startsWith('+92')) {
            value = value.slice(3);
        } else if (value.startsWith('0092')) {
            value = value.slice(4);
        } else if (value.startsWith('92') && value.length === 12) {
            value = value.slice(2);
        } else if (value.startsWith('0')) {
            value = value.slice(1);
        }

        return value.slice(0, 10);
    };

    const formatPhone = (local) => {
        if (!local) {
            return '';
        }

        const first = local.slice(0, 3);
        const second = local.slice(3, 10);
        return second ? `${first} ${second}` : first;
    };

    const setPhoneError = (message) => {
        if (!phoneError || !phoneHint) {
            return;
        }

        if (message) {
            phoneError.textContent = message;
            phoneError.classList.remove('hidden');
            phoneHint.classList.add('hidden');
            return;
        }

        phoneError.textContent = '';
        phoneError.classList.add('hidden');
        phoneHint.classList.remove('hidden');
    };

    const setMessageError = (message) => {
        if (!messageError) {
            return;
        }

        if (message) {
            messageError.textContent = message;
            messageError.classList.remove('hidden');
            return;
        }

        messageError.textContent = '';
        messageError.classList.add('hidden');
    };

    const updateCounter = () => {
        if (charCount) {
            charCount.textContent = `${messageInput.value.length}/500`;
        }
    };

    phoneInput.addEventListener('input', () => {
        const local = normalizePhone(phoneInput.value);
        phoneInput.value = formatPhone(local);
        setPhoneError('');
    });

    messageInput.addEventListener('input', () => {
        updateCounter();
        setMessageError('');
    });

    phoneInput.value = formatPhone(normalizePhone(phoneInput.value));
    updateCounter();

    smsForm.addEventListener('submit', (event) => {
        const local = normalizePhone(phoneInput.value);
        const trimmedMessage = messageInput.value.trim();

        let hasError = false;

        if (!/^3\d{9}$/.test(local)) {
            setPhoneError('Enter a valid PK mobile (e.g. 300 1234567).');
            hasError = true;
        } else {
            setPhoneError('');
        }

        if (trimmedMessage.length < 1) {
            setMessageError('Message cannot be empty.');
            hasError = true;
        } else if (trimmedMessage.length > 500) {
            setMessageError('Message must be under 500 characters.');
            hasError = true;
        } else {
            setMessageError('');
        }

        if (hasError) {
            event.preventDefault();
            return;
        }

        phoneInput.value = local;
        messageInput.value = trimmedMessage;
        showToast('Sending SMS...');
    });
}
