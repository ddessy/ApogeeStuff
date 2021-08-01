@extends('layouts.main')

@section('title', 'Statistics')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Статистики</div>
            </div>

            <div class="panel-body">
                <h4 style="margin-bottom: 30px">Maze-game</h4>

                <div style="margin-bottom: 30px">
                    <select id="selectMazeGames" class="form-control" style="width: 30%"
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

                <div>
                    <div class="inline-block content-to-top">
                        <div class="custom-margin-bottom" style="width: 240px">
                            <select id="mazeGameMultiselect" multiple="multiple">
                                @foreach ($mazeGameColumnNames as $mazeGameColumnName)
                                    <option value="{{$mazeGameColumnName}}">{{$mazeGameColumnName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="custom-margin-bottom" style="width: 240px">
                            <select id="mazeGameMethod" class="margin-right form-control">
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
                    <div class="content-to-top results">
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

                <hr style="border-top: 1px solid #dbdbdb; border-radius: 5px">

                {{--------------------------------------------------------------------------------------------------------------}}

                <h4 style="margin: 30px 0 30px 0">Hall / Mini-game</h4>

                <div style="margin-bottom: 30px">
                    <select id="selectMiniGames" class="margin-right form-control" style="width: 30%" name="gameId">
                        <option value="" selected>Please choose a maze-game first</option>
                    </select>

                    <div id="miniGameError" class="alert alert-danger" style="display: none; margin-top: 10px; width: 30%">
                        <ul>
                            <li>Please choose a Hall / Mini-game</li>
                        </ul>
                    </div>
                </div>

                <div>
                    <div class="inline-block content-to-top">
                        <div class="custom-margin-bottom" style="width: 240px">
                            <select id="miniGameMultiselect" multiple="multiple">
                                @foreach ($miniGameColumnNames as $miniGameColumnName)
                                    <option value="{{$miniGameColumnName}}">{{$miniGameColumnName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="custom-margin-bottom" style="width: 240px">
                            <select id="miniGameMethod" class="margin-right form-control">
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
                    <div class="content-to-top results">
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
        </div>
    </div>
@endsection

@section('AdditionalCss')
    @parent

    <link href="/css/pages/statistics/statistics.css" rel="stylesheet">
@endsection


@section('AdditionalJs')
    @parent
    <script src="/js/pages/statistics/statistics.js"></script>
@endsection
