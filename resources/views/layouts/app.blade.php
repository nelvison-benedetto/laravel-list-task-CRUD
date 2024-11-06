
{{-- //standart page layout for each web page of the site! --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 10 Task List App</title>
</head>
<body>
    <h1>@yield('title')</h1>   <!--the yield is a “placeholder” where content will be added-->
    <div>
        @yield('content')
    </div>
</body>
</html>
