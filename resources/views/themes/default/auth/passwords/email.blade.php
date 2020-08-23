@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Сбросить пароль</title>
    <meta name="description" content="Сбросить пароль">
    <meta name="keywords" content="сбросить пароль">
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('Сбросить пароль') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Отправить') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
