@extends('layouts.app')

@section('title', 'View Results')

@section('content')
    <div style="height: 80px; width: 230px; border: 1px solid lightgrey; border-radius: 4px; margin: 30px 0 30px 0">
        <div style="position: relative; margin: auto; width: 80%; top: 8px">
            <h3 style="display: inline-block; font-size: 23px; margin-right: 10px">Total players</h3>
            <span data-feather="user" style="height: 30px; width: 30px; color: dodgerblue"></span>
            <h3 style="font-size: 18px; color: darkgrey">{{$usersCount}}</h3>
        </div>
    </div>

    <form action="/view-results/game-results" method="GET">
        <select class="custom-select margin-right" style="width: 30%" name="gameId">
            <option value="" selected>Choose a game</option>
            @foreach ($games as $game)
                <option value="{{$game->id}}">{{$game->game_name}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="submit">
            View Results
        </button>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top: 10px; width: 30%">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>Please choose a game</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

@endsection

@section('addCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/css/pages/results/viewResults.css" rel="stylesheet">
@endsection


@section('addJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/viewResults.js"></script>
@endsection
