@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Результаты поиска по запросу: {{ $query }}</title>
    <meta name="description" content="поиск">
    <meta name="keywords" content="поиск">
@endsection

@section('content')

@forelse($posts as $post)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{!! $post->excerpt !!}</p>
            <p class="card-text"><small class="text-muted">Создан: {{ $post->created_at }}</small></p>
            <p class="card-text">Теги:
                @foreach($post->tags as $tag)
                    <small>
                        <a href="{{ route('blog.tags.show', $tag->slug) }}">#{{ $tag->name }}</a>
                    </small>
                @endforeach
            </p>
            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Читать далее</a>
        </div>
    </div>
@empty
    <div>Постов нет</div>
@endforelse

@if($posts && $posts->total() > $posts->count())
    {{ $posts->appends(['query' => $query])->links() }}
@endif

@endsection

