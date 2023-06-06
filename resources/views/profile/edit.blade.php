@extends('templates.main')
@section('title')
    Settings
@endsection
@section('content')
<h2 class="page-title mb-3">
    Settings
</h2>
@if (session('status') === 'profile-updated')
    <div class="alert alert-success" role="alert">
        {{ __('Profile information updated!') }}
    </div>
@endif
@if (session('status') === 'password-updated')
    <div class="alert alert-success" role="alert">
        {{ __('Password updated!') }}
    </div>
@endif
<div class="col-12 mt-1">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form class="card" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
      <div class="card-header">
        <h3 class="card-title">My Profile</h3>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="John Smith" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
          @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="john@smith.com" value="{{ old('email', $user->email) }}" required autocomplete="email">
          @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Profile Photo</label>
            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" placeholder="John Smith" value="{{ old('photo', $user->photo) }}" autofocus autocomplete="photo">
        </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
</div>
<div class="mt-3 col-12">
    <form class="card" method="post" action="{{ route('password.update') }}">
        @csrf
        @method('patch')
      <div class="card-header">
        <h3 class="card-title">Update Password</h3>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Current password</label>
          <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" type="password" placeholder="Enter your current password" autocomplete="current-password">
          @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">New password</label>
          <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Enter your new password" autocomplete="new-password">
          @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm password</label>
          <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" type="password" placeholder="Enter your new password" autocomplete="new-password">
          @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
</div>
@endsection
