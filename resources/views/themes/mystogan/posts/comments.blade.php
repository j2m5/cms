<div class="pt-5 mt-5">
    <h3 class="mb-5 font-weight-bold">{{ count($post->comments) }} {{ numberOf(count($post->comments), ['комментарий', 'комментария', 'комментариев']) }}</h3>
    <ul class="comment-list">
        @forelse($comments as $parent => $items)
            @if($parent !== 0) @break @endif
            @include('themes.'.currentTheme().'.posts.comment')
        @empty
            <div>Комментариев пока нет</div>
        @endforelse
    </ul>
    @if(!Auth::check())
        <div>Войдите под своей учетной записью чтобы оставить комментарий</div>
    @elseif(auth()->user()->banned)
        <div>Администратор запретил вам писать комментарии</div>
    @else
        @if($post->is_discuss)
            <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Оставьте комментарий</h3>
                <form action="{{ route('blog.comments.store', $post->slug) }}" method="post" class="p-3 p-md-5 bg-light">
                    <input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
                    <input id="parent_id" type="hidden" name="parent_id" value="0">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea name="content" id="message" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Отправить комментарий" class="btn py-3 px-4 btn-primary">
                    </div>
                </form>
            </div>
        @else
            <div>Комментирование ограничено</div>
        @endif
    @endif
</div>
