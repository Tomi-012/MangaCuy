@extends('layouts.frontend')

@section('title', 'Daftar Genre - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl md:text-3xl font-extrabold mb-8 flex items-center gap-3">
        <span class="w-10 h-10 bg-purple-500/20 text-purple-500 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </span>
        Daftar Genre
    </h1>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
        @foreach($genres as $genre)
        <a href="{{ route('genre.show', $genre->slug) }}"
           class="group bg-dark-900/50 border border-dark-800 rounded-xl p-4 hover:bg-primary-600/10 hover:border-primary-500/40 transition-all text-center">
            <div class="text-lg font-bold group-hover:text-primary-400 transition">{{ $genre->name }}</div>
            <div class="text-xs text-gray-600 mt-1">{{ $genre->comics_count }} Komik</div>
        </a>
        @endforeach
    </div>
</div>
@endsection
