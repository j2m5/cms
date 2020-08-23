@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Сбросить пароль</title>
    <meta name="description" content="Сбросить пароль">
    <meta name="keywords" content="сбросить пароль">
@endsection

@section('content')

<div class="theme">
    <div class="theme_center">
        <div class="theme_top" style="min-height: 100px;">
            <div class="theme_title">Сбросить пароль</div>
            <div class="theme_date"></div>
            <div class="theme_img"></div>
            <div class="theme_text register-template">
                @if (session('status'))
                    @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('status')])
                @endif
                <form class="form-group" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div>
                        <input type="text" name="email" placeholder="E-mail (обязательно)" value="{{ old('email') }}">
                    </div>
                    <div class="knopka" style="margin-top:15px;">
                        <input type="submit" value="Отправить" style="border: none; cursor: pointer;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
