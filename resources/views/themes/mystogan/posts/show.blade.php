@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $post->title }}</title>
    <meta name="description" content="{{ $post->md }}">
    <meta name="keywords" content="{{ $post->mk }}">
@endsection

@section('content')
    <div class="row pt-md-4">
        <h1 class="mb-3">{{ $post->title }}</h1>
        {!! $post->content !!}
        <div class="tag-widget post-tag-container mb-5 mt-5">
            <div class="tagcloud">
                @foreach($post->tags as $tag)
                    <a href="{{ route('blog.tags.show', $tag->slug) }}" class="tag-cloud-link">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        @include('themes.'.currentTheme().'.posts.comments')
    </div>
@endsection
