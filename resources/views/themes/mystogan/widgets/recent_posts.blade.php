@if(count($posts))
    <div class="sidebar-box ftco-animate">
        <h3 class="sidebar-heading">Недавние записи</h3>
        @foreach($posts as $post)
            <div>
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </div>
            <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                    <h3 class="heading"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                    <div class="meta">
                        <div><a href="#"><span class="icon-calendar"></span> {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('M d, Y') }}</a></div>
                        <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }}</a></div>
                        <div><a href="#"><span class="icon-chat"></span> {{ $post->comments_count }}</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
