@extends('layouts.app')

@section('title', 'Analytics')

@section('content')
    <div style="margin-top: 30px">
        <h2 style="margin-bottom: 50px" s>Statistics</h2>

        <h4 style="margin-bottom: 30px">Game</h4>

        <div style="margin-bottom: 30px">
            <select id="selectGames" class="custom-select margin-right" style="width: 30%" name="gameId"
                    onchange="onSelectGame()">
                <option value="" selected>Choose a game</option>
                @foreach ($games as $game)
                    <option value="{{$game->id}}">{{$game->game_name}}</option>
                @endforeach
            </select>

            <div id="gameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                <ul>
                    <li>Please choose a game</li>
                </ul>
            </div>
        </div>

        <select id="gameFirstColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterGameSecondSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($gameColumnNames as $gameColumnName)
                <option value="{{$gameColumnName}}">{{$gameColumnName}}</option>
            @endforeach
        </select>

        <select id="gameSecondColumn" class="custom-select margin-right" style="width: 25%"
                onchange="filterGameFirstSelectOptions()">
            <option value="" selected>Choose a property</option>
            @foreach ($gameColumnNames as $gameColumnName)
                <option value="{{$gameColumnName}}">{{$gameColumnName}}</option>
            @endforeach
        </select>

        <select id="gameMethods" class="custom-select margin-right" style="width: 25%">
            <option value="" selected>Choose a method</option>
            @foreach ($methods as $method)
                <option value="{{array_search ($method, $methods)}}">{{$method}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button" onclick="calculateGame()">
            Calculate
        </button>

        <div id="gamePropertiesError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
            <ul>
                <li>Please select all properties and method</li>
            </ul>
        </div>

        <input type="text" readonly class="form-control" id="resultGame" placeholder="Result"
               style="width: 15%; margin-top: 30px">

        {{--------------------------------------------------------------------------------------------------------------}}

        <h4 style="margin: 100px 0 30px 0">Hall / Mini-game</h4>

        <div style="margin-bottom: 30px">
            <select id="selectMiniGames" class="custom-select margin-right" style="width: 30%" name="gameId">
                <option value="" selected>Please choose a game first</option>
            </select>

            <div id="miniGameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                <ul>
                    <li>Please choose a Hall / Mini-game</li>
                </ul>
            </div>
        </div>

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

        <select id="miniGameMethods" class="custom-select margin-right" style="width: 25%">
            <option value="" selected>Choose a method</option>
            @foreach ($methods as $method)
                <option value="{{array_search ($method, $methods)}}">{{$method}}</option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="button" onclick="calculateMiniGame()">
            Calculate
        </button>

        <div id="miniGamePropertiesError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
            <ul>
                <li>Please select all properties and method</li>
            </ul>
        </div>

        <input type="text" readonly class="form-control" id="resultMiniGame" placeholder="Result"
               style="width: 15%; margin-top: 30px">
    </div>
@endsection

@section('addCss')
    @parent

@endsection


@section('addJs')
    @parent
    <script src="/js/pages/statistics/statistics.js"></script>
@endsection
