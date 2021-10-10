<!doctype html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <script type="text/javascript" src="{{ asset('/resources/libraries/multiselect/dist/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}" defer></script>
@yield('AdditionalJs')

<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/resources/libraries/multiselect/dist/css/bootstrap-multiselect.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @yield('AdditionalCss')
</head>

<body>
<div>
    @if (session()->get('userId') != null)
        <ul class="nav">
            <li class="navLi"><a href="{{ route('home.showProfile') }}">Профил</a></li>
            <li class="navLi"><a href="{{ route('quiz.listQuizzes') }}">Анкети</a></li>
            <li class="navLi"><a href="{{ route('results.viewResults') }}">Резултати</a></li>
            <li class="navLi"><a href="{{ route('statistics.statistics') }}">Статистики</a></li>
            <li class="navLi" style="float: right"><a href="{{ route('home.doLogout') }}">Изход</a></li>
        </ul>
    @endif
    <div>
        @yield('content')
    </div>
</div>
</body>
</html>