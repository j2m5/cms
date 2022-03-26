@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Результаты поиска по запросу: {{ $query }}</title>
    <meta name="description" content="поиск">
    <meta name="keywords" content="поиск">
@endsection

@section('content')
    @forelse($posts as $post)
        <div class="row pt-md-4">
            <div class="col-md-12">
                <div class="blog-entry ftco-animate d-md-flex">
                    <a href="{{ route('posts.show', $post->slug) }}" class="img img-2" style="background-image: url({{ asset('storage').'/'.$post->image }});"></a>
                    <div class="text text-2 pl-md-4">
                        <h3 class="mb-2"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                        <div class="meta-wrap">
                            <p class="meta">
                                <span><i class="icon-calendar mr-2"></i>{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('M d, Y') }}</span>
                                <span><a href="#"><i class="icon-folder-o mr-2"></i>{{ $post->category->title }}</a></span>
                                <span><i class="icon-comment2 mr-2"></i>{{ count($post->comments) }} {{ numberOf(count($post->comments), ['комментарий', 'комментария', 'комментариев']) }}</span>
                            </p>
                        </div>
                        <p class="mb-4">{!! $post->excerpt !!}</p>
                        <p><a href="{{ route('posts.show', $post->slug) }}" class="btn-custom">Подробнее <span class="ion-ios-arrow-forward"></span></a></p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>Ничего не найдено</div>
    @endforelse
    @if($posts && $posts->total() > $posts->count())
        {{ $posts->links('themes.'.currentTheme().'.layouts.pagination') }}
    @endif
@endsection


