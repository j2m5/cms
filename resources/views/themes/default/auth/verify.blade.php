@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Подтвердите адрес электронной почты</title>
    <meta name="description" content="Подтвердите адрес электронной почты">
    <meta name="keywords" content="подтвердите адрес, электронной почты">
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('Подтвердите адрес электронной почты') }}</div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
</div>
@endsection
