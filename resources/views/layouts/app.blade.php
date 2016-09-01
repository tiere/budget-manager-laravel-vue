<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {!! Html::style('css/app.css') !!}
    <title>Solid Octo Train - @yield('title')</title>
</head>
<body>
    @yield('content')

    {!! Html::script('js/app.js') !!}
</body>
</html>
