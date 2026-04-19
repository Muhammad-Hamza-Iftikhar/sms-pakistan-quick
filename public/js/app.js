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

    bindSiteNavigation();
    bindInstallButtons(showToast);
    bindSmsForm(showToast);
    bindContactForm(showToast);
    bindServicesFilters();
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

function bindSiteNavigation() {
    const header = document.querySelector('[data-site-header]');
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');

    if (header) {
        const onScroll = () => {
            header.classList.toggle('is-scrolled', window.scrollY > 8);
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (!toggle || !menu) {
        return;
    }

    const closeMenu = () => {
        menu.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
    };

    const openMenu = () => {
        menu.hidden = false;
        toggle.setAttribute('aria-expanded', 'true');
    };

    toggle.addEventListener('click', () => {
        if (menu.hidden) {
            openMenu();
            return;
        }

        closeMenu();
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    window.addEventListener('resize', () => {
        if (window.matchMedia('(min-width: 960px)').matches) {
            closeMenu();
        }
    });
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

function bindContactForm(showToast) {
    const form = document.querySelector('[data-contact-form]');

    if (!form) {
        return;
    }

    const messageInput = form.querySelector('[data-contact-message]');
    const charCounter = form.querySelector('[data-contact-char]');
    const nameInput = form.querySelector('[name="name"]');
    const emailInput = form.querySelector('[name="email"]');
    const subjectInput = form.querySelector('[name="subject"]');

    const updateCounter = () => {
        if (!messageInput || !charCounter) {
            return;
        }

        charCounter.textContent = `${messageInput.value.length}/2000`;
    };

    if (messageInput) {
        messageInput.addEventListener('input', updateCounter);
        updateCounter();
    }

    form.addEventListener('submit', (event) => {
        if (!messageInput || !nameInput || !emailInput || !subjectInput) {
            return;
        }

        nameInput.value = nameInput.value.trim();
        emailInput.value = emailInput.value.trim();
        subjectInput.value = subjectInput.value.trim();
        messageInput.value = messageInput.value.trim();

        if (nameInput.value.length < 2) {
            event.preventDefault();
            showToast('Missing name', 'Please enter your full name.');
            return;
        }

        if (subjectInput.value.length < 3) {
            event.preventDefault();
            showToast('Missing subject', 'Please enter a short subject.');
            return;
        }

        if (messageInput.value.length < 10) {
            event.preventDefault();
            showToast('Message too short', 'Please enter at least 10 characters.');
            return;
        }

        showToast('Sending message...');
    });
}

function bindServicesFilters() {
    const searchInput = document.querySelector('[data-service-search]');
    const chips = Array.from(document.querySelectorAll('[data-service-chip]'));
    const cards = Array.from(document.querySelectorAll('[data-service-card]'));
    const featured = document.querySelector('[data-service-featured]');
    const emptyState = document.querySelector('[data-services-empty]');

    if (!searchInput || !chips.length || !cards.length) {
        return;
    }

    let activeCategory = 'All';

    const matchesFilter = (card, query, category) => {
        const cardCategory = card.getAttribute('data-category') || '';
        const title = card.getAttribute('data-title') || '';
        const excerpt = card.getAttribute('data-excerpt') || '';
        const author = card.getAttribute('data-author') || '';

        const inCategory = category === 'All' || cardCategory === category;
        const haystack = `${cardCategory} ${title} ${excerpt} ${author}`.toLowerCase();
        const inSearch = !query || haystack.includes(query);

        return inCategory && inSearch;
    };

    const applyFilters = () => {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        cards.forEach((card) => {
            const isFeatured = card.hasAttribute('data-service-featured');
            const shouldShow = matchesFilter(card, query, activeCategory);

            card.classList.toggle('hidden', !shouldShow);

            if (!isFeatured && shouldShow) {
                visibleCount += 1;
            }
        });

        const hasVisibleFeatured = featured ? !featured.classList.contains('hidden') : false;
        const hasAnyVisible = hasVisibleFeatured || visibleCount > 0;

        if (emptyState) {
            emptyState.classList.toggle('hidden', hasAnyVisible);
        }
    };

    chips.forEach((chip) => {
        chip.addEventListener('click', () => {
            const category = chip.getAttribute('data-category') || 'All';
            activeCategory = category;

            chips.forEach((item) => {
                item.classList.toggle('is-active', item === chip);
            });

            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);
    applyFilters();
}
