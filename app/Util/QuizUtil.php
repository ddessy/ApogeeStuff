<?php


namespace App\Util;


use App\Models\QuizQuestionsResponse;
use Illuminate\Support\Facades\Log;

class QuizUtil
{
    public static function getInputType($type) {

        if ($type == "RADIO_BUTTON") {
            return 'radio';
        } else {
            return 'checkbox';
        }
    }

    public static function getInputTextType($type) {

        if ($type == "TEXTAREA") {
            return 'textarea';
        } else {
            return 'text';
        }
    }

    public static function isChecked($responsesMap, $questionId, $answerId) {
        return
            $responsesMap != null && array_key_exists($questionId, $responsesMap)
                &&
                ($responsesMap[$questionId] === $answerId
                || (
                    is_array($responsesMap[$questionId])
                    && in_array($answerId, $responsesMap[$questionId])));
    }

    public static function insertResponses($request) {

        $userId = session()->get('userId');

        foreach ($request as $key => $value) {
            if ($key === "_token" || $key === "action" || $key === "quizId") {
                continue;
            }

            self::insertQuestionResponse($value, $key, $userId);
        }

    }

    public static function updateResponses($request) {

        $userId = session()->get('userId');

        foreach ($request as $key => $value) {

            if ($key === "_token" || $key === "action" || $key === "quizId") {
                continue;
            }

            if (!QuizQuestionsResponse::where([["respondent_id", "=", $userId], ["quiz_question_id", "=", $key]])->exists()) {
                self::insertQuestionResponse($value, $key, $userId);
            } else {

                // in case when we have checkbox with many selected values
                if (is_array($value)) {
                    QuizQuestionsResponse::where(
                        [
                            ["respondent_id", "=", $userId],
                            ["quiz_question_id", "=", $key]
                        ])->delete();

                    foreach ($value as $selected) {
                        self::insertQuestionResponse($selected, $key, $userId);
                    }
                } else {

                    $qArray = explode('_', $key);

                    // in case when we have radio button with one selected value
                    if (count($qArray) == 1) {
                        QuizQuestionsResponse::where(
                            [
                                ["respondent_id", "=", $userId],
                                ["quiz_question_id", "=", $qArray[0]]
                            ])->update(['answer_type_id' => $value]);
                    }

                    // in case when we have text or text area with a text value
                    if (count($qArray) == 2) {
                        QuizQuestionsResponse::where(
                            [
                                ["respondent_id", "=", $userId],
                                ["quiz_question_id", "=", $qArray[0]]
                            ])->update(['response_text' => $value]);
                    }

                    // in case when we have a grid question
                    if (count($qArray) == 3) {
                        $quizQuestionResponse = QuizQuestionsResponse::where(
                            [
                                ["respondent_id", "=", $userId],
                                ["quiz_question_id", "=", $qArray[0]],
                                ["answer_grid_entry_id", "=", $qArray[1]]
                            ])->first();

                        if ($quizQuestionResponse == null) {
                            self::insertQuestionResponse($value, $key, $userId);
                        } else {
                            QuizQuestionsResponse::where(
                                [
                                    ["respondent_id", "=", $userId],
                                    ["quiz_question_id", "=", $qArray[0]],
                                    ["answer_grid_entry_id", "=", $qArray[1]]
                                ])->update(['answer_type_id' => $value]);
                        }
                    }
                }
            }
        }
    }

    private static function getQuizQuestionsResponseForInsert($question, $response, $respondentId) {
        $quizQuestionsResponse = new QuizQuestionsResponse();

        $qArray = explode('_', $question);

        $quizQuestionsResponse->respondent_id = $respondentId;
        $quizQuestionsResponse->quiz_question_id = $qArray[0];

        if (count($qArray) == 1) {
            $quizQuestionsResponse->answer_type_id = $response;
        }

        if (count($qArray) == 2) {
            $quizQuestionsResponse->response_text = $response;
        }

        if (count($qArray) == 3) {
            $quizQuestionsResponse->answer_type_id = $response;
            $quizQuestionsResponse->answer_grid_entry_id = $qArray[1];;
        }

        return $quizQuestionsResponse;
    }

    /**
     * @param $value
     * @param int $key
     * @param int $userId
     */
    private static function insertQuestionResponse($value, $key, int $userId): void
    {
        if (is_array($value)) {
            foreach ($value as $selected) {
                self::getQuizQuestionsResponseForInsert($key, $selected, $userId)->save();
            }
        } else {
            self::getQuizQuestionsResponseForInsert($key, $value, $userId)->save();
        }
    }
}