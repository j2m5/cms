@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Подтвердите адрес электронной почты</title>
    <meta name="description" content="Подтвердите адрес электронной почты">
    <meta name="keywords" content="подтвердите адрес, электронной почты">
@endsection

@section('content')

<div class="theme">
    <div class="theme_center">
        <div class="theme_top" style="min-height: 100px;">
            <div class="theme_title">Подтвердите адрес электронной почты</div>
            <div class="theme_date"></div>
            <div class="theme_img"></div>
            <div class="theme_text">
                @if (session('resent'))
                    @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => 'Новая ссылка для подтверждения была отправлена на ваш адрес электронной почты'])
                @endif
                Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.<br>
                Если вы не получили письмо
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" style="display: inline-block;">
                    @csrf
                    <div class="knopka" style="margin-top:15px;">
                        <input type="submit" value="можете запросить еще" style="border: none; cursor: pointer;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
