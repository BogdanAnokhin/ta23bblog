@if ($paginator->hasPages())
    <nav class="my-2 text-center">
        <div class="join">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="join-item btn btn-disabled" disabled aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">«</span>
                </button>
            @else
                <a class="join-item btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="join-item btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a>
            @else
                <button class="join-item btn btn-disabled" disabled aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">»</span>
                </button>
            @endif
        </div>
    </nav>
@endif