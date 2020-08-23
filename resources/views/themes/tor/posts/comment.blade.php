@foreach($items as $item)
    <div id="comment-{{ $item->id }}" class="comm_bg">
        <div class='comm_ava'>
            <img src="{{ asset('/storage/'.$item->user->avatar) }}" alt="{{ $item->user->name }}" style="height: 60px; width: 60px;">
        </div>
        <div class='comm_title'>
            {{ $item->user->name }}
            <img src="/themes/tor/assets/design_img/red_icon.png" alt="">
            <span>{{ $item->created_at }}</span>
            @if(Auth::check() && $post->is_discuss)
                <a class="reply comment-reply-link" href="#" rel="nofollow">Ответить</a>
            @endif
        </div>
        <div class='comm_text'>
            <p>{!! $item->content !!}</p>
        </div>
        @if(isset($comments[$item->id]))
            @include('themes.'.currentTheme().'.posts.comment', ['items' => $comments[$item->id]])
        @endif
    </div>
@endforeach

