<div class="card mt-2">
    <h5 class="card-header">Недавние записи</h5>
    <div class="card-body">
        @foreach($posts as $post)
            <div>
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </div>
        @endforeach
    </div>
</div>
