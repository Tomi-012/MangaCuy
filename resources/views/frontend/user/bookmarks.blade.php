@extends('layouts.frontend')

@section('title', 'Bookmark Saya - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl md:text-3xl font-extrabold mb-8 flex items-center gap-3">
        <span class="w-10 h-10 bg-red-500/20 text-red-500 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
        </span>
        Bookmark Saya
    </h1>

    @if($bookmarks->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($bookmarks as $bookmark)
            @include('partials.comic.card', ['comic' => $bookmark->comic])
        @endforeach
    </div>

    <div class="mt-10 flex justify-center">
        {{ $bookmarks->links('partials.pagination') }}
    </div>
    @else
    <div class="text-center py-20">
        <div class="text-gray-400 mb-4 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-400">Belum ada bookmark</h3>
        <p class="text-sm text-gray-600 mt-2">Tambahkan komik favorit kamu ke bookmark!</p>
        <a href="{{ route('comics.index') }}" class="inline-block mt-6 px-6 py-3 bg-primary-600 hover:bg-primary-700 rounded-xl font-bold text-sm transition">Jelajahi Komik</a>
    </div>
    @endif
</div>
@endsection
