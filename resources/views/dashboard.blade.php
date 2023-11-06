@extends('templates.main')
@section('title')
    Home
@endsection
@section('content')
<h1 class="py-2">
    Welcome, {{ auth()->user()->name }}!
</h1>
<h2 class="page-title mt-3">
    URLs
</h2>
<div class="card mt-3">
    <div class="card-body">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('urls.create') }}"><input href="" type="button" value="Create new" class="btn btn-primary"></a>
            </div>
            <form action="" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for..." value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Long URL</th>
                      <th>Shortern URL</th>
                      <th>Clicks</th>
                      <th>Action</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($urls as $index => $data)
                    <tr>
                      <td>
                        <a href="{{ $data->url }}" target="_blank">{{ $data->url }}</a>
                      </td>
                      <td>
                        @if($data->domain)
                            <a href="{{ route('urls.show', ['domain' => $data->domain->domain, 'code' => $data->code]) }}" target="_blank" id="shortenedUrl{{ $index }}">{{ route('urls.show', ['domain' => $data->domain->domain, 'code' => $data->code]) }}</a>
                        @else
                            <a href="{{ route('urls.showHost', ['code' => $data->code]) }}" target="_blank" id="shortenedUrl{{ $index }}">{{ route('urls.showHost', ['code' => $data->code]) }}</a>
                        @endif
                      </td>
                      <td>
                        {{ $data->clicks }}
                      </td>
                      <td>
                        <button id="copyButton{{ $index }}" data-clipboard-target="#shortenedUrl{{ $index }}" class="btn btn-primary">Copy</button>
                        <a href="{{ route('urls.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('urls.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                {{ $urls->links(
                    'pagination::bootstrap-4'
                ) }}
              </div>
            </div>
          </div>
    </div>
</div>
<h2 class="page-title mt-3">
    Domains
</h2>
<div class="card mt-3">
    <div class="card-body">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('domains.create') }}"><input href="" type="button" value="Create new" class="btn btn-primary"></a>
            </div>
            <form action="" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for..." value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Domain Name</th>
                      <th>Action</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($domains as $index => $data)
                    <tr>
                      <td>
                        {{ $data->domain }}
                      </td>
                      <td>
                        @can('destroy', $data)
                        <form action="{{ route('domains.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                {{ $domains->links(
                    'pagination::bootstrap-4'
                ) }}
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
