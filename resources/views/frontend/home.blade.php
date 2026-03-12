@extends('layouts.frontend')

@section('title', 'Baca Komik Manhwa, Manga, Manhua Terbaru - ' . config('app.name'))

@section('content')

<!-- Hero Slider -->
@if($sliders->count() > 0)
<section class="relative overflow-hidden" x-data="{ current: 0, total: {{ $sliders->count() }} }"
         x-init="setInterval(() => { current = (current + 1) % total }, 5000)">
    <div class="relative h-[280px] md:h-[420px] lg:h-[500px]">
        @foreach($sliders as $index => $slider)
        <div x-show="current === {{ $index }}"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0">
            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-dark-950/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12">
                <div class="container mx-auto">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary-600/80 text-xs font-bold rounded-lg mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 7 9a11.05 11.05 0 00-3 4.5 8.001 8.001 0 0012.657 6.814z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        FEATURED
                    </span>
                    <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-2 text-white leading-tight max-w-2xl">{{ $slider->title }}</h2>
                    @if($slider->subtitle)
                    <p class="text-base md:text-lg text-gray-300 mb-4 max-w-xl">{{ $slider->subtitle }}</p>
                    @endif
                    @if($slider->link)
                    <a href="{{ $slider->link }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-xl transition-all hover:shadow-lg hover:shadow-primary-600/30 hover:scale-105">
                        {{ $slider->button_text }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Slider Controls -->
    <button @click="current = (current - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 glass rounded-full flex items-center justify-center hover:bg-primary-600/50 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="current = (current + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 glass rounded-full flex items-center justify-center hover:bg-primary-600/50 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
        @foreach($sliders as $index => $slider)
        <button @click="current = {{ $index }}"
                :class="current === {{ $index }} ? 'w-8 bg-primary-500' : 'w-3 bg-white/30 hover:bg-white/50'"
                class="h-2.5 rounded-full transition-all duration-300"></button>
        @endforeach
    </div>
</section>
@endif

<!-- Hot Comics -->
@if($hotComics->count() > 0)
<section class="container mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold flex items-center gap-2">
            <span class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center text-red-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 7 9a11.05 11.05 0 00-3 4.5 8.001 8.001 0 0012.657 6.814z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </span>
            <span>Komik <span class="gradient-text">Populer</span></span>
        </h2>
        <a href="{{ route('comics.popular') }}" class="text-sm text-primary-400 hover:text-primary-300 font-medium flex items-center gap-1 transition">
            Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-5">
        @foreach($hotComics as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>
</section>
@endif

<!-- Latest Updates -->
@if($latestUpdates->count() > 0)
<section class="container mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold flex items-center gap-2">
            <span class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center text-green-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </span>
            <span>Update <span class="gradient-text">Terbaru</span></span>
        </h2>
        <a href="{{ route('comics.latest') }}" class="text-sm text-primary-400 hover:text-primary-300 font-medium flex items-center gap-1 transition">
            Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($latestUpdates as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>
</section>
@endif

<!-- New Releases -->
@if($newReleases->count() > 0)
<section class="container mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl md:text-2xl font-extrabold flex items-center gap-2">
            <span class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center text-blue-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </span>
            <span>Rilis <span class="gradient-text">Baru</span></span>
        </h2>
        <a href="{{ route('comics.new') }}" class="text-sm text-primary-400 hover:text-primary-300 font-medium flex items-center gap-1 transition">
            Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($newReleases as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>
</section>
@endif

<!-- Featured Comics -->
@if($featuredComics->count() > 0)
<section class="container mx-auto px-4 py-10">
    <h2 class="text-xl md:text-2xl font-extrabold mb-6 flex items-center gap-2">
        <span class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center text-yellow-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        </span>
        <span>Rekomendasi <span class="gradient-text">Editor</span></span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($featuredComics as $comic)
        <a href="{{ route('comic.show', $comic->slug) }}" class="flex gap-4 bg-dark-900/50 border border-dark-800 rounded-xl p-4 hover:bg-dark-800/70 hover:border-primary-600/30 transition-all group shine">
            <img src="{{ $comic->cover_url }}" alt="{{ $comic->title }}" class="w-24 h-36 object-cover rounded-lg flex-shrink-0 group-hover:shadow-lg group-hover:shadow-primary-600/20 transition">
            <div class="flex flex-col justify-between flex-1 min-w-0">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded" style="background: {{ $comic->type->color ?? '#6366f1' }}20; color: {{ $comic->type->color ?? '#6366f1' }}">{{ $comic->type->name ?? '' }}</span>
                    <h3 class="font-bold text-base mt-1.5 line-clamp-2">{{ $comic->title }}</h3>
                    <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ Str::limit($comic->synopsis, 90) }}</p>
                </div>
                <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                    <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> {{ number_format($comic->rating, 1) }}</span>
                    <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 truncate" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> {{ $comic->formatted_views }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

<!-- Genre Cloud -->
@if($genres->count() > 0)
<section class="container mx-auto px-4 py-10">
    <h2 class="text-xl md:text-2xl font-extrabold mb-6 flex items-center gap-2">
        <span class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center text-purple-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </span>
        <span>Jelajahi <span class="gradient-text">Genre</span></span>
    </h2>
    <div class="flex flex-wrap gap-2">
        @foreach($genres as $genre)
        <a href="{{ route('genre.show', $genre->slug) }}"
           class="px-4 py-2 bg-dark-800/60 border border-dark-700 rounded-xl text-sm hover:bg-primary-600/20 hover:border-primary-500/40 hover:text-primary-400 transition-all">
            {{ $genre->name }}
            <span class="text-xs text-gray-600 ml-1">({{ $genre->comics_count }})</span>
        </a>
        @endforeach
    </div>
</section>
@endif

@endsection
