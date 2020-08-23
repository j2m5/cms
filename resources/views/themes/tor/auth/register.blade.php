@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Регистрация</title>
    <meta name="description" content="Регистрация">
    <meta name="keywords" content="регистрация">
@endsection

@section('content')

<div class="theme">
    <div class="theme_center">
        <div class="theme_top" style="min-height: 100px;">
            <div class="theme_title">Регистрация</div>
            <div class="theme_date"></div>
            <div class="theme_img"></div>
            <div class="theme_text register-template">
                @if(session('success'))
                    @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
                @endif
                @if($errors->any())
                    @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
                @endif
                <form class="form-group" action="{{ route('register') }}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="login" placeholder="Логин (обязательно)" value="{{ old('login') }}">
                    </div>
                    <div>
                        <input type="text" name="email" placeholder="E-mail (обязательно)" value="{{ old('email') }}">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Пароль (обязательно)">
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Повторить пароль (обязательно)">
                    </div>
                    <div class="knopka" style="margin-top:15px;">
                        <input type="submit" value="Регистрация">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
