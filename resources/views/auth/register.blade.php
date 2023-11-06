<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up - Reshrink</title>
    <link rel="shortcut icon" href="{{ asset('dist/img/icon.svg') }}" type="image/x-icon">
    @include('templates.partials.styles')
  </head>
  <body  class="border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('dist/img/logo.svg') }}" height="36" alt=""></a>
        </div>
        <form class="card card-md" method="POST" action="{{ route('register') }}">
            @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" id="name" name="name" value="{{ old('name') }}" required autofocus>
              @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" id="email" name="email" value="{{ old('email') }}" required>
              @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" id="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input" required/>
                <span class="form-check-label">Agree the <a href="{{ url('https://reshr.ink/privacy-policy') }}" tabindex="-1">Privacy Policy</a> and <a href="{{ url('https://reshr.ink/terms-of-service') }}" tabindex="-1">Terms of Service</a>.</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    @include('templates.partials.scripts')
  </body>
</html>
