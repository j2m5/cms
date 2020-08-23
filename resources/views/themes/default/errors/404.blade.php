@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Ничего не найдено</title>
    <meta name="description" content="Ничего не найдено">
    <meta name="keywords" content="ничего не найдено, ошибка 404, 404">
@endsection

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Запрошенная вами страница не найдена</h5>
    </div>
</div>

@endsection
