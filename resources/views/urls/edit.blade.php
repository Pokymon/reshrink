@extends('templates.main')
@section('title')
    Edit the syntax
@endsection
@section('content')
<h2 class="page-title">
    Edit the syntax
</h2>
<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('urls.update', $urls->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label">Shortern URL</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Enter your desired shortern URL" value="{{ $urls->code }}">
                @error('code')
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
