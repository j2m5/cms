@foreach($items as $item)
    <div id="comment-{{ $item->id }}" class="media mb-2 @if($item->parent_id !== 0) mt-3 @endif">
        <img src="{{ asset('storage/'.$item->user->avatar) }}" class="mr-3" alt="{{ $item->user->name }}" style="height: 60px; width: 60px;">
        <div class="media-body">
            <a class="mt-0" href="#">{{ $item->user->name }}</a>
            <small>{{ $item->created_at }}</small>
            <div>{!! $item->content !!}</div>
            @if(Auth::check() && $item->post->is_discuss)
                <a class="reply" href="#">Ответить</a>
            @endif
            @if(isset($comments[$item->id]))
                @include('themes.'.currentTheme().'.posts.comment', ['items' => $comments[$item->id]])
            @endif
        </div>
    </div>
@endforeach
