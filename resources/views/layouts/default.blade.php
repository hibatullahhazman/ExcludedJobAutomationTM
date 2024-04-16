<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TM | Excluded Automation</title>
    @include('partials.header')
</head>
<body>
    <div class="container-fluid">
        @include('partials.navbar')
        <div class="row flex-nowrap">
            @include('partials.sidebar')
            <div class="col py-3 mx-auto">
                <h2>@yield('heading')</h2>
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>