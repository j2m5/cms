@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $post->title }}</title>
    <meta name="description" content="{{ $post->md }}">
    <meta name="keywords" content="{{ $post->mk }}">
@endsection

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{!! $post->content !!}</p>
        <p class="card-text"><small class="text-muted">Создан: {{ $post->created_at }}</small></p>
        <p class="card-text">Теги:
            @foreach($post->tags as $tag)
                <small>
                    <a href="{{ route('blog.tags.show', $tag->slug) }}">#{{ $tag->name }}</a>
                </small>
            @endforeach
        </p>
    </div>
</div>

@include('themes.'.currentTheme().'.posts.comments')

@endsection
