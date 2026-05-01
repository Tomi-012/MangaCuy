@extends('layouts.admin')

@section('title', 'Modify Segment Data')

@section('content')
<div class="max-w-5xl">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h3 class="font-black text-2xl text-white uppercase tracking-tighter italic">Edit Segment</h3>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mt-1">Fragment Synchronization #{{ $chapter->id }}</p>
        </div>
        <a href="{{ route('admin.chapters.index') }}" 
           class="inline-flex items-center gap-2 text-gray-500 hover:text-white text-[10px] font-black uppercase tracking-widest transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Abundance Return
        </a>
    </div>

    @if(session('error'))
    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-500 p-4 mb-8 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf @method('PUT')
        
        <!-- metadata Config -->
        <div class="glass-dark border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-5 border-b border-white/5 bg-white/5 flex items-center gap-3">
                <div class="w-2 h-2 bg-primary-500 rounded-full animate-pulse"></div>
                <h4 class="text-[10px] font-black text-white uppercase tracking-[0.4em]">Primary metadata</h4>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Parent Linkage</label>
                    <select name="comic_id" required class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition">
                        @foreach($comics as $comic)
                        <option value="{{ $comic->id }}" {{ old('comic_id', $chapter->comic_id) == $comic->id ? 'selected' : '' }}>{{ $comic->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Segment Vector</label>
                        <input type="number" step="0.1" name="chapter_number" value="{{ old('chapter_number', $chapter->chapter_number) }}" required
                               class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm font-black uppercase tracking-tight focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Designation (Auth)</label>
                        <input type="text" name="title" value="{{ old('title', $chapter->title) }}"
                               class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm font-black uppercase tracking-tight focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition placeholder:text-gray-800" placeholder="NULL">
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Data Stream -->
        <div class="glass-dark border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-5 border-b border-white/5 bg-white/5 flex items-center gap-3">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <h4 class="text-[10px] font-black text-white uppercase tracking-[0.4em]">Visual Payload Injection</h4>
            </div>

            <div class="p-8 space-y-8">
                <!-- Current Data States -->
                @if($chapter->images->count() > 0)
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Current Data Fragments ({{ $chapter->images->count() }})</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                        @foreach($chapter->images->sortBy('sort_order') as $image)
                        <div class="relative group aspect-[3/4] rounded-xl overflow-hidden border border-white/5 bg-dark-900">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                            <div class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-dark-950/80 rounded text-[8px] font-black text-white border border-white/5">
                                P_{{ str_pad($image->sort_order, 3, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- data Replacement -->
                <div class="space-y-4">
                    <div class="p-4 bg-primary-600/10 border border-primary-600/20 rounded-2xl flex items-start gap-4">
                        <div class="w-8 h-8 rounded-lg bg-primary-600/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="text-[10px] font-black text-primary-400 uppercase tracking-widest leading-relaxed">
                            Uploading new data fragments will overwrite current visual payload. Previous fragments will be permanently purged from the synchronization node.
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-white/5 hover:border-primary-500/40 py-12 rounded-2xl p-6 text-center transition-all bg-white/[0.02] group/upload">
                        <div class="w-16 h-16 mx-auto mb-4 bg-primary-600/10 rounded-2xl flex items-center justify-center group-hover/upload:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-xs text-white font-black uppercase tracking-widest mb-1">Inject New Dataset</p>
                        <p class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-6">Support Format: JPG, PNG, WEBP · Multiple Selection Active</p>
                        
                        <input type="file" name="images[]" multiple accept="image/*"
                             class="mx-auto text-[10px] font-black text-gray-500 file:mr-4 file:py-3 file:px-8 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-primary-600 file:text-white hover:file:bg-primary-500 cursor-pointer shadow-lg shadow-primary-600/10 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="glow-button flex-1 sm:flex-none inline-flex items-center justify-center gap-3 bg-primary-600 hover:bg-primary-500 text-white font-black py-4 px-12 rounded-2xl transition-all hover:shadow-[0_0_40px_-10px_rgba(79,70,229,0.5)] hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                Sync Changes
            </button>
            <a href="{{ route('admin.chapters.index') }}" 
               class="px-12 py-4 border border-white/5 hover:bg-white/5 text-gray-500 hover:text-white rounded-2xl transition-all uppercase tracking-widest text-[10px] font-black">
                Abort
            </a>
        </div>
    </form>
</div>
@endsection
