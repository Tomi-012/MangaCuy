<!-- Comic Card Component -->
<div class="comic-card group">
    <a href="{{ route('comic.show', $comic->slug) }}" class="block">
        <div class="relative overflow-hidden rounded-xl bg-dark-800">
            <img src="{{ $comic->cover_url }}"
                 alt="{{ $comic->title }}"
                 class="comic-cover w-full h-64 sm:h-72 object-cover"
                 loading="lazy">

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            <!-- Type Badge -->
            <span class="absolute top-2 left-2 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-lg"
                  style="background: {{ $comic->type->color ?? '#6366f1' }}">
                {{ $comic->type->name ?? 'Comic' }}
            </span>

            <!-- Status/Hot Badge -->
            @if($comic->is_hot)
                <span class="absolute top-2 right-2 px-2 py-1 bg-red-500 text-[10px] font-bold rounded-lg shadow-lg badge-new flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 7 9a11.05 11.05 0 00-3 4.5 8.001 8.001 0 0012.657 6.814z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    HOT
                </span>
            @endif

            <!-- Rating Overlay -->
            <div class="absolute bottom-2 left-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="text-white text-xs font-bold">{{ number_format($comic->rating, 1) }}</span>
            </div>

            <!-- Views -->
            <div class="absolute bottom-2 right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span class="text-white/80 text-xs">{{ $comic->formatted_views }}</span>
            </div>
        </div>
    </a>
    <div class="mt-2.5 px-0.5">
        <h3 class="font-bold text-sm line-clamp-2 leading-snug">
            <a href="{{ route('comic.show', $comic->slug) }}" class="hover:text-primary-400 transition">{{ $comic->title }}</a>
        </h3>
        @if(isset($comic->latestChapters) && $comic->latestChapters->count() > 0)
        <div class="mt-1.5 space-y-1">
            @foreach($comic->latestChapters->take(2) as $ch)
            <a href="{{ route('chapter.read', [$comic->slug, $ch->slug]) }}"
               class="flex items-center justify-between text-[11px] px-2 py-1.5 rounded-lg bg-dark-800/60 hover:bg-dark-700 transition group/ch">
                <span class="text-gray-400 group-hover/ch:text-primary-400 transition">Ch. {{ (int)$ch->chapter_number }}</span>
                <span class="text-gray-600">{{ $ch->published_at ? $ch->published_at->diffForHumans(null, true) : '' }}</span>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
