/**
 * Service Worker for Laravel Livewire PWA
 *
 * Strategy:
 *  - Static assets (CSS, JS, fonts, images): Cache-First
 *  - Navigation requests (HTML pages): Network-First with offline fallback
 */

const CACHE_VERSION = 'v1';
const STATIC_CACHE = `static-${CACHE_VERSION}`;
const DYNAMIC_CACHE = `dynamic-${CACHE_VERSION}`;
const OFFLINE_URL = '/offline';

// Assets to pre-cache during install
const PRECACHE_ASSETS = [
    '/',
    '/offline',
];

// --------------------
// Install Event
// --------------------
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS);
        }).then(() => self.skipWaiting())
    );
});

// --------------------
// Activate Event
// --------------------
self.addEventListener('activate', (event) => {
    const allowedCaches = [STATIC_CACHE, DYNAMIC_CACHE];
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.filter((key) => !allowedCaches.includes(key))
                    .map((key) => caches.delete(key))
            );
        }).then(() => self.clients.claim())
    );
});

// --------------------
// Fetch Event
// --------------------
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Only handle same-origin requests
    if (url.origin !== location.origin) return;

    // Skip non-GET and Livewire/CSRF AJAX requests
    if (request.method !== 'GET') return;
    if (request.headers.get('X-Livewire') === 'true') return;

    // Cache-First for static assets (CSS, JS, fonts, images, icons)
    if (isStaticAsset(url.pathname)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Network-First for navigation (HTML) with offline fallback
    if (request.mode === 'navigate') {
        event.respondWith(networkFirstWithOfflineFallback(request));
        return;
    }
});

// --------------------
// Helpers
// --------------------

function isStaticAsset(pathname) {
    return (
        pathname.startsWith('/build/') ||
        pathname.startsWith('/icons/') ||
        pathname.startsWith('/fonts/') ||
        /\.(css|js|woff2?|ttf|eot|png|jpg|jpeg|gif|svg|ico|webp)$/i.test(pathname)
    );
}

async function cacheFirst(request) {
    const cached = await caches.match(request);
    if (cached) return cached;

    try {
        const response = await fetch(request);
        if (response && response.status === 200) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, response.clone());
        }
        return response;
    } catch {
        return new Response('Resource not available offline.', {
            status: 503,
            headers: { 'Content-Type': 'text/plain' },
        });
    }
}

async function networkFirstWithOfflineFallback(request) {
    try {
        const response = await fetch(request);
        if (response && response.status === 200) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, response.clone());
        }
        return response;
    } catch {
        const cached = await caches.match(request);
        if (cached) return cached;

        // Return the offline fallback page
        const offlinePage = await caches.match(OFFLINE_URL);
        return offlinePage || new Response('You are offline.', {
            status: 503,
            headers: { 'Content-Type': 'text/plain' },
        });
    }
}
