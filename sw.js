var cacheName = 'saiaCache';
var filesToCache = [
    'views/dashboard/dashboard.php',
    'assets/theme/assets/plugins/jquery/jquery-3.2.1.min.js',
    'assets/theme/assets/plugins/popper/umd/popper.min.js',
    'assets/theme/assets/plugins/bootstrap/css/bootstrap.min.css',
    'assets/theme/assets/plugins/bootstrap/js/bootstrap.min.js',
    'assets/theme/assets/plugins/modernizr.custom.js',
    'assets/theme/pages/js/pages.min.js',
    'assets/theme/pages/css/pages.min.css',
    'assets/theme/assets/plugins/moment/moment-with-locales.min.js',
    'assets/theme/assets/plugins/moment/moment.min.js',
    'assets/theme/assets/plugins/font-awesome/css/font-awesome.css',
    'assets/theme/assets/js/cerok_libraries/breakpoint/if-b4-breakpoint.js',
    'assets/theme/assets/js/cerok_libraries/session/session.js',
    'assets/theme/assets/js/cerok_libraries/notifications/topNotification.js',
    'assets/theme/assets/js/cerok_libraries/ui/ui.js',
    'assets/theme/assets/plugins/iziToast/js/iziToast.min.js',
    'assets/theme/assets/js/cerok_libraries/session/global_ajax_validations.js'
];

self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open(cacheName).then(function(cache) {
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', function(e) {
    e.waitUntil(
        caches.keys().then(function(keyList) {
            return Promise.all(
                keyList.map(function(key) {
                    if (key !== cacheName) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    return self.clients.claim();
});

self.addEventListener('fetch', function(e) {
    e.respondWith(
        caches.match(e.request).then(function(response) {
            return response || fetch(e.request);
        })
    );
});
