@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <div id="nazad1">
            <span>Назад</span>
        </div>
    @else
        <div id="nazad1">
            <a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">Назад</a>
        </div>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
            <div class="str1">
                <span>{{ $element }}</span>
            </div>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <div class="str_active">
                        <span>{{ $page }}</span>
                    </div>
                @else
                    <div class="str1">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <div id="vpered1">
            <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next">Вперед</a>
        </div>
    @else
        <div id="vpered1">
            <span>Вперед</span>
        </div>
    @endif
@endif
<div class="clear"></div>
