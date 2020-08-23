@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Войти на сайт</title>
    <meta name="description" content="Войти на сайт">
    <meta name="keywords" content="войти на сайт">
@endsection

@section('content')

<div class="theme">
    <div class="theme_center">
        <div class="theme_top" style="min-height: 100px;">
            <div class="theme_title">Войти на сайт</div>
            <div class="theme_date"></div>
            <div class="theme_img"></div>
            <div class="theme_text register-template">
                @if(session('success'))
                    @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
                @endif
                @if($errors->any())
                    @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
                @endif
                <form class="form-group" action="{{ route('login') }}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="login" placeholder="Логин" value="{{ old('login') }}">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Пароль">
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Запомнить пароль
                        </label>
                    </div>
                    <div class="knopka" style="margin-top:15px;">
                        <input type="submit" value="Войти">
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}">Забыли пароль?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
