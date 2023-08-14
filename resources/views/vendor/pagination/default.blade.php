@if ($paginator->lastPage() > 1)
    <div class="pagination-wrap-ab mb-5">
        <ul class="items">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <button class="common-btn disabled" ><span>&laquo;</span></button>
                </li>
            @else
                <li><a class="common-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- First 5 Pages --}}
            @for ($i = 1; $i <= min(5, $paginator->lastPage()); $i++)
                <li>
                    <a class="common-btn {{ $paginator->currentPage() == $i ? 'active' : '' }}"
                        href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Ellipsis and Last 5 Pages --}}
            @if ($paginator->lastPage() > 5)
                <li><span>...</span></li>
                @for ($i = max($paginator->lastPage() - 4, 6); $i <= $paginator->lastPage(); $i++)
                    <li>
                        <a class="common-btn {{ $paginator->currentPage() == $i ? 'active' : '' }}"
                            href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a class="common-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li>
                    <button class="common-btn disabled" href=""><span>&raquo;</span></button>
                </li>
            @endif
        </ul>
    </div>
@endif
