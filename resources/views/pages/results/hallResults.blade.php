@extends('layouts.app')

@section('title', 'View Results')

@section('content')
    <div style="padding: 30px 0 30px 0">
        <h2 style="margin-bottom: 30px">Results for game: <span style="color: dodgerblue">WHO IS VALCHAN VOIVODA</span></h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
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

        <div style="margin-top: 30px">
            <select class="custom-select margin-right" style="width: 30%">
                <option selected>Choose a Hall / Mini-game</option>
                @foreach ($miniGames as $miniGame)
                    <option value="{{$miniGame->puzzle_game_name}}">{{$miniGame->puzzle_game_name}}</option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="button" onclick="window.location='{{ url("/view-results/mini-game-results") }}'">
                View Results
            </button>
        </div>
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
    <script src="/js/pages/results/index.js"></script>
@endsection
