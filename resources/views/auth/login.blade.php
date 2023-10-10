<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login - Reshrink</title>
    <link rel="shortcut icon" href="{{ asset('dist/img/icon.svg') }}" type="image/x-icon">
    @include('templates.partials.styles')
  </head>
  <body  class="border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('dist/img/logo.svg') }}" height="36" alt=""></a>
        </div>
        <form class="card card-md" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" id="email" name="email" value="{{ old('email') }}" required autofocus>
              @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">
                Password
                <span class="form-label-description">
                  <a href="{{ route('password.request') }}">I forgot password</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
        </div>
      </div>
    </div>
    @include('templates.partials.scripts')
  </body>
</html>
