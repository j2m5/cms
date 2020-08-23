@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $page->title }}</title>
    <meta name="description" content="{{ $page->md }}">
    <meta name="keywords" content="{{ $page->mk }}">
@endsection

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $page->title }}</h5>
        <p class="card-text">{!! $page->content !!}</p>
        <p class="card-text"><small class="text-muted">Создано: {{ $page->created_at }}</small></p>
    </div>
</div>

@endsection
