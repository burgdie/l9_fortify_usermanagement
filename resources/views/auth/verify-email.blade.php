@extends('templates.main')
@section ('content')
    <h1>Verify e-mail address </h1>
    <p>You must verify your email address to access this page</p>

    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit"class="btn btn-primary">
            Resend verification e-mail
        </button>
    </form>
@endsection
