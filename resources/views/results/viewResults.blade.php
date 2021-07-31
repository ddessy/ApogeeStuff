@extends('layouts.main')

@section('title', 'View Results')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-12 col-sm-12">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Резултати игри</div>
            </div>

            <div class="panel-body">
                <div style="margin: 8px 0 30px 0">
                    <span style="font-size: 19px; margin-right: 10px">Total players:</span>
                    <span style="font-size: 19px; color: rgb(63, 81, 181)">{{$usersCount}}</span>
                </div>

                <form action="/view-results/game-results" method="GET">
                    <select class="margin-right form-control" style="display: inline-block; width: 30%" name="gameId">
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
            </div>
        </div>
    </div>
@endsection

@section('AdditionalCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/css/pages/results/viewResults.css" rel="stylesheet">
@endsection


@section('AdditionalJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/viewResults.js"></script>
@endsection
