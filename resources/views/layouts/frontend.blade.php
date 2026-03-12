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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81' },
                        dark: { 50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',300:'#cbd5e1',400:'#94a3b8',500:'#64748b',600:'#475569',700:'#334155',800:'#1e293b',900:'#0f172a',950:'#020617' },
                        accent: { DEFAULT:'#f59e0b', light:'#fbbf24', dark:'#d97706' },
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #6366f1; }

        .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .comic-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .comic-card:hover { transform: translateY(-6px); }
        .comic-card:hover .comic-cover { transform: scale(1.08); }
        .comic-cover { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }

        .glass { background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(99, 102, 241, 0.15); }

        .gradient-text { background: linear-gradient(135deg, #818cf8, #6366f1, #4f46e5); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        .shine { position: relative; overflow: hidden; }
        .shine::after { content:''; position:absolute; top:-50%; left:-50%; width:200%; height:200%; background:linear-gradient(to right, transparent 0%, rgba(255,255,255,0.05) 50%, transparent 100%); transform: rotate(30deg); animation: shine 4s infinite; }
        @keyframes shine { 0%{left:-100%} 100%{left:100%} }

        .badge-new { animation: badge-pulse 2s infinite; }
        @keyframes badge-pulse { 0%,100%{opacity:1} 50%{opacity:0.7} }

        .search-overlay { transition: all 0.3s ease; }

        @media (max-width: 640px) {
            .mobile-scroll { display: flex; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scrollbar-width: none; gap: 12px; padding-bottom: 8px; }
            .mobile-scroll::-webkit-scrollbar { display: none; }
            .mobile-scroll > * { scroll-snap-align: start; flex: 0 0 140px; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-dark-950 text-gray-100 font-sans antialiased min-h-screen">

    @include('partials.header')

    <main class="min-h-screen">
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
