<!-- Header / Navbar -->
<header class="sticky top-0 z-50 glass border-b border-dark-800/50" x-data="{ mobileMenu: false, searchOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center shadow-lg shadow-primary-600/30 group-hover:shadow-primary-600/50 transition-all">
                    <span class="text-white font-extrabold text-lg">M</span>
                </div>
                <span class="text-xl font-extrabold tracking-tight">
                    <span class="gradient-text">Manga</span><span class="text-white">Cuy</span>
                </span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium flex items-center gap-1.5 rounded-lg hover:bg-dark-800 hover:text-primary-400 transition {{ request()->routeIs('home') ? 'text-primary-400 bg-dark-800/50' : 'text-gray-300' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Home
                </a>
                <div class="relative group" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                    <button class="px-4 py-2 text-sm font-medium rounded-lg hover:bg-dark-800 hover:text-primary-400 transition text-gray-300 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Komik
                        <svg class="w-3.5 h-3.5 transition" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute top-full left-0 mt-1 w-48 glass rounded-xl shadow-2xl py-2 border border-dark-700" style="display:none">
                        <a href="{{ route('comics.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 hover:text-primary-400 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg> Semua Komik</a>
                        <a href="{{ route('comics.popular') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 hover:text-primary-400 transition"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 7 9a11.05 11.05 0 00-3 4.5 8.001 8.001 0 0012.657 6.814z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Terpopuler</a>
                        <a href="{{ route('comics.latest') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 hover:text-primary-400 transition"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Update Terbaru</a>
                        <a href="{{ route('comics.new') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 hover:text-primary-400 transition"><svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg> Rilis Baru</a>
                    </div>
                </div>
                <a href="{{ route('genres.index') }}" class="px-4 py-2 text-sm font-medium flex items-center gap-1.5 rounded-lg hover:bg-dark-800 hover:text-primary-400 transition {{ request()->routeIs('genres.*') ? 'text-primary-400 bg-dark-800/50' : 'text-gray-300' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Genre
                </a>
            </nav>

            <!-- Desktop Right -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Search -->
                <div class="relative" @click.away="searchOpen = false">
                    <div class="relative">
                        <input type="text" placeholder="Cari komik..."
                               class="w-64 bg-dark-800/80 border border-dark-700 rounded-xl px-4 py-2.5 pl-10 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 transition placeholder-gray-500"
                               @focus="searchOpen = true"
                               @input="handleSearch($event.target.value)"
                               @keydown.enter="window.location.href='/search?q='+$event.target.value">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <div id="search-results" class="hidden absolute top-full mt-2 w-full glass rounded-xl shadow-2xl max-h-80 overflow-y-auto border border-dark-700"></div>
                </div>

                @auth
                    <a href="{{ route('user.bookmarks') }}" class="p-2.5 hover:bg-dark-800 rounded-lg transition text-gray-400 hover:text-primary-400 relative" title="Bookmark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 p-1.5 hover:bg-dark-800 rounded-lg transition">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center text-sm font-bold text-white">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 glass rounded-xl shadow-2xl py-2 border border-dark-700" style="display:none">
                            <div class="px-4 py-2 border-b border-dark-700">
                                <div class="text-sm font-bold text-white">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            <a href="{{ route('user.bookmarks') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg> Bookmark Saya</a>
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-dark-800 transition text-primary-400 font-bold border-t border-dark-700/50 mt-1 pt-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Dashboard Admin</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 text-left px-4 py-2.5 text-sm hover:bg-dark-800 text-red-400 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg> Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-600/30">
                        Masuk
                    </a>
                @endauth
            </div>

            <!-- Mobile Burger -->
            <div class="flex lg:hidden items-center gap-2">
                <a href="{{ route('search') }}" class="p-2 hover:bg-dark-800 rounded-lg transition text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </a>
                <button @click="mobileMenu = !mobileMenu" class="p-2 hover:bg-dark-800 rounded-lg transition text-gray-400">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden glass border-t border-dark-800" style="display:none">
        <div class="container mx-auto px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Home</a>
            <a href="{{ route('comics.index') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg> Semua Komik</a>
            <a href="{{ route('comics.popular') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 7 9a11.05 11.05 0 00-3 4.5 8.001 8.001 0 0012.657 6.814z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Terpopuler</a>
            <a href="{{ route('comics.latest') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Update Terbaru</a>
            <a href="{{ route('genres.index') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg> Genre</a>
            @auth
                <a href="{{ route('user.bookmarks') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg> Bookmark Saya</a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-bold text-primary-400 border border-dark-700/50 mt-1 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Dashboard Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 text-left px-4 py-3 rounded-lg hover:bg-dark-800 text-sm font-medium text-red-400 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg> Logout</button>
                </form>
            @else
                <div class="pt-2 flex gap-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-3 bg-primary-600 hover:bg-primary-700 rounded-xl text-sm font-bold transition">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-3 bg-dark-800 hover:bg-dark-700 rounded-xl text-sm font-bold transition border border-dark-700">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</header>
