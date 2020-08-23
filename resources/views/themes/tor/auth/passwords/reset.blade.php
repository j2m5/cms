@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Восстановить пароль</title>
    <meta name="description" content="Восстановить пароль">
    <meta name="keywords" content="восстановить пароль">
@endsection

@section('content')

<div class="theme">
    <div class="theme_center">
        <div class="theme_top" style="min-height: 100px;">
            <div class="theme_title">Восстановить пароль</div>
            <div class="theme_date"></div>
            <div class="theme_img"></div>
            <div class="theme_text register-template">
                <form class="form-group" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <input type="text" name="email" placeholder="E-mail (обязательно)" value="{{ $email ?? old('email') }}">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Пароль (обязательно)">
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Повторить пароль (обязательно)">
                    </div>
                    <div class="knopka" style="margin-top:15px;">
                        <input type="submit" value="Восстановить пароль" style="border: none; cursor: pointer;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
