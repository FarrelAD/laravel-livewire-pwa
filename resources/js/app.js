// Service Worker registration for PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('/sw.js', { scope: '/' })
            .then((registration) => {
                console.log('[PWA] Service worker registered:', registration.scope);

                // Check for updates when the tab regains focus
                document.addEventListener('visibilitychange', () => {
                    if (document.visibilityState === 'visible') {
                        registration.update();
                    }
                });
            })
            .catch((error) => {
                console.error('[PWA] Service worker registration failed:', error);
            });
    });
}
