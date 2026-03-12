@extends('layouts.frontend')

@section('title', $comic->title . ' - Ch. ' . (int)$chapter->chapter_number . ' - ' . config('app.name'))

@section('content')

<div x-data="{ showHeader: true, showSettings: false, lastScroll: 0 }"
     @scroll.window="showHeader = (window.pageYOffset < lastScroll) || (window.pageYOffset < 100); lastScroll = window.pageYOffset;">

    <!-- Reader Header -->
    <header class="fixed top-0 left-0 right-0 z-50 glass border-b border-dark-800/50 transition-transform duration-300"
            :class="{'-translate-y-full': !showHeader}">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('comic.show', $comic->slug) }}" class="p-2 hover:bg-dark-800 rounded-lg transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div class="min-w-0">
                    <h1 class="font-bold text-sm truncate">{{ $comic->title }}</h1>
                    <p class="text-xs text-gray-500">Ch. {{ (int)$chapter->chapter_number }} {{ $chapter->title ? '- '.$chapter->title : '' }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <!-- Chapter Select -->
                <select onchange="window.location.href=this.value"
                        class="bg-dark-800 border border-dark-700 text-sm rounded-lg px-3 py-2 focus:border-primary-500 focus:outline-none max-w-[180px]">
                    @foreach($allChapters as $ch)
                    <option value="{{ route('chapter.read', [$comic->slug, $ch->slug]) }}" {{ $ch->id == $chapter->id ? 'selected' : '' }}>
                        Ch. {{ (int)$ch->chapter_number }} {{ $ch->title ? '- '.Str::limit($ch->title, 20) : '' }}
                    </option>
                    @endforeach
                </select>

                <!-- Settings -->
                <button @click="showSettings = !showSettings" class="p-2.5 bg-dark-800 hover:bg-dark-700 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Settings Panel -->
    <div x-show="showSettings" @click.away="showSettings = false" x-transition
         class="fixed top-16 right-4 z-50 glass rounded-xl shadow-2xl p-5 w-72 border border-dark-700" style="display:none">
        <h3 class="font-bold mb-4 text-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            Pengaturan Baca
        </h3>
        <div class="space-y-4">
            <div>
                <label class="text-xs text-gray-500 block mb-2">Warna Latar</label>
                <div class="flex gap-2">
                    <button onclick="setBg('dark')" class="w-9 h-9 bg-dark-950 rounded-lg border-2 border-primary-500 hover:scale-110 transition" title="Gelap"></button>
                    <button onclick="setBg('light')" class="w-9 h-9 bg-gray-100 rounded-lg border-2 border-transparent hover:border-primary-500 hover:scale-110 transition" title="Terang"></button>
                    <button onclick="setBg('sepia')" class="w-9 h-9 bg-amber-100 rounded-lg border-2 border-transparent hover:border-primary-500 hover:scale-110 transition" title="Sepia"></button>
                </div>
            </div>
            <div>
                <label class="text-xs text-gray-500 block mb-2">Kecerahan</label>
                <input type="range" min="50" max="150" value="100" id="brightness"
                       class="w-full accent-primary-500" oninput="setBrightness(this.value)">
            </div>
        </div>
    </div>

    <!-- Main Reader -->
    <main id="reader-container" class="pt-16 pb-24 min-h-screen bg-dark-950 transition-colors duration-300">
        <div id="images-container" class="max-w-4xl mx-auto">
            @foreach($chapter->images as $index => $image)
            <div class="image-wrapper" data-index="{{ $index }}">
                <img src="{{ $image->url }}"
                     alt="Page {{ $index + 1 }}"
                     class="w-full h-auto mx-auto select-none"
                     loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                     data-page="{{ $index + 1 }}">
            </div>
            @endforeach

            @if($chapter->images->count() === 0)
            <div class="text-center py-20">
                <div class="text-gray-400 mb-4 flex justify-center">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-400">Belum ada gambar</h3>
                <p class="text-sm text-gray-600 mt-2">Chapter ini belum memiliki gambar</p>
            </div>
            @endif
        </div>

        <!-- Navigation Bottom -->
        <div class="max-w-4xl mx-auto px-4 mt-8">
            <div class="flex items-center justify-between py-6 border-t border-dark-800">
                @if($prevChapter)
                <a href="{{ route('chapter.read', [$comic->slug, $prevChapter->slug]) }}"
                   class="flex items-center gap-2 px-5 py-3 bg-dark-800 hover:bg-dark-700 rounded-xl transition font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Ch. {{ (int)$prevChapter->chapter_number }}
                </a>
                @else
                <div></div>
                @endif

                <a href="{{ route('comic.show', $comic->slug) }}"
                   class="flex items-center gap-2 px-5 py-3 bg-primary-600 hover:bg-primary-700 rounded-xl font-bold text-sm transition-all hover:shadow-lg hover:shadow-primary-600/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Daftar Chapter
                </a>

                @if($nextChapter)
                <a href="{{ route('chapter.read', [$comic->slug, $nextChapter->slug]) }}"
                   class="flex items-center gap-2 px-5 py-3 bg-primary-600 hover:bg-primary-700 rounded-xl transition font-bold text-sm hover:shadow-lg hover:shadow-primary-600/30">
                    Ch. {{ (int)$nextChapter->chapter_number }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @else
                <div></div>
                @endif
            </div>
        </div>
    </main>

    <!-- Mobile Bottom Nav -->
    <div class="fixed bottom-0 left-0 right-0 glass border-t border-dark-800/50 p-3 md:hidden z-50">
        <div class="flex items-center justify-between">
            @if($prevChapter)
            <a href="{{ route('chapter.read', [$comic->slug, $prevChapter->slug]) }}" class="px-4 py-2.5 bg-dark-800 hover:bg-dark-700 rounded-lg transition text-sm font-bold flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Prev
            </a>
            @else
            <div class="px-4 py-2.5 bg-dark-800/30 rounded-lg text-gray-700 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Prev
            </div>
            @endif

            <span class="text-xs text-gray-500 font-medium">Ch. {{ (int)$chapter->chapter_number }}</span>

            @if($nextChapter)
            <a href="{{ route('chapter.read', [$comic->slug, $nextChapter->slug]) }}" class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 rounded-lg transition text-sm font-bold flex items-center gap-1">
                Next <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @else
            <div class="px-4 py-2.5 bg-dark-800/30 rounded-lg text-gray-700 text-sm flex items-center gap-1">
                Next <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setBg(color) {
        const container = document.getElementById('reader-container');
        container.className = container.className.replace(/bg-\S+/g, '');
        const map = { dark: 'bg-dark-950', light: 'bg-gray-100', sepia: 'bg-amber-50' };
        container.classList.add(map[color] || 'bg-dark-950');
        container.classList.add('transition-colors', 'duration-300', 'min-h-screen');
        localStorage.setItem('reader_bg', color);
    }

    function setBrightness(v) {
        document.getElementById('images-container').style.filter = `brightness(${v}%)`;
        localStorage.setItem('reader_brightness', v);
    }

    // Keyboard nav
    document.addEventListener('keydown', e => {
        @if($prevChapter)
        if (e.key === 'ArrowLeft') window.location.href = "{{ route('chapter.read', [$comic->slug, $prevChapter->slug]) }}";
        @endif
        @if($nextChapter)
        if (e.key === 'ArrowRight') window.location.href = "{{ route('chapter.read', [$comic->slug, $nextChapter->slug]) }}";
        @endif
    });

    // Restore settings
    const savedBg = localStorage.getItem('reader_bg');
    if (savedBg) setBg(savedBg);
    const savedBr = localStorage.getItem('reader_brightness');
    if (savedBr) { document.getElementById('brightness').value = savedBr; setBrightness(savedBr); }
</script>
@endpush

@endsection
