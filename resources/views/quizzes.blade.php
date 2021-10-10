@extends('layouts.main')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Анкети</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                @if (session()->get('message') != null)
                <span style="color: green;">
                    <strong>{{session()->get('message')}}</strong>
                </span> <br><br>
                @endif

                @php
                    session(['message' => null]);
                @endphp

                @foreach ($quizzes as $quiz)
                    <p class="list-quizzes"><a href="{{ route('quiz.showQuiz', $quiz->id) }}" >{{ $quiz->quiz_name }}</a></p>
                @endforeach

            </div>
        </div>
    </div>
@endsection
