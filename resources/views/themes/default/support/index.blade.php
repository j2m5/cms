@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>Служба поддержки</title>
    <meta name="description" content="{{ siteMetaDescription() }}">
    <meta name="keywords" content="{{ siteMetaKeywords() }}">
@endsection

@section('content')
    <h4>Служба поддержки</h4>
    @if(session('success'))
        @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
    @endif
    @if($errors->any())
        @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
    @endif
    <form action="{{ route('support.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div class="form-group">
            <label for="ticket-theme">Тема вопроса</label>
            <input type="text" class="form-control" id="ticket-theme" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="ticket-category">Категория вопроса</label>
            <select class="form-control" id="ticket-category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ticket-message">Сообщение</label>
            <textarea class="form-control" id="ticket-message" rows="3" name="question">{{ old('question') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    <hr>
    <h2 class="mb-4">История вопросов</h2>
    @forelse($tickets as $ticket)
        <div class="card mb-2">
            <div class="card-header">{{ $ticket->title }}</div>
            <div class="card-body">
                <h5 class="card-title">Категория: {{ $ticket->category->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ ticketStatuses($ticket->status) }}</h6>
                <p class="card-text">{{ Str::limit($ticket->question, 200) }}</p>
                <a href="{{ route('support.show', $ticket->id) }}" class="card-link">Просмотреть переписку</a>
            </div>
        </div>
    @empty
        <div>История вопросов пуста</div>
    @endforelse
@endsection
