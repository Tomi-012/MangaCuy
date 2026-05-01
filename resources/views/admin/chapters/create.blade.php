@extends('layouts.admin')

@section('title', 'Initialize New Segment')

@section('content')
<div class="max-w-5xl">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h3 class="font-black text-2xl text-white uppercase tracking-tighter italic">Unggah Chapter Baru</h3>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mt-1">Fragment Generation Protocol</p>
        </div>
        <a href="{{ route('admin.chapters.index') }}" 
           class="inline-flex items-center gap-2 text-gray-500 hover:text-white text-[10px] font-black uppercase tracking-widest transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Return to Index
        </a>
    </div>

    @if(session('error'))
    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-500 p-4 mb-8 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('admin.chapters.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- metadata Config -->
        <div class="glass-dark border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-5 border-b border-white/5 bg-white/5 flex items-center gap-3">
                <div class="w-2 h-2 bg-primary-500 rounded-full animate-pulse"></div>
                <h4 class="text-[10px] font-black text-white uppercase tracking-[0.4em]">Primary metadata</h4>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Target Entity</label>
                    <select name="comic_id" required class="w-full bg-white/[0.02] border {{ $errors->has('comic_id') ? 'border-rose-500' : 'border-white/10' }} rounded-xl px-4 py-3 text-[10px] font-black uppercase tracking-widest focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition">
                        <option value="">SELECT TARGET ENTITY...</option>
                        @foreach($comics as $comic)
                        <option value="{{ $comic->id }}" {{ old('comic_id') == $comic->id ? 'selected' : '' }}>{{ $comic->title }}</option>
                        @endforeach
                    </select>
                    @error('comic_id')<p class="text-[9px] font-black text-rose-500 uppercase tracking-widest mt-2 ml-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Segment Index (Numeric)</label>
                        <input type="number" step="0.1" name="chapter_number" value="{{ old('chapter_number') }}" required placeholder="1.0"
                               class="w-full bg-white/[0.02] border {{ $errors->has('chapter_number') ? 'border-rose-500' : 'border-white/10' }} rounded-xl px-4 py-3 text-sm font-black uppercase tracking-tight focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition placeholder:text-gray-800">
                        @error('chapter_number')<p class="text-[9px] font-black text-rose-500 uppercase tracking-widest mt-2 ml-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Segment Alias (Optional)</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="ARC_TITLE"
                               class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-4 py-3 text-sm font-black uppercase tracking-tight focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 transition placeholder:text-gray-800">
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

            <div class="p-8">
                <div class="border-2 border-dashed border-white/5 hover:border-primary-500/40 py-16 rounded-3xl p-6 text-center transition-all bg-white/[0.02] group/upload">
                    <div class="w-20 h-20 mx-auto mb-6 bg-primary-600/10 rounded-3xl flex items-center justify-center group-hover/upload:scale-110 transition-transform duration-500">
                        <svg class="w-10 h-10 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-sm text-white font-black uppercase tracking-widest mb-2">Mass Data Injection Triggered</p>
                    <p class="text-[10px] text-gray-600 font-bold uppercase tracking-[0.2em] max-w-md mx-auto leading-loose mb-8">
                        Select multiple data fragments for sequential synchronization.<br>
                        Ensure lexicographical order (01.jpg, 02.jpg) or manual selection sequence.<br>
                        Max Payload: 3MB per fragment.
                    </p>
                    
                    <input type="file" name="images[]" multiple required accept="image/*"
                         class="mx-auto text-[10px] font-black text-gray-500 file:mr-4 file:py-3.5 file:px-10 file:rounded-2xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-primary-600 file:text-white hover:file:bg-primary-500 cursor-pointer shadow-xl shadow-primary-600/20 transition-all">
                </div>
                @error('images')<p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mt-4 text-center">{{ $message }}</p>@enderror
                @error('images.*')<p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mt-4 text-center">Dataset Corruption: One or more fragments failed validation (Size/Format).</p>@enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="glow-button flex-1 sm:flex-none inline-flex items-center justify-center gap-3 bg-primary-600 hover:bg-primary-500 text-white font-black py-4 px-12 rounded-2xl transition-all hover:shadow-[0_0_40px_-10px_rgba(79,70,229,0.5)] hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                Commence Initialization
            </button>
            <a href="{{ route('admin.chapters.index') }}" 
               class="px-12 py-4 border border-white/5 hover:bg-white/5 text-gray-500 hover:text-white rounded-2xl transition-all uppercase tracking-widest text-[10px] font-black">
                Abort Protocol
            </a>
        </div>
    </form>
</div>
@endsection
