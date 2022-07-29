@extends('templates.main')
@section('content')


<div class="row">
    <div class="col-12">
        <h1 class="float-start">Users</h1>
        <a class="btn btn-sm btn-success float-end" href="{{ route('admin.users.create') }}" role="button">
            Create
        </a>
    </div>
</div>


    <div class="card shadow  p-4">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit' , $user->id) }}" role="button">
                                Edit
                            </a>

                            <button type="button" class="btn btn-sm btn-danger"
                                onClick="event.preventDefault();
                                document.getElementById('delete-user-form-{{ $user->id }}').submit()">

                                Delete
                            </button>
                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" sstyle="display: none;">
                            @csrf
                                {{-- Blade Helper Method --}}
                                @method("DELETE")
                            </form>


                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>
          {{ $users->links() }}
    </div>
@endsection
