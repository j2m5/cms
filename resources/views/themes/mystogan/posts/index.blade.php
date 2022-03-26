@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ siteName() }}</title>
    <meta name="description" content="{{ siteMetaDescription() }}">
    <meta name="keywords" content="{{ siteMetaKeywords() }}">
@endsection

@section('content')
    @forelse($posts as $post)
        <div class="col-md-12">
            <div class="blog-entry-2 ftco-animate">
                <a href="{{ route('posts.show', $post->slug) }}" class="img" style="background-image: url({{ asset('storage').'/'.$post->image }});"></a>
                <div class="text pt-4">
                    <h3 class="mb-4"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                    <p class="mb-4">{!! $post->excerpt !!}</p>
                    <div class="author mb-4 d-flex align-items-center">
                        <a href="#" class="img" style="background-image: url({{ asset('storage').'/'.$post->user->avatar }});"></a>
                        <div class="ml-3 info">
                            <span>Опубликовал</span>
                            <h3><a href="#">{{ $post->user->name }}</a>, <span>{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('M d, Y') }}</span></h3>
                        </div>
                    </div>
                    <div class="meta-wrap d-md-flex align-items-center">
                        <div class="half order-md-last text-md-right">
                            <p class="meta">
                                <span><i class="icon-comment"></i>{{ count($post->comments) }}</span>
                            </p>
                        </div>
                        <div class="half">
                            <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Подробнее</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>Постов нет</div>
    @endforelse
    @if($posts && $posts->total() > $posts->count())
        {{ $posts->links('themes.'.currentTheme().'.layouts.pagination') }}
    @endif
@endsection
