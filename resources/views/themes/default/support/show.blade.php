@extends('themes.'.currentTheme().'.layouts.app')

@section('meta')
    <title>{{ $ticket->title }}</title>
    <meta name="description" content="{{ siteMetaDescription() }}">
    <meta name="keywords" content="{{ siteMetaKeywords() }}">
@endsection

@section('content')
    <div class="card mb-2">
        <div class="card-header">{{ $ticket->title }}</div>
        <div class="card-body">
            <h5 class="card-title">Категория: {{ $ticket->category->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ ticketStatuses($ticket->status) }}</h6>
            <p class="card-text">{{ $ticket->question }}</p>
        </div>
    </div>
    @if(count($messages))
        <div class="card mb-4">
            <ul class="list-group list-group-flush">
                @foreach($messages as $message)
                    <li class="list-group-item">
                        <div>
                            <span>{{ $message->userFrom->login }}</span>
                            <span class="text-muted small">{{ $message->created_at }}</span>
                            <span class="text-muted small">[{{ ticketMessageIsRead($message->read) }}]</span>
                        </div>
                        <div>{{ $message->message }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        @include('themes.'.currentTheme().'.layouts.alert_success', ['message' => session('success')])
    @endif
    @if($errors->any())
        @include('themes.'.currentTheme().'.layouts.alert_error', ['errors' => $errors->all()])
    @endif
    @if($ticket->status !== 'closed')
        <form action="{{ route('blog.support.message.store') }}" method="post">
            @csrf
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="from" value="{{ auth()->id() }}">
            <input type="hidden" name="to" value="1">
            <div class="form-group">
                <label for="ticket-message">Сообщение</label>
                <textarea class="form-control" id="ticket-message" rows="3" name="message">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Написать</button>
        </form>
    @endif
@endsection
