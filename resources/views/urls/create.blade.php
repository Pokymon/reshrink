@extends('templates.main')
@section('title')
    Reshrink your long URL
@endsection
@section('content')
<h2 class="page-title">
    Reshrink your long URL
</h2>
<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('urls.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Long URL</label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Enter your long URL" value="{{ old('url') }}">
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
            <div class="mb-3">
                <a href="{{ route('urls.index') }}"><input type="button" value="Cancel" class="btn btn-primary"></a>
            </div>
        </form>
    </div>
</div>
@endsection
