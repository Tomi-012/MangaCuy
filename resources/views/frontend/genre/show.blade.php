@extends('layouts.frontend')

@section('title', 'Genre: ' . $genre->name . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('genres.index') }}" class="text-sm text-gray-500 hover:text-primary-400">Genre</a>
            <span class="text-gray-700">/</span>
            <span class="text-sm text-primary-400 font-medium">{{ $genre->name }}</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-extrabold flex items-center gap-3">
            <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            {{ $genre->name }}
        </h1>
        @if($genre->description)
        <p class="text-sm text-gray-500 mt-2 max-w-2xl">{{ $genre->description }}</p>
        @endif
    </div>

    @if($comics->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($comics as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>

    <div class="mt-10 flex justify-center">
        {{ $comics->links('partials.pagination') }}
    </div>
    @else
    <div class="text-center py-20">
        <div class="text-gray-400 mb-4 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-400">Belum ada komik</h3>
    </div>
    @endif
</div>
@endsection
