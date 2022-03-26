@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $page->title }}</title>
    <meta name="description" content="{{ $page->md }}">
    <meta name="keywords" content="{{ $page->mk }}">
@endsection

@section('content')
    <div class="row pt-md-4">
        <h1 class="mb-3">{{ $page->title }}</h1>
        {!! $page->content !!}
    </div>
@endsection
