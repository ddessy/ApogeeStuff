@extends('layouts.app')

@section('title', 'View Results')

@section('content')

    {{--    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>--}}

    <div style="height: 80px; width: 230px; border: 1px solid lightgrey; border-radius: 4px; margin: 30px 0 30px 0">
        <div style="position: relative; margin: auto; width: 80%; top: 8px">
            <h3 style="display: inline-block; font-size: 23px; margin-right: 10px">Total players</h3>
            <span data-feather="user" style="height: 30px; width: 30px; color: dodgerblue"></span>
            <h3 style="font-size: 18px; color: darkgrey">{{count($users)}}</h3>
        </div>
    </div>

    <select class="custom-select margin-right" style="width: 30%">
        <option selected>Choose a game</option>
        @foreach ($games as $game)
            <option value="{{$game->id}}">{{$game->game_name}}</option>
        @endforeach
    </select>

    <button class="btn btn-primary" type="button" onclick="window.location='{{ url("/view-results/hall-results") }}'">
        View Results
    </button>

@endsection

@section('addCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/css/pages/results/index.css" rel="stylesheet">
@endsection


@section('addJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/index.js"></script>
@endsection
