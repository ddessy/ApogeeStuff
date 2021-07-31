@extends('layouts.main')

@section('title', 'View Results')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-12 col-sm-12">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Results for game: <span
                            style="font-size: 19px; font-weight: bold">{{$game->game_name}}</span></div>
            </div>

            <div class="panel-body">
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

                <div style="margin-top: 30px">
                    <form action="/view-results/getMiniGameResults" method="POST">
                        @csrf
                        <select class="margin-right form-control" style="display: inline-block; width: 30%" name="hallAndMiniGame">
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
            </div>
        </div>
    </div>
@endsection

@section('AdditionalCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('AdditionalJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/gameResults.js"></script>
@endsection
