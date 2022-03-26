<nav id="colorlib-main-menu" role="navigation">
    <ul>
        @foreach($items as $item)
            @if(request()->url() === $item)
                <li class="colorlib-active"><a href="{{ $item->url }}">{{ $item->label }}</a></li>
            @else
                <li><a href="{{ $item->url }}">{{ $item->label }}</a></li>
            @endif
        @endforeach
    </ul>
</nav>
