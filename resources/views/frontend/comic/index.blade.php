@extends('layouts.frontend')

@section('title', ($pageTitle ?? 'Daftar Komik') . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold flex items-center gap-3">
            <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            {{ $pageTitle ?? 'Daftar Komik' }}
        </h1>

        <!-- Sort & Filter -->
        <div class="flex flex-wrap gap-2">
            <div class="relative">
                <select onchange="updateFilter('sort', this.value)" class="appearance-none bg-dark-800 border border-dark-700 rounded-xl px-4 py-2.5 pr-10 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z-A</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            <div class="relative">
                <select onchange="updateFilter('type', this.value)" class="appearance-none bg-dark-800 border border-dark-700 rounded-xl px-4 py-2.5 pr-10 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50">
                    <option value="">Semua Type</option>
                    @foreach($types as $type)
                    <option value="{{ $type->slug }}" {{ request('type') == $type->slug ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            <div class="relative">
                <select onchange="updateFilter('status', this.value)" class="appearance-none bg-dark-800 border border-dark-700 rounded-xl px-4 py-2.5 pr-10 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                    <option value="{{ $status->slug }}" {{ request('status') == $status->slug ? 'selected' : '' }}>{{ $status->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Genre Filter -->
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('comics.index', request()->except('genre')) }}"
           class="px-3 py-1.5 rounded-lg text-xs font-medium transition {{ !request('genre') ? 'bg-primary-600 text-white' : 'bg-dark-800 border border-dark-700 text-gray-400 hover:bg-dark-700' }}">
            Semua
        </a>
        @foreach($genres as $genre)
        <a href="{{ route('comics.index', array_merge(request()->all(), ['genre' => $genre->slug])) }}"
           class="px-3 py-1.5 rounded-lg text-xs font-medium transition {{ request('genre') == $genre->slug ? 'bg-primary-600 text-white' : 'bg-dark-800 border border-dark-700 text-gray-400 hover:bg-dark-700' }}">
            {{ $genre->name }}
        </a>
        @endforeach
    </div>

    <!-- Comics Grid -->
    @if($comics->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
        @foreach($comics as $comic)
            @include('partials.comic.card', ['comic' => $comic])
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
        {{ $comics->withQueryString()->links('partials.pagination') }}
    </div>
    @else
    <div class="text-center py-20">
        <div class="text-gray-400 mb-4 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-400">Tidak ada komik ditemukan</h3>
        <p class="text-sm text-gray-600 mt-2">Coba ubah filter atau kata kunci pencarian</p>
    </div>
    @endif
</div>

@push('scripts')
<script>
function updateFilter(key, value) {
    const url = new URL(window.location.href);
    if (value) { url.searchParams.set(key, value); } else { url.searchParams.delete(key); }
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>
@endpush
@endsection
