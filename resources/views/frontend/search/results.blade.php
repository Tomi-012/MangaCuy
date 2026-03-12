@extends('layouts.frontend')

@section('title', 'Cari Komik: ' . $query . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Search Form -->
    <div class="max-w-2xl mx-auto mb-10">
        <h1 class="text-2xl md:text-3xl font-extrabold text-center mb-6 flex items-center justify-center gap-3">
            <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Komik
        </h1>
        <form action="{{ route('search') }}" method="GET" class="relative">
            <input type="text" name="q" value="{{ $query }}" placeholder="Ketik judul komik, author, atau artist..."
                   class="w-full bg-dark-800 border border-dark-700 rounded-2xl px-6 py-4 pl-12 text-base focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition shadow-lg" autofocus>
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 px-6 py-2 bg-primary-600 hover:bg-primary-700 rounded-xl font-bold text-sm transition">Cari</button>
        </form>
    </div>

    <!-- Results -->
    @if($query)
    <p class="text-sm text-gray-500 mb-6">
        @if($comics instanceof \Illuminate\Pagination\LengthAwarePaginator)
            Ditemukan <span class="text-white font-bold">{{ $comics->total() }}</span> hasil untuk "<span class="text-primary-400">{{ $query }}</span>"
        @else
            Menampilkan hasil untuk "<span class="text-primary-400">{{ $query }}</span>"
        @endif
    </p>
    @endif

    @if($comics instanceof \Illuminate\Support\Collection ? $comics->count() > 0 : ($comics instanceof \Illuminate\Pagination\LengthAwarePaginator ? $comics->count() > 0 : false))
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($comics as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>

    @if($comics instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-10 flex justify-center">
        {{ $comics->withQueryString()->links('partials.pagination') }}
    </div>
    @endif
    @elseif($query)
    <div class="text-center py-20">
        <div class="text-gray-400 mb-4 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-400">Tidak ada hasil</h3>
        <p class="text-sm text-gray-600 mt-2">Coba gunakan kata kunci lain</p>
    </div>
    @endif
</div>
@endsection
