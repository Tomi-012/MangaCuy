@extends('layouts.frontend')

@section('title', $comic->meta_title ?? $comic->title . ' - ' . config('app.name'))
@section('meta_description', $comic->meta_description ?? Str::limit($comic->synopsis, 160))

@section('content')

<!-- Comic Banner -->
<div class="relative">
    <div class="h-[200px] md:h-[300px] overflow-hidden">
        <img src="{{ $comic->banner_image ? asset('storage/'.$comic->banner_image) : $comic->cover_url }}"
             class="w-full h-full object-cover blur-sm scale-110 opacity-40" alt="{{ $comic->title }}">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/80 to-dark-950/30"></div>
</div>

<!-- Comic Detail -->
<div class="page-container -mt-32 relative z-10">
    <div class="flex flex-col md:flex-row gap-6 md:gap-8">
        <!-- Cover Image -->
        <div class="flex-shrink-0 mx-auto md:mx-0">
            <img src="{{ $comic->cover_url }}" alt="{{ $comic->title }}"
                 class="w-48 md:w-56 h-auto rounded-2xl shadow-2xl shadow-dark-950/50 border-2 border-dark-700/50">
        </div>

        <!-- Comic Info -->
        <div class="flex-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2 mb-2">
                <span class="px-3 py-1 text-xs font-bold rounded-lg" style="background: {{ $comic->type->color ?? '#6366f1' }}; color: white;">
                    {{ $comic->type->name ?? '' }}
                </span>
                <span class="px-3 py-1 text-xs font-bold rounded-lg" style="background: {{ $comic->status->color ?? '#10b981' }}; color: white;">
                    {{ $comic->status->name ?? '' }}
                </span>
            </div>

            <h1 class="text-2xl md:text-3xl lg:text-4xl font-black leading-tight mb-1">{{ $comic->title }}</h1>
            @if($comic->alternative_title)
            <p class="text-sm text-gray-500 mb-4">{{ $comic->alternative_title }}</p>
            @endif

            <!-- Rating & Stats -->
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <div class="flex items-center gap-1.5">
                    <div class="flex text-yellow-500">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= round($comic->ratings_avg_rating / 2) ? 'text-yellow-400' : 'text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span class="text-sm font-bold text-yellow-400">{{ number_format($comic->ratings_avg_rating ?? $comic->rating, 1) }}</span>
                    <span class="text-xs text-gray-500">({{ $comic->ratings_count ?? 0 }})</span>
                </div>
                <span class="text-sm text-gray-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> {{ $comic->formatted_views }} views</span>
                <span class="text-sm text-gray-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> {{ $comic->chapters->count() }} chapters</span>
                <span class="text-sm text-gray-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg> {{ $comic->bookmarks_count ?? 0 }} bookmark</span>
            </div>

            <!-- Meta Info -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4 text-sm">
                @if($comic->author)
                <div class="bg-dark-900/50 rounded-2xl p-3 border border-white/5">
                    <span class="text-gray-500 text-xs block">Author</span>
                    <span class="font-semibold">{{ $comic->author }}</span>
                </div>
                @endif
                @if($comic->artist)
                <div class="bg-dark-900/50 rounded-2xl p-3 border border-white/5">
                    <span class="text-gray-500 text-xs block">Artist</span>
                    <span class="font-semibold">{{ $comic->artist }}</span>
                </div>
                @endif
                @if($comic->released_year)
                <div class="bg-dark-900/50 rounded-2xl p-3 border border-white/5">
                    <span class="text-gray-500 text-xs block">Released</span>
                    <span class="font-semibold">{{ $comic->released_year }}</span>
                </div>
                @endif
            </div>

            <!-- Genre Tags -->
            <div class="flex flex-wrap gap-2 mb-5">
                @foreach($comic->genres as $genre)
                <a href="{{ route('genre.show', $genre->slug) }}"
                   class="chip bg-white/5 hover:bg-primary-600/20 hover:border-primary-500/40 hover:text-primary-400 transition">
                    {{ $genre->name }}
                </a>
                @endforeach
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                @if($firstChapter)
                <a href="{{ route('chapter.read', [$comic->slug, $firstChapter->slug]) }}"
                   class="btn btn-lg btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Baca Ch. 1
                </a>
                @endif

                @if($lastChapter && $lastChapter->id !== ($firstChapter->id ?? null))
                <a href="{{ route('chapter.read', [$comic->slug, $lastChapter->slug]) }}"
                   class="btn btn-lg btn-outline bg-white/5 text-white">
                    Chapter Terbaru
                </a>
                @endif

                @auth
                <button onclick="toggleBookmark({{ $comic->id }}, this)"
                        class="btn btn-lg {{ $isBookmarked ? 'btn-primary' : 'btn-outline bg-white/5 text-gray-200' }}">
                    @if($isBookmarked)
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H15a3 3 0 110 6h-1v5a1 1 0 11-2 0v-5H8v5a1 1 0 11-2 0v-5H5a3 3 0 110-6h.17A3 3 0 015 5zm3.5 0a1.5 1.5 0 013 0v1h-3V5z" clip-rule="evenodd"/></svg> Bookmarked
                    @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg> Bookmark
                    @endif
                </button>
                @endauth
            </div>
        </div>
    </div>

    <!-- Synopsis -->
    <div class="mt-8" x-data="{ expanded: false }">
        <h2 class="text-lg font-bold mb-3">Sinopsis</h2>
        <div class="bg-dark-900/50 border border-white/5 rounded-2xl p-5">
            <p class="text-sm text-gray-400 leading-relaxed" :class="{ 'line-clamp-3': !expanded }">
                {{ $comic->synopsis ?? 'Belum ada sinopsis.' }}
            </p>
            @if(strlen($comic->synopsis ?? '') > 200)
            <button @click="expanded = !expanded" class="flex items-center gap-1 text-primary-400 text-sm mt-2 hover:text-primary-300 transition">
                <span x-text="expanded ? 'Tutup' : 'Baca Selengkapnya'"></span>
                <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            @endif
        </div>
    </div>

    <!-- Chapter List -->
    <div class="mt-8" x-data="{ sort: 'desc' }">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg> Daftar Chapter ({{ $comic->chapters->count() }})
            </h2>
            <div class="flex items-center gap-2">
                <button @click="sort = 'desc'" :class="sort === 'desc' ? 'btn-primary' : 'btn-outline bg-white/5 text-gray-300'"
                        class="btn btn-sm">Terbaru</button>
                <button @click="sort = 'asc'" :class="sort === 'asc' ? 'btn-primary' : 'btn-outline bg-white/5 text-gray-300'"
                        class="btn btn-sm">Terlama</button>
            </div>
        </div>

        <div class="bg-dark-900/50 border border-white/5 rounded-2xl overflow-hidden max-h-[500px] overflow-y-auto">
            @forelse($comic->chapters as $chapter)
            <a href="{{ route('chapter.read', [$comic->slug, $chapter->slug]) }}"
               class="flex items-center justify-between px-5 py-3.5 hover:bg-white/5 transition border-b border-white/5 group"
               :style="sort === 'asc' ? 'order: {{ $comic->chapters->count() - $loop->index }}' : ''">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-sm group-hover:text-primary-400 transition">Chapter {{ (int)$chapter->chapter_number }}</span>
                    @if($chapter->title)
                    <span class="text-sm text-gray-500 hidden md:inline">- {{ Str::limit($chapter->title, 40) }}</span>
                    @endif
                    @if($chapter->published_at && $chapter->published_at->diffInHours(now()) < 48)
                    <span class="px-2 py-0.5 bg-emerald-500/20 text-emerald-400 text-[10px] font-bold rounded-md badge-new">NEW</span>
                @endif
            </div>
            <span class="text-xs text-gray-600 flex-shrink-0 ml-4">{{ $chapter->published_at ? $chapter->published_at->diffForHumans() : '' }}</span>
        </a>
            @empty
            <div class="p-8 text-center text-gray-500">
                <p>Belum ada chapter tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Related Comics -->
    @if($relatedComics->count() > 0)
    <section class="mt-12">
        <h2 class="text-xl font-extrabold mb-6 flex items-center gap-2">
            <span>Komik <span class="gradient-text">Serupa</span></span>
        </h2>
        <div class="comic-grid stagger-grid">
            @foreach($relatedComics as $comic)
                @include('partials.comic.card', ['comic' => $comic])
            @endforeach
        </div>
    </section>
    @endif
</div>

@endsection
