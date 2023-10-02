@extends('templates.main')
@section('title')
    Domains
@endsection
@section('content')
<h2 class="page-title">
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
