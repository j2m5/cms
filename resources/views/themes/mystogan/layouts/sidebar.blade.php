<div class="sidebar-box pt-md-4">
    <form action="{{ route('blog.search.index') }}" method="get" class="search-form">
        <div class="form-group">
            <span class="icon icon-search"></span>
            <input type="text" name="query" class="form-control" placeholder="Введите слово и нажмите Enter">
        </div>
    </form>
</div>
{{ Widget::run('AllCategories') }}
{{ Widget::run('RecentPosts') }}
{{ Widget::run('TagsCloud') }}
