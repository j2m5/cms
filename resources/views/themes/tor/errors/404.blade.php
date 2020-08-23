@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Страница не найдена</title>
    <meta name="description" content="страница не найдена">
    <meta name="keywords" content="страница не найдена, ошибка 404, ничего не найдено, 404">
@endsection

@section('content')
    <div class="theme">
        <div class="theme_center">
            <div class="theme_top" style="min-height: 100px;">
                <div class="theme_title">Ничего не найдено</div>
                <div class="theme_date"></div>
                <div class="theme_img"></div>
                <div class="theme_text">Страница не существует</div>
            </div>
        </div>
    </div>
@endsection
