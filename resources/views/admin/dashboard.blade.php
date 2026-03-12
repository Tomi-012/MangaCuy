@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="bg-dark-900/50 border border-dark-800 p-6 rounded-2xl flex items-center gap-4 hover:border-primary-500/50 transition relative overflow-hidden group">
        <div class="w-14 h-14 bg-primary-500/10 text-primary-500 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Komik</p>
            <p class="text-3xl font-extrabold">{{ number_format($stats['total_comics']) }}</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition text-primary-500">
            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
    </div>
    <!-- Stat 2 -->
    <div class="bg-dark-900/50 border border-dark-800 p-6 rounded-2xl flex items-center gap-4 hover:border-green-500/50 transition relative overflow-hidden group">
        <div class="w-14 h-14 bg-green-500/10 text-green-500 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Chapter</p>
            <p class="text-3xl font-extrabold">{{ number_format($stats['total_chapters']) }}</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition text-green-500">
            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
    </div>
    <!-- Stat 3 -->
    <div class="bg-dark-900/50 border border-dark-800 p-6 rounded-2xl flex items-center gap-4 hover:border-purple-500/50 transition relative overflow-hidden group">
        <div class="w-14 h-14 bg-purple-500/10 text-purple-400 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Pengguna</p>
            <p class="text-3xl font-extrabold">{{ number_format($stats['total_users']) }}</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition text-purple-500">
            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>
    <!-- Stat 4 -->
    <div class="bg-dark-900/50 border border-dark-800 p-6 rounded-2xl flex items-center gap-4 hover:border-orange-500/50 transition relative overflow-hidden group">
        <div class="w-14 h-14 bg-orange-500/10 text-orange-500 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Genre Tersedia</p>
            <p class="text-3xl font-extrabold">{{ number_format($stats['total_genres']) }}</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition text-orange-500">
            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Preview Komik -->
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Komik Ditambahkan Terbaru</h3>
            <a href="#" class="text-sm text-primary-400 hover:text-primary-300">Lihat Semua</a>
        </div>
        <div class="divide-y divide-dark-800">
            @foreach($latest_comics as $comic)
            <div class="p-4 flex items-center gap-4 hover:bg-dark-800/40 transition">
                <img src="{{ $comic->cover_url }}" alt="" class="w-12 h-16 object-cover rounded-md">
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-sm truncate">{{ $comic->title }}</h4>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded" style="background: {{ $comic->type->color ?? '#000' }}20; color: {{ $comic->type->color ?? '#000' }}">{{ $comic->type->name ?? 'Unknown' }}</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded" style="background: {{ $comic->status->color ?? '#000' }}20; color: {{ $comic->status->color ?? '#000' }}">{{ $comic->status->name ?? 'Unknown' }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-500">{{ $comic->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Preview Chapter -->
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Chapter Terbaru Diupload</h3>
            <a href="#" class="text-sm text-primary-400 hover:text-primary-300">Lihat Semua</a>
        </div>
        <div class="divide-y divide-dark-800">
            @foreach($latest_chapters as $chapter)
            <div class="p-4 flex items-center gap-4 hover:bg-dark-800/40 transition">
                <div class="w-10 h-10 rounded-lg bg-dark-800 flex items-center justify-center text-gray-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm text-gray-400 truncate">{{ $chapter->comic->title ?? 'Unknown Comic' }}</div>
                    <h4 class="font-bold text-sm">Chapter {{ (int)$chapter->chapter_number }}</h4>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-500">{{ $chapter->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
