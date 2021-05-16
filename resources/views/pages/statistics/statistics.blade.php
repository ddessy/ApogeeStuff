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

        <div>
            <div class="inline-block content-to-top">
                <div class="custom-margin-bottom" style="width: 240px">
                    <select id="mazeGameMultiselect" multiple="multiple" class="custom-select margin-right">
                        @foreach ($mazeGameColumnNames as $mazeGameColumnName)
                            <option value="{{$mazeGameColumnName}}">{{$mazeGameColumnName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="custom-margin-bottom" style="width: 240px">
                    <select id="mazeGameMethod" class="custom-select margin-right">
                        <option value="" selected>Choose a method</option>
                        @foreach ($methods as $method)
                            <option value="{{array_search($method, $methods)}}">{{$method}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button class="btn btn-primary" style="width: 240px;" type="button" onclick="calculateMazeGame()">
                        Calculate
                    </button>
                </div>

                <div id="mazeGamePropertiesError" class="alert alert-danger"
                     style="display: none; margin-top: 10px; width: 240px">
                    <ul>
                        <li>Please select a properties</li>
                    </ul>
                </div>
            </div>

            {{--Results--}}
            <div class="inline-block content-to-top" style="margin-left: 100px">
                <div class="custom-margin-bottom">
                    <h6>Method result: <span id="mazeGameMethodResult" style="color: dodgerblue">-</span></h6>
                </div>

                <div>
                    <h5>Properties results</h5>
                </div>
                <div id="containerPropertiesResults"></div>
            </div>
        </div>

        {{--------------------------------------------------------------------------------------------------------------}}

        <h4 style="margin: 60px 0 30px 0">Hall / Mini-game</h4>

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

        <select id="miniGameFirstColumn" class="custom-select margin-right" style="width: 15%"
                onchange="filterMiniGameSecondSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($miniGameColumnNames as $miniGameColumnName)
                <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
            @endforeach
        </select>

        <select id="miniGameSecondColumn" class="custom-select margin-right" style="width: 15%"
                onchange="filterMiniGameFirstSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($miniGameColumnNames as $miniGameColumnName)
                <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
            @endforeach
        </select>

        <select id="miniGameMethod" class="custom-select margin-right" style="width: 15%">
            <option value="" selected>Choose a method</option>
            @foreach ($methods as $method)
                <option value="{{array_search($method, $methods)}}">{{$method}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button" onclick="calculateMiniGame()">
            Calculate
        </button>

        <div id="miniGamePropertiesError" class="alert alert-danger"
             style="display: none; margin-top: 10px; width: 30%">
            <ul>
                <li>Please select all properties</li>
            </ul>
        </div>

        <div style="position: relative">
            <div class="margin-right custom-padding" style="display: inline-block; width: 15%">
                <h6>M: <span id="miniGameFirstColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="miniGameFirstColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="miniGameFirstColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
            <div class="margin-right custom-padding" style="display: inline-block; width: 15%">
                <h6>M: <span id="miniGameSecondColumnM" style="color: dodgerblue">-</span></h6>
                <h6>SD: <span id="miniGameSecondColumnSD" style="color: dodgerblue">-</span></h6>
                <h6>SE: <span id="miniGameSecondColumnSE" style="color: dodgerblue">-</span></h6>
            </div>
            <div class="custom-padding" style="position: absolute; display: inline-block; width: 15%">
                <h6>Result: <span id="miniGameMethodResult" style="color: dodgerblue">-</span></h6>
            </div>
        </div>
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
