<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            @foreach($items as $item)
                <li class="nav-item @if (count($item->items)) dropdown @endif">
                    @if (count($item->items))
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown">{{ $item->label }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach($item->items as $child)
                                <a class="dropdown-item" href="{{ $child->url }}" @if($child->external) target="_blank" @endif>{{ $child->label }}</a>
                            @endforeach
                        </div>
                    @else
                        <a class="nav-link" href="{{ $item->url }}" @if($item->external) target="_blank" @endif>{{ $item->label }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
