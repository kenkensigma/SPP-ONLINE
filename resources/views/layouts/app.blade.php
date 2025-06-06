<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        @include('layouts.sidebar')
        <div class="main-content">
            @include('layouts.header', ['title' => $title])
            @yield('content')
        </div>
    </div>
</body>
</html>