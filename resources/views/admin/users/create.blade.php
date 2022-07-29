@extends('templates.main')
@section ('content')
    <h1>Create new  user</h1>
    <div class="card shadow p-3">
        <form method="POST" action="{{ route('admin.users.store') }}">
            {{-- @method('PATCH') --}}
            @include('admin.users.partials.form', ['create' => true] )
        </form>
    </div>
@endsection
