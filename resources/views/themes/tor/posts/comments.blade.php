<div class='blocks' style='position:relative; left:20px;'>
    <div class='blocks_center'>
        <div class='blocks_top1'>
            <div class='blocks_bottom2'>
                <div class='info_pers'>Комментарии <span>({{ count($post->comments) }})</span></div>
                <div class='comm comments'>
                    @foreach($comments as $parent => $items)
                        @if($parent !== 0) @break @endif
                        @include('themes.'.currentTheme().'.posts.comment')
                    @endforeach
                    @if(!Auth::check())
                        <div class="comment-respond">
                            <div class="no-comments">Оставлять комментарии могут только авторизованные пользователи</div>
                        </div>
                    @else
                        @if($post->is_discuss)
                            <div id="respond" class="comment-respond">
                                <form id="comment-form" action="{{ route('blog.comments.store', $post->slug) }}" method="post">
                                    <input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input id="parent_id" type="hidden" name="parent_id" value="0">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @csrf
                                    <div class="enter-comment">
                                        <h3 class="add-comment-title">Добавить комментарий</h3>
                                        <textarea id="enter-comment" name="content">{{ old('content') }}</textarea>
                                    </div>
                                    <div class="form-submit knopka">
                                        <input name="submit" type="submit" id="submit" class="add-comment-btn" value="Отправить">
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="comment-respond">
                                <div class="no-comments">Возможность обсуждения этой новости ограничена</div>
                            </div>
                        @endif
                    @endif
                    <div class='str_text' style="visibility: hidden;">Страницы:</div>
                </div>
            </div>
        </div>
    </div>
</div><!-- blocks -->

