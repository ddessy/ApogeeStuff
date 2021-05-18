<?php

namespace App\Calculation;

use App\Models\LearningStyle;
use App\Models\PlayingStyle;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionsAnswersGridEntry;
use App\Models\QuizQuestionsAnswersTypeEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class StyleCalculator
{

    const LEARNING_STYLES = array("VISUAL" => "1", "AUDITORY" => "2", "RW" => "3", "KINESTHETIC" => "4");

    public static function calculate($request): void
    {
        $userId = session()->get('userId');
        self::calculateLearningStyles($request, $userId);
        self::calculatePlayingStyles($request, $userId);
    }

    private static function calculateLearningStyles($request, $userId): void
    {
        $learningStyles = self::getLearningStyles($request);
        self::saveLearningStyles($userId, $learningStyles);
    }

    private static function calculatePlayingStyles($request, $userId): void
    {
        $playingStyles = self::getPlayingStyles($request);
        self::savePlayingStyles($userId, $playingStyles);
    }

    /**
     * @param $request
     * @return array
     */
    private static function getPlayingStyles($request): array
    {
        // TODO: get playing styles from DB
        $playingStyles = array(
            PlayingStyle::PLAYING_STYLES["COMPETITOR"] => 0,
            PlayingStyle::PLAYING_STYLES["DREAMER"] => 0,
            PlayingStyle::PLAYING_STYLES["LOGICIAN"] => 0,
            PlayingStyle::PLAYING_STYLES["STRATEGIST"] => 0);

        // get quiz questions for playing styles
        $quizQuestionsPlayingStyles =
            QuizQuestion
                ::whereIn("q_student_model_property_id", PlayingStyle::PLAYING_STYLES)
                ->get();

        $quizQuestionsIds = array();

        foreach ($quizQuestionsPlayingStyles as $quizQuestion) {
            $quizQuestionsIds[$quizQuestion->id] = $quizQuestion->q_student_model_property_id;
        }

        foreach ($request as $key => $value) {
            if ($key === "_token" || $key === "action" || $key === "quizId") {
                continue;
            }

            if (!is_array($value)) {

                $qArray = explode('_', $key);
                $quiz_question_id = $qArray[0];

                if (count($qArray) == 1 && array_key_exists($quiz_question_id, $quizQuestionsIds)) {
                    // increment playing style
                    $playingStyles[$quizQuestionsIds[$quiz_question_id]] +=
                        QuizQuestionsAnswersTypeEntry::where([["id", "=", $value]])->first()->answer_value;
                }
            }
        }

        // normalization
        foreach ($playingStyles as $styleId => $styleValue) {
            $playingStyles[$styleId] = ($styleValue / (4 * 5)) * 100;
        }

        return $playingStyles;
    }

    /**
     * @param $userId
     * @param array $playingStyles
     */
    private static function savePlayingStyles($userId, array $playingStyles): void
    {
        $needInsert = false;
        $recordForInsert = PlayingStyle::where([['student_id', "=", $userId]])->first();

        if ($recordForInsert == null) {
            $recordForInsert = new PlayingStyle();
            $needInsert = true;
        }

        $recordForInsert->student_id = $userId;

        $recordForInsert->style1_name_id = PlayingStyle::PLAYING_STYLES["COMPETITOR"];
        $recordForInsert->style1_value = $playingStyles[PlayingStyle::PLAYING_STYLES["COMPETITOR"]];

        $recordForInsert->style2_name_id = PlayingStyle::PLAYING_STYLES["DREAMER"];
        $recordForInsert->style2_value = $playingStyles[PlayingStyle::PLAYING_STYLES["DREAMER"]];

        $recordForInsert->style3_name_id = PlayingStyle::PLAYING_STYLES["LOGICIAN"];
        $recordForInsert->style3_value = $playingStyles[PlayingStyle::PLAYING_STYLES["LOGICIAN"]];

        $recordForInsert->style4_name_id = PlayingStyle::PLAYING_STYLES["STRATEGIST"];
        $recordForInsert->style4_value = $playingStyles[PlayingStyle::PLAYING_STYLES["STRATEGIST"]];

        if ($needInsert) {
            $recordForInsert->save();
        } else {
            $recordForInsert->update();
        }
    }

    private static function getLearningStyles($request)
    {
        // TODO: get learning styles from DB
        $learningStyles = array(
            LearningStyle::LEARNING_STYLES["VISUAL"] => 0,
            LearningStyle::LEARNING_STYLES["AUDITORY"] => 0,
            LearningStyle::LEARNING_STYLES["RW"] => 0,
            LearningStyle::LEARNING_STYLES["KINESTHETIC"] => 0);

        // get quiz questions for playing styles
        $gridQuestionsLearningStyles =
            QuizQuestionsAnswersGridEntry
                ::whereIn("entry_student_model_property_id", LearningStyle::LEARNING_STYLES)
                ->get();

        $quizAnswerGridIds = array();

        foreach ($gridQuestionsLearningStyles as $answerGridEntry) {
            $quizAnswerGridIds[self::getAnswerGridIndex($answerGridEntry)] =
                $answerGridEntry->entry_student_model_property_id;
        }

        foreach ($request as $key => $value) {
            if ($key === "_token" || $key === "action" || $key === "quizId") {
                continue;
            }

            if (!is_array($value)) {

                $qArray = explode('_', $key);

                if (count($qArray) > 1) {
                    $answerGridIndex = $qArray[0] . "_" . $qArray[1];

                    if (count($qArray) == 3 && array_key_exists($answerGridIndex, $quizAnswerGridIds)) {
                        // increment playing style
                        $learningStyles[$quizAnswerGridIds[$answerGridIndex]] +=
                            QuizQuestionsAnswersTypeEntry::where([["id", "=", $value]])->first()->answer_value;
                    }
                }
            }
        }

        // normalization
        foreach ($learningStyles as $styleId => $styleValue) {
            $learningStyles[$styleId] = ($styleValue / 16) * 100;
        }

        return $learningStyles;
    }

    private static function saveLearningStyles($userId, $learningStyles): void
    {
        $needInsert = false;
        $recordForInsert = LearningStyle::where([['student_id', "=", $userId]])->first();

        if ($recordForInsert == null) {
            $recordForInsert = new LearningStyle();
            $needInsert = true;
        }

        $recordForInsert->student_id = $userId;

        $recordForInsert->style1_name_id = LearningStyle::LEARNING_STYLES["VISUAL"];
        $recordForInsert->style1_value = $learningStyles[LearningStyle::LEARNING_STYLES["VISUAL"]];

        $recordForInsert->style2_name_id = LearningStyle::LEARNING_STYLES["AUDITORY"];
        $recordForInsert->style2_value = $learningStyles[LearningStyle::LEARNING_STYLES["AUDITORY"]];

        $recordForInsert->style3_name_id = LearningStyle::LEARNING_STYLES["RW"];
        $recordForInsert->style3_value = $learningStyles[LearningStyle::LEARNING_STYLES["RW"]];

        $recordForInsert->style4_name_id = LearningStyle::LEARNING_STYLES["KINESTHETIC"];
        $recordForInsert->style4_value = $learningStyles[LearningStyle::LEARNING_STYLES["KINESTHETIC"]];

        if ($needInsert) {
            $recordForInsert->save();
        } else {
            $recordForInsert->update();
        }
    }

    /**
     * @param $answerGridEntry
     * @return string
     */
    private static function getAnswerGridIndex($answerGridEntry): string
    {
        return $answerGridEntry->quiz_question_id . "_" . $answerGridEntry->id;
    }
}