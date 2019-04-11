var cacheName = 'saiaCache';
var filesToCache = [
    'views/dashboard/dashboard.php',
    'assets/theme/assets/plugins/moment/moment-with-locales.min.js',
    'assets/theme/assets/plugins/font-awesome/fonts/fontawesome-webfont.woff2?v=4.7.0',
    'assets/theme/pages/js/pages.min.js',
    'assets/theme/pages/css/pages.css'
];

self.addEventListener('install', function (e) {
    e.waitUntil(
        caches.open(cacheName).then(function (cache) {
            console.log('[ServiceWorker] Caching app shell');
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', function (e) {
    e.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(keyList.map(function (key) {
                if (key !== cacheName) {
                    console.log('[ServiceWorker] Removing old cache', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    return self.clients.claim();
});

self.addEventListener('fetch', function (e) {
    e.respondWith(
        caches.match(e.request).then(function (response) {
            return response || fetch(e.request);
        })
    );
});