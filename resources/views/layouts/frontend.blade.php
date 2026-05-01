<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Baca Komik Manhwa, Manga, Manhua Terbaru - ' . config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Baca komik manhwa, manga, manhua, dan doujin terbaru dan terlengkap bahasa Indonesia gratis di MangaCuy')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'Baca komik online terbaru')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og-default.jpg'))">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="theme-front bg-background text-foreground font-sans antialiased min-h-screen">

    @include('partials.header')

    <main class="min-h-screen relative z-10 animate-page-enter">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- App JS -->
    <script>
        // CSRF Token Setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Live Search
        let searchTimeout;
        function handleSearch(query) {
            clearTimeout(searchTimeout);
            const results = document.getElementById('search-results');
            if (query.length < 2) { results.classList.add('hidden'); return; }
            searchTimeout = setTimeout(async () => {
                try {
                    const resp = await fetch(`/api/search/suggest?q=${encodeURIComponent(query)}`);
                    const data = await resp.json();
                    if (data.length > 0) {
                        results.innerHTML = data.map(c =>
                            `<a href="${c.url}" class="flex items-center gap-3 p-3 hover:bg-dark-800 transition rounded-lg">
                                <img src="${c.cover}" class="w-10 h-14 object-cover rounded" alt="${c.title}">
                                <div>
                                    <div class="font-medium text-sm text-white">${c.title}</div>
                                    <div class="text-xs text-primary-400">${c.type}</div>
                                </div>
                            </a>`
                        ).join('');
                        results.classList.remove('hidden');
                    } else {
                        results.innerHTML = '<div class="p-4 text-center text-gray-500 text-sm">Tidak ditemukan</div>';
                        results.classList.remove('hidden');
                    }
                } catch(e) { console.error(e); }
            }, 300);
        }

        // Bookmark Toggle
        async function toggleBookmark(comicId, btn) {
            try {
                const resp = await fetch(`/bookmarks/${comicId}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With':'XMLHttpRequest' }
                });
                const data = await resp.json();
                if (data.status) {
                    btn.innerHTML = '❤️ Bookmarked';
                    btn.classList.add('bg-primary-600');
                } else {
                    btn.innerHTML = '🤍 Bookmark';
                    btn.classList.remove('bg-primary-600');
                }
            } catch(e) { window.location.href = '/login'; }
        }

        // Back to top
        window.addEventListener('scroll', () => {
            const btn = document.getElementById('back-to-top');
            if (btn) btn.classList.toggle('hidden', window.scrollY < 300);
        });
    </script>

    <!-- Back to Top Button -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"
            class="hidden fixed bottom-6 right-6 z-50 w-12 h-12 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg shadow-primary-600/30 flex items-center justify-center transition-all hover:scale-110">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>

    @stack('scripts')
</body>
</html>
