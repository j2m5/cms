<div class="card mt-2">
    <h5 class="card-header">Облако тегов</h5>
    <div class="card-body">
        @foreach($tags as $tag)
            <div>
                <a href="{{ route('blog.tags.show', $tag->slug) }}">{{ $tag->name }}</a>
            </div>
        @endforeach
    </div>
</div>
