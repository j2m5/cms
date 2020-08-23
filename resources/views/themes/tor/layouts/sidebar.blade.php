<div id='right_main'>
    @guest
        <div id='login1'>
            <div id='ava1'></div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div id='enter'>
                    <div id='login2'>
                        <input type="text" name="login" placeholder="Логин">
                    </div>
                    <div id='parol'>
                        <input type="password" name="password" placeholder="Пароль">
                    </div>
                </div>
                <div id='knopka_enter'>
                    <input type="submit" value="Войти">
                </div>
                <div id='knopka_gotovo' class='tooltiped'>
                    <input id="rememberme" class="login-remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <a href=''></a><span class='tooltip'>Запомнить пароль?</span>
                </div>
            </form>
            <div id='knopka_vopros' class='tooltiped'>
                <a href='{{ route('password.request') }}'></a><span class='tooltip'>Забыли пароль?</span>
            </div>
        </div>
        @if (Route::has('register'))
            <div class='register-site'>
                <a href='{{ route('register') }}'>
                    <img src='/themes/tor/assets/design_img/register_site.png' alt='Регистрация'>
                </a>
            </div>
        @endif
    @else
        <div id='login'>
            <div id='ava_login'>
                <img src="{{ asset('/storage/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->login }}" style="height: 80px; width: 80px;">
            </div>
            <div id='name_login'>
                <div id='close' class='tooltiped'>
                    <a id='logout-link' href='{{ route('logout') }}' onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a><span class='tooltip'>Выйти</span>
                </div>
                <div class='login'>
                    <ul class="sf-menu1">
                        <li class="current" id="log">
                            <a class="sf-with-ul" href='{{ route('blog.profile.show') }}'>{{ Auth::user()->login }} <img src="/themes/tor/assets/design_img/strelka_vniz.png" alt="" style="margin-bottom:2px"></a>
                            <ul>
                                <li><a href='/'>Главная</a></li>
                                <li><a href='{{ route('blog.profile.show') }}'>Профиль</a></li>
                                <li><a href='{{ route('logout') }}' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
    <div class="mobile-site">
        <a href="#">
            <img src='/themes/tor/assets/design_img/mobilesite.jpg' alt='Мобильная версия'>
        </a>
    </div>
    {{ Widget::run('AllCategories') }}
    {{ Widget::run('RecentPosts') }}
</div><!-- right_main -->
