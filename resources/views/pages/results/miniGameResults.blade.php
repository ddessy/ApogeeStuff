@extends('layouts.app')

@section('title', 'View Results')

@section('content')
    <div style="margin-top: 30px">
        <h2 style="margin-bottom: 30px">Results for <span style="color: dodgerblue">{{session('hallAndMiniGame')}}</span></h2>
        <table id="miniGameResults" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Play Time</th>
                <th>Points</th>
                <th>Score</th>
                <th>Goals</th>
                <th>Efficiency</th>
            </tr>
            </thead>
            <tbody>
            @foreach (session('results') as $result)
                <tr>
                    <td>{{session('users')->where('id', $result->player_id)->first()->nick_name}}</td>
                    <td>{{$result->playing_time}} s</td>
                    <td>{{$result->points}}</td>
                    <td>{{$result->general_score * 100}} %</td>
                    <td>{{$result->game_goals_exec * 100}} %</td>
                    <td>{{$result->efficiency * 100}} %</td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
    <script src="/js/pages/results/miniGameResults.js"></script>
@endsection
