@if(count($tags))
    <div class="sidebar-box ftco-animate">
        <h3 class="sidebar-heading">Облако тегов</h3>
        <ul class="tagcloud">
            @foreach($tags as $tag)
                <a href="{{ route('blog.tags.show', $tag->slug) }}" class="tag-cloud-link">{{ $tag->name }}</a>
            @endforeach
        </ul>
    </div>
@endif
