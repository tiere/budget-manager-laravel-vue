<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    {!! Html::style('css/app.css') !!}

    <title>Solid Octo Train - @yield('title')</title>
</head>
<body>
    @include('shared.topbar')

    <div class="container-fluid">
        @include('shared.flash')
    </div>

    <div class="container-fluid">
        @yield('content')
    </div>

    {!! Html::script('js/app.js') !!}
</body>
</html>
