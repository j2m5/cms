<form class="form-inline mb-3" action="{{ route('blog.search.index') }}" method="get">
    <input class="form-control mr-sm-2" type="search" name="query" placeholder="Поиск" aria-label="Поиск">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
</form>
{{ Widget::run('AllCategories') }}
{{ Widget::run('RecentPosts') }}
{{ Widget::run('TagsCloud') }}
