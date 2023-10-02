@extends('templates.main')
@section('title')
    Add your custom domain
@endsection
@section('content')
<h2 class="page-title">
    Add your custom domain
</h2>
<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('domains.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Domain Name</label>
                <input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" placeholder="Enter your domain name" value="{{ old('domain') }}">
                @error('domain')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
            <div class="mb-3">
                <a href="{{ route('domains.index') }}"><input type="button" value="Cancel" class="btn btn-primary"></a>
            </div>
        </form>
    </div>
</div>
@endsection
