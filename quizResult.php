<?php
session_start();
include 'QuizRepository.php';
include 'QuizUtil.php';

$quizRepository = new QuizRepository();
$quizUtil = new QuizUtil();
$sqlQuery = "INSERT INTO quiz_questions_responses(respondent_id, quiz_question_id, response_text, answer_type_id, answer_grid_entry_id) VALUES ";

foreach($_POST as $key => $value) {
    if (is_array($value)) {
        foreach($_POST[$key] as $selected){
            $sqlQuery .= $quizUtil->getInsertQueryForResponses($key, $selected, $_SESSION["id"]);
        }
    } else {
        $sqlQuery .= $quizUtil->getInsertQueryForResponses($key, $value, $_SESSION["id"]);
    }
};

$sqlQuery .= ";";
$sqlQuery = str_replace(", ;", ";", $sqlQuery);

$quizRepository->insertQuizResponses($sqlQuery);

header('location: resultQuizPage.php');

?>