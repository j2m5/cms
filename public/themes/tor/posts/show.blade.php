@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $post->title }}</title>
    <meta name="description" content="{{ $post->md }}">
    <meta name="keywords" content="{{ $post->mk }}">
@endsection

@section('content')

<div class='theme' id='post-{{ $post->id }}'>
    <div class='theme_center'>
        <div class='theme_top'>
            <div class='theme_bottom'>
                <div class='theme_title'>
                    <a href='{{ route('posts.show', $post->slug) }}'>{{ $post->title }}</a>
                </div>
                <div class='theme_date'>{{ $post->created_at }}, {{ $post->user->name }}</div>
                <div class='theme_img'></div>
                <div class='theme_text'>{!! $post->content !!}</div>
                <div class='prosmotr'>
                    <img src="/themes/tor/assets/design_img/prosmotr_icon.jpg" alt="" style="margin-bottom:-3px"> РўРµРіРё:
                    <strong>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('blog.tags.show', $tag->slug) }}">#{{ $tag->name }}</a>
                        @endforeach
                    </strong>
                </div>
                <div class='podr'></div>
                <div class='comm_main'>
                    <img src="/themes/tor/assets/design_img/otvet_icon.jpg" alt="" style="margin-bottom:-4px"> РљРѕРјРјРµРЅС‚Р°СЂРёРµРІ: <a href=''><strong>{{ count($post->comments) }}</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('themes.'.currentTheme().'.posts.comments')

@endsection
