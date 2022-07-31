@extends('templates.main')
@section ('content')
  <h1>Update Profile</h1>
    <form method="POST" action="{{ route('user-profile-information.update') }}">
        @csrf
        @method("PUT")
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text"
            class="form-control @error('name')  is-invalid @enderror"
            name="name" id="name"
            aria-describedby="name" value="{{ auth()->user()->name }}"
          >
          @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email"
            class="form-control @error('email') is-invalid @enderror"
            name="email" id="email"
            aria-describedby="email" value="{{ auth()->user()->email }}"
          >
          @error('email')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
@endsection
