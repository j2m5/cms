<div class="form-errors-wrapper" role="alert">
    @if(is_array($errors))
        @foreach($errors as $error)
            <div class="form-errors">{{ $error }}</div>
        @endforeach
    @else
        <div class="form-errors">{{ $errors }}</div>
    @endif
</div>
