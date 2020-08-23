<div class="main1">
    <div class="main_center">
        <div class="main_top1">
            <div class="main_bottom">
                <div class="widget-title">
                    <span>Разделы</span>
                </div>
                <div class="info_exp3">
                    <ul>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->id) }}">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
