<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/mario.icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel - @yield('title')</title>
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="/js/all.js" defer></script>
</head>
<body data-id="@yield('page-id')">
    
    @include('partials.admin-sidebar')

    <div class="off-canvas-content" data-off-canvas-content>
        <div class="title-bar">
          <div class="title-bar-left">
            <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
            <span class="title-bar-title">{{ getenv('APP_NAME') }}</span>
          </div>
        </div>
        @include('partials.message')
        @yield('content')
    </div>
</body>
</html>