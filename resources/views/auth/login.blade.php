@extends('templates.main')
@section ('content')
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email"
            class="form-control @error('email') is-invalid @enderror"
            name="email" id="email"
            aria-describedby="email" value="{{ old('email') }}"
          >
          @error('email')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror
        </div>
        <div class="mb-3">
          <label for="password class="form-label">Password</label>
          <input type="password"
             class="form-control @error('password')  is-invalid @enderror"
             name="password" id="password"
          >
          @error('password')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <a href="{{ route('password.request') }}">Forgotten your password? Reset it here</a>
@endsection
