<div class="card mt-2">
    <h5 class="card-header">Категории</h5>
    <div class="card-body">
        @foreach($categories as $category)
            <div>
                <a href="{{ route('categories.show', $category->id) }}">{{ $category->title }}</a>
            </div>
        @endforeach
    </div>
</div>
