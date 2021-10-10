@extends('layouts.main')

@section('title', 'View Results')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Results for: <span
                            style="font-size: 19px; font-weight: bold">{{ $hallAndMiniGame }}</span></div>
            </div>

            <div class="panel-body">
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
                    @if ($results != null)
                        @foreach ($results as $result)
                            <tr>
                                <td>{{$users->where('id', $result->player_id)->first()->nick_name}}</td>
                                <td>{{$result->playing_time}} s</td>
                                <td>{{$result->points}}</td>
                                <td>{{$result->general_score * 100}} %</td>
                                <td>{{$result->game_goals_exec * 100}} %</td>
                                <td>{{$result->efficiency * 100}} %</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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
    <script src="{{ asset('/js/pages/results/miniGameResults.js') }}"></script>
@endsection
