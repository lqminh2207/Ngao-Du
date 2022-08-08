@section('css')

@endsection
@if ($paginator->hasPages())
    <nav aria-label="..." class=" Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item page_item disabled" aria-disabled="true">
                    <a class="page-link  page_link active_left" href="#">
                        <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="arrow-pag-left" d="M5.07971 7.89839L2.21215 5.0308L14.6758 5.0308L14.6758 4.07492L2.21221 4.07492L5.07971 1.20739L4.40381 0.531494L0.382445 4.55289L4.40381 8.57429L5.07971 7.89839Z" fill="black"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item page_item">
                    <a class="page-link page_link" href="{{ $paginator->previousPageUrl() }}">
                        <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="arrow-pag-left" d="M5.07971 7.89839L2.21215 5.0308L14.6758 5.0308L14.6758 4.07492L2.21221 4.07492L5.07971 1.20739L4.40381 0.531494L0.382445 4.55289L4.40381 8.57429L5.07971 7.89839Z" fill="black"/>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item page_item disabled" aria-disabled="true">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page">
                                <span>{{ $page }}</span>
                            </li> --}}
                            <li class="page-item page_item d-none d-md-block">
                                <a class="page-link page_link active-paginate" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item page_item d-none d-md-block"><a class="page-link page_link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item page_item">
                    <a class="page-link page_link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">
                        <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="arrow-pag-right" d="M10.3441 1.20732L13.2117 4.07491L0.748047 4.07491L0.748047 5.03079L13.2116 5.03079L10.3441 7.89832L11.02 8.57422L15.0414 4.55282L11.02 0.531426L10.3441 1.20732Z" fill="black"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item page_item disabled">
                    <a class="page-link page_link active_left" href="#">
                        <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="arrow-pag-right" d="M10.3441 1.20732L13.2117 4.07491L0.748047 4.07491L0.748047 5.03079L13.2116 5.03079L10.3441 7.89832L11.02 8.57422L15.0414 4.55282L11.02 0.531426L10.3441 1.20732Z" fill="black"/>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <style>
        .active-paginate {
            color: white !important;
            background-color: {{ !empty($project->color) ? $project->color : '#007A4D' }} !important;
            font-weight: bold !important;
        }

    </style>
@endif