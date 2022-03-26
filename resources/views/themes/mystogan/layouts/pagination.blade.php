@if ($paginator->hasPages())
    <div class="row">
        <div class="col">
            <div class="block-27">
                <ul>
                    @if ($paginator->onFirstPage())
                        <li><span>&lt;</span></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
                    @endif
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li><span>{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page === $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
                    @else
                        <li><span>&gt;</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif

