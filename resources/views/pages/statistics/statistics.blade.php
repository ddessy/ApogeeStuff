@extends('layouts.app')

@section('title', 'Analytics')

@section('content')
    <div style="margin-top: 30px; padding-bottom: 100px">
        <h2 style="margin-bottom: 50px" s>Statistics</h2>

        <h4 style="margin-bottom: 30px">Maze-game</h4>

        <div style="margin-bottom: 30px">
            <select id="selectMazeGames" class="custom-select margin-right" style="width: 30%"
                    onchange="onSelectMazeGame()">
                <option value="" selected>Choose a maze-game</option>
                @foreach ($mazeGames as $mazeGame)
                    <option value="{{$mazeGame->id}}">{{$mazeGame->game_name}}</option>
                @endforeach
            </select>

            <div id="mazeGameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                <ul>
                    <li>Please choose a maze-game</li>
                </ul>
            </div>
        </div>

        <hr style="border-top: 1px solid #dbdbdb; border-radius: 5px">

        <select id="mazeGameFirstColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterMazeGameSecondSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($mazeGameColumnNames as $mazeGameColumnName)
                <option value="{{$mazeGameColumnName}}">{{$mazeGameColumnName}}</option>
            @endforeach
        </select>

        <select id="mazeGameSecondColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterMazeGameFirstSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($mazeGameColumnNames as $mazeGameColumnName)
                <option value="{{$mazeGameColumnName}}">{{$mazeGameColumnName}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button" onclick="calculateMazeGame()">
            Calculate
        </button>

        <div id="mazeGamePropertiesError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
            <ul>
                <li>Please select all properties</li>
            </ul>
        </div>

        <div>
            <div class="margin-right custom-padding" style="display: inline-block; width: 25%">
                <h6>M: <span id="mazeGameFirstColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="mazeGameFirstColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="mazeGameFirstColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
            <div class="custom-padding" style="display: inline-block; width: 25%">
                <h6>M: <span id="mazeGameSecondColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="mazeGameSecondColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="mazeGameSecondColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
        </div>

        <h6 style="margin-top: 30px">Pearson r: <span id="mazeGamePearsonCorrelation" style="color: dodgerblue">-</span></h6>

        <h6 style="margin-top: 10px">T-test: <span id="mazeGameTTest" style="color: dodgerblue">-</span></h6>

        {{--------------------------------------------------------------------------------------------------------------}}

        <h4 style="margin: 100px 0 30px 0">Hall / Mini-game</h4>

        <div style="margin-bottom: 30px">
            <select id="selectMiniGames" class="custom-select margin-right" style="width: 30%" name="gameId">
                <option value="" selected>Please choose a maze-game first</option>
            </select>

            <div id="miniGameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                <ul>
                    <li>Please choose a Hall / Mini-game</li>
                </ul>
            </div>
        </div>

        <hr style="border-top: 1px solid #dbdbdb; border-radius: 5px">

        <select id="miniGameFirstColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterMiniGameSecondSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($miniGameColumnNames as $miniGameColumnName)
                <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
            @endforeach
        </select>

        <select id="miniGameSecondColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterMiniGameFirstSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($miniGameColumnNames as $miniGameColumnName)
                <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button" onclick="calculateMiniGame()">
            Calculate
        </button>

        <div id="miniGamePropertiesError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
            <ul>
                <li>Please select all properties</li>
            </ul>
        </div>

        <div>
            <div class="margin-right custom-padding" style="display: inline-block; width: 25%">
                <h6>M: <span id="miniGameFirstColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="miniGameFirstColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="miniGameFirstColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
            <div class="custom-padding" style="display: inline-block; width: 25%">
                <h6>M: <span id="miniGameSecondColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="miniGameSecondColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="miniGameSecondColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
        </div>

        <h6 style="margin-top: 30px">Pearson r: <span id="miniGamePearsonCorrelation" style="color: dodgerblue">-</span></h6>

        <h6 style="margin-top: 10px">T-test: <span id="miniGameTTest" style="color: dodgerblue">-</span></h6>
    </div>
@endsection

@section('addCss')
    @parent

    <link href="/css/pages/statistics/statistics.css" rel="stylesheet">
@endsection


@section('addJs')
    @parent
    <script src="/js/pages/statistics/statistics.js"></script>
@endsection
