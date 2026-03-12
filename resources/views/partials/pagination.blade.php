@if ($paginator->hasPages())
<nav class="flex items-center gap-1">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-dark-800/50 text-gray-600 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-dark-800 hover:bg-primary-600 transition text-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="w-10 h-10 flex items-center justify-center text-gray-600 text-sm">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-600 text-white font-bold text-sm shadow-lg shadow-primary-600/30">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-dark-800 hover:bg-dark-700 text-gray-400 text-sm transition">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-dark-800 hover:bg-primary-600 transition text-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    @else
        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-dark-800/50 text-gray-600 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    @endif
</nav>
@endif
