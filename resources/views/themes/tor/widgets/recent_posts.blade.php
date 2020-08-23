<div class="main1">
    <div class="main_center">
        <div class="main_top1">
            <div class="main_bottom">
                <div class="widget-title">
                    <span>Недавние записи</span>
                </div>
                <div class="info_exp3">
                    <ul>
                        @foreach($posts as $post)
                            <li>
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
