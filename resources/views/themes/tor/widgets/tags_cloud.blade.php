<div class="main1">
    <div class="main_center">
        <div class="main_top1">
            <div class="main_bottom">
                <div class="widget-title">
                    <span>Облако тегов</span>
                </div>
                <div class="info_exp3">
                    <ul>
                        @foreach($tags as $tag)
                            <li>
                                <a href="{{ route('blog.tags.show', $tag->slug) }}">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
