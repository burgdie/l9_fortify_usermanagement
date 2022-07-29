@extends('templates.main')
@section ('content')
    <h1>Edit user</h1>
    <div class="card shadow p-3">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @method('PATCH')
            @include('admin.users.partials.form')
        </form>
    </div>
@endsection
