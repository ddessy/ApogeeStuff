<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="{{ asset('/js/script.js') }}" defer></script>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        @if (session()->get('userId') != null)
        <ul class="nav">
            <li class="navLi"><a href="{{ route('home.showProfile') }}">Профил</a></li>
            <li class="navLi"><a href="{{ route('quiz.listQuizzes') }}">Анкети</a></li>
            <li class="navLi"><a href="{{ route('home.doLogout') }}">Изход</a></li>
        </ul>
        @endif
        @yield('content')
    </div>
</body>
</html>