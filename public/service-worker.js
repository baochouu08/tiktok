const CACHE_NAME = 'greenvideo-v1';
const URLS_TO_CACHE = [
  '/',
  '/assets/css/style.min.css',
  '/assets/js/app.min.js',
  '/assets/images/og-image.svg',
  '/manifest.json'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(URLS_TO_CACHE))
  );
  self.skipWaiting();
});

self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;
  
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request).then(res => {
        if (res.status === 200 && res.type !== 'basic') {
          const cache = caches.open(CACHE_NAME);
          cache.then(c => c.put(event.request, res.clone()));
        }
        return res;
      }).catch(() => caches.match('/'));
    })
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(names => 
      Promise.all(names.map(name => name !== CACHE_NAME && caches.delete(name)))
    )
  );
});
