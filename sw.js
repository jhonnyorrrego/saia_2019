var cacheName = 'saiaCache';
var filesToCache = [
    'views/dashboard/dashboard.php',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'assets/theme/assets/plugins/modernizr.custom.js',
    'assets/theme/pages/js/pages.min.js',
    'assets/theme/pages/css/pages.min.css',
    'assets/theme/assets/plugins/moment/moment-with-locales.min.js',
    'assets/theme/assets/plugins/moment/moment.min.js',
    'assets/theme/assets/plugins/font-awesome/css/font-awesome.css',
    'assets/theme/assets/plugins/font-awesome/fonts/fontawesome-webfont.woff2?v=4.7.0',
    'assets/theme/assets/js/cerok_libraries/breakpoint/if-b4-breakpoint.js',
    'assets/theme/assets/js/cerok_libraries/session/session.js',
    'assets/theme/assets/js/cerok_libraries/notifications/topNotification.js',
    'assets/theme/assets/js/cerok_libraries/ui/ui.js',
    'node_modules/izitoast/dist/js/iziToast.min.js',
    'node_modules/izitoast/dist/css/iziToast.min.css',
    'assets/theme/assets/js/cerok_libraries/session/global_ajax_validations.js',
    'assets/theme/assets/js/cerok_libraries/autocomplete/autocomplete_events.js',
    'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.min.css',
    'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.min.js',
    'assets/theme/assets/plugins/bootstrap-table/locale/bootstrap-table-es-ES.min.js',
    'assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
    'assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
    'assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js',
    'assets/theme/assets/plugins/select2/js/select2.min.js',
    'assets/theme/assets/plugins/select2/css/select2.min.css',
    'assets/theme/assets/plugins/select2/js/i18n/es.js',
    'assets/theme/assets/js/cerok_libraries/topModal/topModal.js',
    'assets/theme/assets/js/cerok_libraries/notes/note_events.js',
    'node_modules/jquery-ui-dist/jquery-ui.min.js',
    'node_modules/jquery-ui-dist/jquery-ui.min.css',
    'assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css',
    'assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js',
    'assets/theme/assets/plugins/animate.min.css',
    'assets/theme/assets/plugins/jquery-imgareaselect/scripts/jquery.imgareaselect.js',
    'assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css',
    'assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.js',
    'assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.css',
    'node_modules/jquery-validation/dist/jquery.validate.min.js',
    'node_modules/jquery-validation/dist/localization/messages_es.min.js'
];

/// Hay que incluir a easy ---> assets/theme/assets/plugins/jquery/jquery-easy.js

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
