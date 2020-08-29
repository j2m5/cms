@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ siteName() }}</title>
    <meta name="description" content="{{ siteMetaDescription() }}">
    <meta name="keywords" content="{{ siteMetaKeywords() }}">
@endsection

@section('content')

@forelse($posts as $post)
    <div class='theme'>
        <div class='theme_center'>
            <div class='theme_top'>
                <div class='theme_bottom'>
                    <div class='theme_title'>
                        <a href='{{ route('posts.show', $post->slug) }}'>{{ $post->title }}</a>
                    </div>
                    <div class='theme_date'>{{ $post->created_at }}, {{ $post->user->name }}</div>
                    <div class='theme_img'></div>
                    <div class='theme_text'>{!! $post->excerpt !!}</div>
                    <div class='prosmotr'>
                        <img src="/themes/tor/assets/design_img/prosmotr_icon.jpg" alt="" style="margin-bottom:-3px"> Теги:
                        <strong>
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tags.show', $tag->slug) }}">#{{ $tag->name }}</a>
                            @endforeach
                        </strong>
                    </div>
                    <div class='podr'>
                        <a href='{{ route('posts.show', $post->slug) }}'>Подробнее</a>
                    </div>
                    <div class='comm_main'>
                        <img src="/themes/tor/assets/design_img/otvet_icon.jpg" alt="" style="margin-bottom:-4px"> Комментариев: <a href=''><strong>{{ count($post->comments) }}</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div>Постов нет</div>
@endforelse

@if($posts && $posts->total() > $posts->count())
    <div id="str_bg">
        {{ $posts->links('themes.'.currentTheme().'.layouts.pagination') }}
    </div>
@endif

@endsection

