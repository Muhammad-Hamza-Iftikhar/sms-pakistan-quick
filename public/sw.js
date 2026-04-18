const CACHE_NAME = 'pak-sms-connect-v1';
const OFFLINE_FALLBACK_URL = '/';

self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches
            .open(CACHE_NAME)
            .then((cache) => cache.add(OFFLINE_FALLBACK_URL))
            .catch(() => null)
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches
            .keys()
            .then((keys) =>
                Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key)))
            )
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') {
        return;
    }

    const requestUrl = new URL(event.request.url);
    if (requestUrl.origin !== self.location.origin) {
        return;
    }

    event.respondWith(
        fetch(event.request).catch(async () => {
            const cachedResponse = await caches.match(event.request);
            if (cachedResponse) {
                return cachedResponse;
            }

            if (event.request.mode === 'navigate') {
                const fallbackResponse = await caches.match(OFFLINE_FALLBACK_URL);
                if (fallbackResponse) {
                    return fallbackResponse;
                }
            }

            return new Response('Offline', { status: 503, statusText: 'Offline' });
        })
    );
});
