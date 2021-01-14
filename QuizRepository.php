<?php

class QuizRepository {

    private function getConnection() {

        DEFINE ('DB_USER', 'root');
        DEFINE ('DB_PASSWORD', 'root');
        DEFINE ('DB_HOST', '127.0.0.1:33077');
        DEFINE ('DB_NAME', 'quiz');

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(!$dbc){
            die('error connecting to database');
        }

        return $dbc;
    }

    public function getQuestions() {

        $sql = "SELECT * FROM quiz_questions ORDER BY quiz_id";
        return QuizRepository::getConnection()->query($sql);
    }

    public function getQuestionType($questionTypeId) {

        $sql = "SELECT * FROM question_types WHERE id = " . $questionTypeId;
        return QuizRepository::getConnection()->query($sql);
    }

    public function getAnswersList($questionId) {

        $sql = "SELECT * FROM quiz_questions_answers_type_entries 
                WHERE quiz_questions_answers_type_id IN 
                      (SELECT quiz_questions_answers_type_id FROM quiz.quiz_questions_answers where quiz_question_id = " . $questionId . ") ";

        return QuizRepository::getConnection()->query($sql);
    }

    public function getAnswersGrid($questionId) {

        $sql = "SELECT * FROM quiz_questions_answers_grid_entries
                WHERE quiz_question_id = " . $questionId;

        return QuizRepository::getConnection()->query($sql);
    }

    public function insertQuizResponses($sqlQuery) {
        QuizRepository::getConnection()->query($sqlQuery);
        QuizRepository::getConnection()->commit();
    }

    public function getUserResponses($userId) {

        $sql = "SELECT * FROM quiz_questions_responses
                WHERE respondent_id = " . $userId;

        return QuizRepository::getConnection()->query($sql);
    }
}

?>