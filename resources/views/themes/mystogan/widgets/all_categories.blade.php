@if(count($categories))
    <div class="sidebar-box ftco-animate">
        <h3 class="sidebar-heading">Категории</h3>
        <ul class="categories">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->id) }}">{{ $category->title }} <span>({{ $category->posts_count }})</span></a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
