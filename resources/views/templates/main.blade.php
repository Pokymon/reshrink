<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Reshrink</title>
    <link rel="shortcut icon" href="{{ asset('dist/img/icon.svg') }}" type="image/x-icon">
    @include('templates.partials.styles')
</head>
<body>
    @include('templates.partials.navbar')
    <div class="wrapper">
        <div class="col mt-3">
            <div class="page-header d-print-none">
                <div class="container-xl">
                  <div class="row g-2 align-items-center">
                    <div class="col">
                        @yield('content')
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @include('templates.partials.footer')
    @include('templates.partials.scripts')
</body>
</html>
