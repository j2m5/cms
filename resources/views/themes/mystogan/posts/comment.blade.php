@foreach($items as $item)
    <li id="comment-{{ $item->id }}" class="comment">
        <div class="vcard bio">
            <img src="{{ asset('storage/'.$item->user->avatar) }}" alt="{{ $item->user->name }}">
        </div>
        <div class="comment-body">
            <h3>{{ $item->user->name }}</h3>
            <div class="meta">{{ $item->created_at }}</div>
            <p>{{ $item->content }}</p>
            @if(Auth::check() && $item->post->is_discuss)
                <p><a href="#" class="reply">Ответить</a></p>
            @endif
        </div>
        @if(isset($comments[$item->id]))
            <ul class="children">
                @include('themes.'.currentTheme().'.posts.comment', ['items' => $comments[$item->id]])
            </ul>
        @endif
    </li>
@endforeach
