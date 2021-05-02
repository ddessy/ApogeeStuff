<?php

include 'repositories/BaseRepository.php';

class QuizRepository extends BaseRepository
{

    public function getQuestions()
    {

        $sql = "SELECT * FROM quiz_questions ORDER BY quiz_id";
        return QuizRepository::getConnection()->query($sql);
    }

    public function getQuestionType($questionTypeId)
    {

        $sql = "SELECT * FROM question_types WHERE id = " . $questionTypeId;
        return QuizRepository::getConnection()->query($sql);
    }

    public function getAnswersList($questionId)
    {

        $sql = "SELECT * FROM quiz_questions_answers_type_entries 
                WHERE quiz_questions_answers_type_id IN 
                      (SELECT quiz_questions_answers_type_id FROM quiz.quiz_questions_answers where quiz_question_id = " . $questionId . ") ";

        return QuizRepository::getConnection()->query($sql);
    }

    public function getAnswersGrid($questionId)
    {

        $sql = "SELECT * FROM quiz_questions_answers_grid_entries
                WHERE quiz_question_id = " . $questionId;

        return QuizRepository::getConnection()->query($sql);
    }

    public function saveQuizResponses($sqlQuery)
    {
        if (!empty($sqlQuery["update"]) || !empty($sqlQuery["delete"]) || !empty($sqlQuery["insert"])) {

            QuizRepository::getConnection()->query($sqlQuery["update"]);
            QuizRepository::getConnection()->query($sqlQuery["delete"]);
            QuizRepository::getConnection()->query($sqlQuery["insert"]);

        } else {
            QuizRepository::getConnection()->query($sqlQuery);
        }

        QuizRepository::getConnection()->commit();
    }

    public function getUserResponses($userId)
    {

        $sql = "SELECT * FROM quiz_questions_responses
                WHERE respondent_id = " . $userId . " order by quiz_question_id";

        return QuizRepository::getConnection()->query($sql);
    }
}

?>