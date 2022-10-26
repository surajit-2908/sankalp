@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="arrowBg"> <i class="fa fa-arrow1"></i> </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="arrowBg" rel="prev"
                        aria-label="@lang('pagination.previous')"> <i class="fa fa-arrow1"></i> </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><a class="active" href="javascript:void(0)">{{ $page }}</a></li>
                            {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="arrowBg" rel="next"
                        aria-label="@lang('pagination.next')"> <i class="fa fa-arrow2"></i> </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true" class="arrowBg"> <i class="fa fa-arrow2"></i> </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
