<?php


namespace App\Http\Controllers;

use App\Calculation\StyleCalculator;
use App\Enum\MessageEnum;
use App\Models\QuestionType;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionsAnswersGridEntry;
use App\Models\QuizQuestionsAnswersTypeEntry;
use App\Models\QuizQuestionsResponse;
use App\Util\QuizUtil;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    /**
     * List all quizzes.
     *
     * @return View
     */
    public function listQuizzes()
    {
        $quizzes = Quiz::all();

        return view('quizzes', ['quizzes' => $quizzes]);
    }

    /**
     * Display a quiz page.
     *
     * @param $quizId
     * @return View
     */
    public function showQuiz($quizId)
    {
        $userId = session()->get('userId');

        $quiz = Quiz::findorFail($quizId);

        $quizQuestions = QuizQuestion::where("quiz_id", "=", $quizId)->get();
        $quizQuestionsIds = array();

        foreach($quizQuestions as $quizQuestion) {
            array_push($quizQuestionsIds, $quizQuestion->id);
        }

        $quizResponses =
            QuizQuestionsResponse::where([["respondent_id", "=", $userId]])
                                 ->whereIn("quiz_question_id", $quizQuestionsIds)
                                 ->orderBy('quiz_question_id', 'asc')
                                 ->get();

        $responsesMap = [];

        $action = "insert";

        if ($quizResponses != null) {

            if (count($quizResponses) > 0 ) {
                $action = "update";
            }

            foreach($quizResponses as $response) {
                if (!empty($response->response_text)) {
                    $responsesMap[$response->quiz_question_id] = $response->response_text;
                } else if (!empty($response->answer_grid_entry_id)) {
                    $responsesMap[$response->quiz_question_id . "_" . $response->answer_grid_entry_id] = $response->answer_type_id;
                } else if (empty($response->response_text) && empty($response->answer_grid_entry_id)) {
                    if (!array_key_exists($response->quiz_question_id, $responsesMap) || empty($responsesMap[$response->quiz_question_id])) {
                        $responsesMap[$response->quiz_question_id] = $response->answer_type_id;
                    } else if (is_array($responsesMap[$response->quiz_question_id])) {
                        array_push($responsesMap[$response->quiz_question_id], $response->answer_type_id);
                    } else {
                        $responsesMap[$response->quiz_question_id] = array($responsesMap[$response->quiz_question_id], $response->answer_type_id);
                    }
                }
            }
        }


        return view('quiz',
            [
                'quiz' => $quiz,
                'responsesMap' => $responsesMap,
                'quizQuestions' => $quizQuestions,
                'action' => $action
            ]);
    }

    /**
     * Save a quiz.
     *
     * @return View
     */
    public function doQuiz()
    {
        if (request('action') == "insert") {
            QuizUtil::insertResponses(request()->post());
        } else {
            QuizUtil::updateResponses(request()->post());
        }

        StyleCalculator::calculate(request()->post());

        session(['message' => MessageEnum::SubmitQuizResponses]);
        return redirect()->route('quiz.listQuizzes')->withErrors(['message' => MessageEnum::SubmitQuizResponses]);
    }

    /**
     * Get question type.
     *
     * @return type of the question
     */
    public static function getQuestionType($questionType)
    {
        $questionType = QuestionType::findorFail($questionType);

        return $questionType->q_type;
    }

    /**
     * Get answers.
     *
     * @return list of answers of a question
     */
    public static function getAnswersList($questionId)
    {
        return QuizQuestionsAnswersTypeEntry::whereRaw('quiz_questions_answers_type_id IN 
                      (SELECT quiz_questions_answers_type_id 
                       FROM quiz_questions_answers 
                       WHERE quiz_question_id = ?)', $questionId)->get();
    }

    /**
     * Get answer grid.
     *
     * @return list of answer grid of a question
     */
    public static function getAnswersGrid($questionId)
    {
        return QuizQuestionsAnswersGridEntry::where("quiz_question_id", "=", $questionId)->get();
    }

}