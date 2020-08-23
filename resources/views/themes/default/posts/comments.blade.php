<div class="comments">
    <h2>Комментарии ({{ count($post->comments) }})</h2>
    @forelse($comments as $parent => $items)
        @if($parent !== 0) @break @endif
        @include('themes.'.currentTheme().'.posts.comment')
    @empty
        <div>Комментариев пока нет</div>
    @endforelse
    @if(session('success'))
        @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
    @endif
    @if($errors->any())
        @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
    @endif
    @if(!Auth::check())
        <div>Войдите под своей учетной записью чтобы оставить комментарий</div>
    @elseif(auth()->user()->banned)
        <div>Администратор запретил вам писать комментарии</div>
    @else
        @if($post->is_discuss)
            <form id="comment-form" action="{{ route('blog.comments.store', $post->slug) }}" method="post">
                <input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
                <input id="parent_id" type="hidden" name="parent_id" value="0">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @csrf
                <div class="form-group">
                    <textarea id="enter-comment" class="form-control" name="content" rows="3">{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        @else
            <div>Комментирование ограничено</div>
        @endif
    @endif
</div>

