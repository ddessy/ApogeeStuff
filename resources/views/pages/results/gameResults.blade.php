@extends('layouts.app')

@section('title', 'View Results')

@section('content')
    <div style="margin-top: 30px">
        <h2 style="margin-bottom: 30px">Results for game: <span style="color: dodgerblue">{{$game->game_name}}</span></h2>
        <table id="gameResults" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Play Time</th>
                <th>Points</th>
                <th>Score</th>
                <th>Goals</th>
                <th>Effectiveness</th>
                <th>Efficiency</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{$users->where('id', $result->player_id)->first()->nick_name}}</td>
                    <td>{{$result->total_playing_time}} s</td>
                    <td>{{$result->total_points}}</td>
                    <td>{{$result->general_score * 100}} %</td>
                    <td>{{$result->total_game_goals_exec * 100}} %</td>
                    <td>{{$result->general_effectiveness * 100}} %</td>
                    <td>{{$result->general_efficiency * 100}} %</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px">
        <form action="/view-results/getMiniGameResults" method="POST">
            @csrf
            <select class="custom-select margin-right" style="width: 30%" name="chosenHallAndMiniGame">
                <option value="" selected>Choose a Hall / Mini-game</option>
                @foreach ($miniGames as $miniGame)
                    <option value="{{$miniGame->puzzle_game_name}}">{{$miniGame->puzzle_game_name}}</option>
                @endforeach
            </select>

            <input name="gameId" type="hidden" value="{{$game->id}}">

            <button class="btn btn-primary" type="submit">
                View Results
            </button>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px; width: 30%">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>Please choose a Hall / Mini-game</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    <div style="margin-top: 100px">
        <h2 style="margin-bottom: 30px">Analytics</h2>

        <select class="custom-select margin-right" style="width: 25%" name="chosenHallAndMiniGame">
            <option value="" selected>Choose a column</option>
            @foreach ($miniGames as $miniGame)
                <option value="{{$miniGame->puzzle_game_name}}">{{$miniGame->puzzle_game_name}}</option>
            @endforeach
        </select>

        <select class="custom-select margin-right" style="width: 25%" name="chosenHallAndMiniGame">
            <option value="" selected>Choose a column</option>
            @foreach ($miniGames as $miniGame)
                <option value="{{$miniGame->puzzle_game_name}}">{{$miniGame->puzzle_game_name}}</option>
            @endforeach
        </select>

        <select class="custom-select margin-right" style="width: 25%" name="chosenHallAndMiniGame">
            <option value="" selected>Choose a method</option>
            @foreach ($miniGames as $miniGame)
                <option value="{{$miniGame->puzzle_game_name}}">{{$miniGame->puzzle_game_name}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button">
            Calculate
        </button>

        <h5 style="margin-top: 30px">Result: <span style="color: dodgerblue">-//-</span></h5>
    </div>
@endsection

@section('addCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('addJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/gameResults.js"></script>
@endsection
