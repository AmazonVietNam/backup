@php
    $link_limit = 7;
@endphp

@if($paginator->lastPage())
<nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
    <div class="text-center text-md-left mb-3 mb-md-0">{{translate('Showing')}} {{$paginator->firstItem()}}-{{$paginator->lastItem()}} {{translate('of')}} {{$paginator->total()}} {{translate('results')}}</div>
    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
        <li class="page-item {{ $paginator->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $paginator->url(1) }}"><a class="page-link" href="{{ $paginator->url(1) }}"><i class="fa fa-angle-double-left"></i></a></li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            @endphp
            @if ($from < $i && $i < $to)
                <li class="page-item">
                    <a class="page-link {{ ($paginator->currentPage() == $i) ? ' current text-white' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="page-item {{ $paginator->lastPage() == $paginator->currentPage() ? 'disabled' : '' }}"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fa fa-angle-double-right"></i></a></li>
    </ul>
</nav>
@endif