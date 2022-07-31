@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>

@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>

@endif
{{-- The way how Fortify  passes the messages back is a little bit different to how
    we've defined the notification system above.
    It simply passes them back as a status
    No in Laravel Fortify terms if a status is set it generally means it is a positive thing like
    a success
    --}}
@if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>

@endif
