@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ siteName() }}</title>
    <meta name="description" content="{{ siteMetaDescription() }}">
    <meta name="keywords" content="{{ siteMetaKeywords() }}">
@endsection

@section('slider')
    <div id='slider'>
        <div class="folio_block">
            <div class="main_view">
                <div class="window">
                    <div class="image_reel">
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" /></a>
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" class="image1"/></a>
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" class="image2"/></a>
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" class="image3"/></a>
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" class="image4"/></a>
                        <a href=""><img src="/themes/tor/assets/design_img/image.jpg" alt="" class="image5"/></a>
                    </div>
                </div>
                <div class="paging">
                    <a href="#" rel="1">1</a>
                    <a href="#" rel="2">2</a>
                    <a href="#" rel="3">3</a>
                    <a href="#" rel="4">4</a>
                    <a href="#" rel="5">5</a>
                    <a href="#" rel="6">6</a>
                </div>
                <div class='slider_text'>
                    <div class='slider_text1'>
                        <div class='slider_text3'>Скриншоты Дромунд Кааса</div>
                        <div class='slider_text4'>Некоторые люди не хотят видеть выполнение сюжетных заданий в видео, до того, как сами не получат доступ к игре. Я постараюсь угодить всем и смешаю все воедино в видео. Это видео выполнения заданий с 4-го до 5-го уровня Джедаем Консулом с парой классовых сюжетных заданий.</div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- slider -->
@endsection

@section('banner')
    <div id='banner'>
        <a href=''><img src="/themes/tor/assets/design_img/banner_img.jpg" alt=""></a>
    </div>
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
        <div class="pages">
            {{ $posts->links('themes.'.currentTheme().'.layouts.pagination') }}
        </div>
    </div>
@endif

@endsection
