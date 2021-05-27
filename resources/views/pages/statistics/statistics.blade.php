@extends('layouts.app')

@section('title', 'Analytics')

@section('content')
    <div style="margin-top: 30px; padding-bottom: 100px">
        <h2 style="margin-bottom: 50px" s>Statistics</h2>

        <h4 style="margin-bottom: 30px">Maze-game</h4>

        <div style="margin-bottom: 30px">
            <select id="selectMazeGames" class="custom-select margin-right" style="width: 30%"
                    onchange="onSelectMazeGame()">
                <option value="" selected>Select a maze-game</option>
                @foreach ($mazeGames as $mazeGame)
                    <option value="{{$mazeGame->id}}">{{$mazeGame->game_name}}</option>
                @endforeach
            </select>

            <div id="mazeGameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                <ul>
                    <li>Please select a maze-game</li>
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
                        <option value="" selected>Select a method</option>
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

                <div id="mazeGameMethodError" class="alert alert-danger"
                     style="display: none; margin-top: 10px; width: 240px">
                    <ul>
                        <li>Please select a method</li>
                    </ul>
                </div>
            </div>

            {{--Results--}}
            <div class="inline-block content-to-top" style="margin-left: 50px">
                <div class="custom-margin-right inline-block content-to-top">
                    <div id="containerMazePropertiesResults"></div>
                </div>

                <div class="inline-block content-to-top">
                    <div id="mazeGameMethodResults"></div>
                    <div id="mazeGameMethodResultsError" class="alert alert-warning"
                         style="display: none; margin-top: 10px; width: 340px">
                        <ul>
                            <li>To use this method, please select more properties</li>
                        </ul>
                    </div>
                </div>
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

        <div>
            <div class="inline-block content-to-top">
                <div class="custom-margin-bottom" style="width: 240px">
                    <select id="miniGameMultiselect" multiple="multiple" class="custom-select margin-right">
                        @foreach ($miniGameColumnNames as $miniGameColumnName)
                            <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="custom-margin-bottom" style="width: 240px">
                    <select id="miniGameMethod" class="custom-select margin-right">
                        <option value="" selected>Select a method</option>
                        @foreach ($methods as $method)
                            <option value="{{array_search($method, $methods)}}">{{$method}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button class="btn btn-primary" style="width: 240px;" type="button" onclick="calculateMiniGame()">
                        Calculate
                    </button>
                </div>

                <div id="miniGamePropertiesError" class="alert alert-danger"
                     style="display: none; margin-top: 10px; width: 240px">
                    <ul>
                        <li>Please select a properties</li>
                    </ul>
                </div>

                <div id="miniGameMethodError" class="alert alert-danger"
                     style="display: none; margin-top: 10px; width: 240px">
                    <ul>
                        <li>Please select a method</li>
                    </ul>
                </div>
            </div>

            {{--Results--}}
            <div class="inline-block content-to-top" style="margin-left: 50px">
                <div class="custom-margin-right inline-block content-to-top">
                    <div id="containerMiniPropertiesResults"></div>
                </div>

                <div class="inline-block content-to-top">
                    <div id="miniGameMethodResults"></div>
                    <div id="miniGameMethodResultsError" class="alert alert-warning"
                         style="display: none; margin-top: 10px; width: 340px">
                        <ul>
                            <li>To use this method, please select more properties</li>
                        </ul>
                    </div>
                </div>
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
