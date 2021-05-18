@extends('layouts.main')

@section('content')
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">{{ $quiz->quiz_name }}</div>

            </div>
            <div style="padding-top:30px" class="panel-body">
                <p style="text-align: justify;">{{ $quiz->quiz_descr }}</p>
                <br>
                <form action="{{ route('quiz.doQuiz') }}" method="POST"
                      style="margin: auto;max-width: 90vw;width: 640px;">
                    @csrf
                    <ol>
                        @foreach($quizQuestions as $question)
                            <div class="question">
                                <li>
                                    <div class="questionContent">{{ $question->q_name }}</div>
                                </li>
                                @php
                                    $questionType = \App\Http\Controllers\QuizController::getQuestionType($question->q_type_id);
                                @endphp

                                @if ($questionType == "NUMBER" || $questionType == "WORD" || $questionType == "TEXTAREA")

                                    <input type="{{ App\Util\QuizUtil::getInputTextType($questionType) }}"
                                           name="{{ $question->id }}_text"
                                           value="{{ $responsesMap[$question->id] ?? '' }}" {{ $question->q_descr }}>
                                @endif

                                @if ($questionType == "RADIO_BUTTON" || $questionType == "CHECKBOX")

                                    @php
                                        $answers = \App\Http\Controllers\QuizController::getAnswersList($question->id);
                                    @endphp

                                    @foreach($answers as $answer)

                                        <label class="container">
                                            <input type="{{ App\Util\QuizUtil::getInputType($questionType) }}"
                                                   name="{{ $questionType == "CHECKBOX"
                                                                             ? $question->id . "[]"
                                                                             : $question->id }}"
                                                   value="{{ $answer->id }}"
                                                    {{ App\Util\QuizUtil::isChecked($responsesMap, $question->id, $answer->id) ? "checked" : "" }}>
                                            {{ $answer->answer_name }}
                                        </label>
                                    @endforeach
                                @endif

                                @if($questionType == "GRID")
                                    @php
                                        $answers = \App\Http\Controllers\QuizController::getAnswersList($question->id);
                                    @endphp

                                    <table width="100%">
                                        <tr>
                                            <td></td>
                                            @foreach($answers as $answer)
                                                <td> {{ $answer->answer_name }}</td>
                                            @endforeach
                                        </tr>

                                        @php
                                            $answersGrid = \App\Http\Controllers\QuizController::getAnswersGrid($question->id);
                                        @endphp

                                        @foreach($answersGrid as $answerGrid)
                                            <tr>
                                                <td>
                                                    <span class="answerContent">{{ $answerGrid->answer_grid_entry_name }}</span>
                                                </td>

                                                @php
                                                    $answersSize = count($answers);
                                                    $i = 0;
                                                @endphp
                                                @foreach($answers as $answer)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <td
                                                            @if ($i == ($answersSize -1))
                                                            style="padding-right: 15px;"
                                                            @endif
                                                    ><input type="radio"
                                                            name="{{ $answerGrid->quiz_question_id }}_{{ $answerGrid->id }}_grid"
                                                            value="{{ $answer->id }}"
                                                            @if (($responsesMap != null)
                                                                 && array_key_exists($answerGrid->quiz_question_id . "_" . $answerGrid->id, $responsesMap)
                                                                 && ($responsesMap[$answerGrid->quiz_question_id . "_" . $answerGrid->id] === $answer->id) )
                                                            checked
                                                                @endif>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>

                                @endif
                            </div>
                        @endforeach
                    </ol>
                    <br>
                    <input type="hidden" name="quizId" value="{{ $quiz->id }}">
                    <input type="hidden" name="action" value="{{ $action }}">
                    <a class="btn btn-default btn-close" href="{{ route('quiz.listQuizzes') }}">Cancel</a>
                    <input type="submit" class="btn btn-default btn-close" value="Submit">
                </form>
            </div>
        </div>
    </div>
@endsection
