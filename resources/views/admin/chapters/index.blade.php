@extends('layouts.admin')

@section('title', 'Data Chapter')

@section('content')
<div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
        <h3 class="font-bold text-lg">Daftar Chapter</h3>
        <a href="{{ route('admin.chapters.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-bold rounded-lg transition">Tambah Chapter</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark-800/50 text-gray-400 text-sm border-b border-dark-700">
                    <th class="py-3 px-4 font-semibold">Komik</th>
                    <th class="py-3 px-4 font-semibold">Chapter No.</th>
                    <th class="py-3 px-4 font-semibold">Judul Chapter</th>
                    <th class="py-3 px-4 font-semibold">Views</th>
                    <th class="py-3 px-4 font-semibold">Tanggal</th>
                    <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800 text-sm">
                @forelse($chapters as $chapter)
                <tr class="hover:bg-dark-800/40 transition">
                    <td class="py-3 px-4">
                        <a href="{{ route('comic.show', $chapter->comic->slug) }}" class="font-bold text-primary-400 hover:text-primary-300" target="_blank">{{ $chapter->comic->title }}</a>
                    </td>
                    <td class="py-3 px-4 font-bold">Chapter {{ (int)$chapter->chapter_number }}</td>
                    <td class="py-3 px-4 text-gray-400">{{ $chapter->title ?? '-' }}</td>
                    <td class="py-3 px-4 text-gray-400">{{ number_format($chapter->views) }}</td>
                    <td class="py-3 px-4 text-gray-400">{{ $chapter->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.chapters.edit', $chapter) }}" class="p-1.5 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded transition">Edit</a>
                            <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST" onsubmit="return confirm('Hapus chapter ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-500">Tidak ada data chapter.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-dark-800">
        {{ $chapters->links('partials.pagination') }}
    </div>
</div>
@endsection
