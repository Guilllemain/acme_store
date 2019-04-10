<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/mario.icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel - @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="/js/all.js" defer></script>
    <script src="/js/init.js" defer></script>
</head>
<body data-id="@yield('page-id')">
    
    <div id="app" class="flex relative">
        @include('partials.admin-sidebar')
        <div class="w-full">
            <h3 class="font-light bg-grey px-8 py-4">{{ getenv('APP_NAME') }}</h3>
            @include('partials.message')
            @yield('content')
        </div>
    </div>

</body>
</html>