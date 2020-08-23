<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='/themes/tor/assets/css/style.css' type='text/css' media='all'>
    <script type='text/javascript' src='https://vk.com/js/api/openapi.js?162'></script>
</head>
<body>
    <div id='body_top1'>
        <div id='body_bottom'>
            <div id='wrapper'>
                <div id='header'>
                    <div id='head_top'>
                        <div id='logo'>
                            <a href='/'>
                                <img src="/themes/tor/assets/design_img/logo.jpg" alt="">
                            </a>
                        </div>
                        <form role="search" action="{{ route('blog.search.index') }}" method="get">
                            <div id="knopka_poisk">
                                <input type="submit" value="найти">
                            </div>
                            <div id="poisk">
                                <input class="field" type="text" name="query" placeholder="Поиск">
                            </div>
                        </form>
                    </div>
                    <div id='head_menu1'>
                        <nav>
                            <ul class="sf-menu">
                                <li class="current">
                                    <a href=''>Главная</a>
                                    <ul class="top">
                                        <li><a href=''>Главная</a></li>
                                        <li><a href=''>Об игре</a></li>
                                        <li><a href=''>Механика</a></li>
                                        <li><a href=''>Управление</a></li>
                                        <li><a href=''>Другое</a></li>
                                    </ul>
                                </li>
                                <li class="current">
                                    <a href=''>Об игре</a>
                                </li>
                                <li class="current">
                                    <a href=''>Механика игры</a>
                                    <ul class="top">
                                        <li><a href=''>Главная</a></li>
                                        <li><a href=''>Об игре</a></li>
                                        <li><a href=''>Механика</a></li>
                                        <li><a href=''>Управление</a></li>
                                        <li><a href=''>Другое</a></li>
                                    </ul>
                                </li>
                                <li class="current">
                                    <a href=''>Холонет</a>
                                </li>
                                <li class="current">
                                    <a href=''>Media</a>
                                </li>
                                <li class="current">
                                    <a href=''>Полезные данные</a>
                                </li>
                                <li class="current">
                                    <a href=''>Форум</a>
                                </li>
                            </ul>
                        </nav>
                        <div id='soc_seti'>
                            <a href='' title="twitter"><img src="/themes/tor/assets/design_img/twitter.jpg" alt=""></a>
                            <a href='' title="вконтакте"><img src="/themes/tor/assets/design_img/vkontakte.jpg" alt=""></a>
                            <a href='' title="youtube"><img src="/themes/tor/assets/design_img/youtube.jpg" alt=""></a>
                            <a href='' title="mail"><img src="/themes/tor/assets/design_img/mail.jpg" alt=""></a>
                            <a href='' title="irc"><img src="/themes/tor/assets/design_img/team.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div id='content'>
                    <div id='content_center1'>
                        <div id='content_top1'>
                            <div id='content_bottom1'>
                                @include('themes.'.currentTheme().'.layouts.sidebar')
                                <div id='left_main'>
                                    @yield('slider')
                                    @yield('banner')
                                    @yield('content')
                                </div><!-- left_main -->
                                <div id='logo_main'>
                                    <a href='/'>
                                        <img src="/themes/tor/assets/design_img/logo_content.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- content -->
                <div id='footer'>
                    <div id='sulki1'>
                        <a href=''>Главная</a> <a href=''>Об игре</a> <a href=''>Механика игры</a>
                    </div>
                    <div id='sulki2'>
                        <a href=''>Холонет</a> <a href=''>Media</a> <a href=''>Бета-тест инфо</a> <a href=''>Форум</a>
                    </div>
                    <div id='footer_text'>
                        <div id='f_text'>
                            Данный сайт не относится к LucasArts, BioWare, или Electronic Arts. Товарные знаки являются собственностью их владельцев. LucasArts, Логотип LucasArts, STAR WARS и соответствующие права являются зарегистрированными товарными знаками Lucasfilm Ltd.© 2008-2010 Lucasfilm Entertainment Company Ltd. or Lucasfilm Ltd. Все права защищены. BioWare и логотип BioWare являются товарными знаками или зарегистрированными товарными знаками EA International (Studio and Publishing) Ltd. Контент игры и материалы © ЛИЦЕНЗОР. Все права защищены.
                        </div>
                        <div id='prava'>
                            <div id='prava_sul'>
                                <a href=''>The-old-republic.ru</a> © 2009-{{ date('Y') }}. Все права защищены.
                            </div>
                            <div id='reklama'>
                                <img src="/themes/tor/assets/design_img/rek_icon.jpg" alt=""> <img src="/themes/tor/assets/design_img/rek_icon.jpg" alt=""> <img src="/themes/tor/assets/design_img/rek_icon.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/themes/tor/assets/js/jquery.js"></script>
    <script src='/themes/tor/assets/js/reply.js'></script>
    <script src='/themes/tor/assets/js/scripts.js'></script>
</body>
</html>
