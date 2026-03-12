@extends('layouts.admin')

@section('title', 'Data Komik')

@section('content')
<div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
        <h3 class="font-bold text-lg">Daftar Komik</h3>
        <a href="{{ route('admin.comics.create') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-bold rounded-lg transition">Tambah Komik</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark-800/50 text-gray-400 text-sm border-b border-dark-700">
                    <th class="py-3 px-4 font-semibold">Tittle</th>
                    <th class="py-3 px-4 font-semibold">Type</th>
                    <th class="py-3 px-4 font-semibold">Status</th>
                    <th class="py-3 px-4 font-semibold text-center">Rating</th>
                    <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800 text-sm">
                @forelse($comics as $comic)
                <tr class="hover:bg-dark-800/40 transition">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $comic->cover_url }}" alt="" class="w-10 h-10 object-cover rounded shadow">
                            <div>
                                <div class="font-bold">{{ $comic->title }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($comic->alternative_title ?? 'No alternate title', 30) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 bg-dark-700 text-xs rounded-md" style="color: {{ $comic->type->color ?? '#fff' }}">{{ $comic->type->name ?? '-' }}</span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 bg-dark-700 text-xs rounded-md" style="color: {{ $comic->status->color ?? '#fff' }}">{{ $comic->status->name ?? '-' }}</span>
                    </td>
                    <td class="py-3 px-4 text-center text-yellow-500 font-bold">
                        {{ number_format($comic->rating, 1) }}
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.comics.edit', $comic) }}" class="p-1.5 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded transition">Edit</a>
                            <form action="{{ route('admin.comics.destroy', $comic) }}" method="POST" onsubmit="return confirm('Hapus komik ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-500">Tidak ada data komik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-dark-800">
        {{ $comics->links('partials.pagination') }}
    </div>
</div>
@endsection
