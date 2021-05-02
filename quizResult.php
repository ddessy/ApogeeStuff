<?php
session_start();
include 'repositories/QuizRepository.php';
include 'QuizUtil.php';

$quizRepository = new QuizRepository();
$quizUtil = new QuizUtil();

$sqlQuery = ($_POST["action"] === "insert")
    ? $quizUtil->getAllInsertQueriesForResponses($_POST, $_SESSION["id"])
    : $quizUtil->getAllUpdateQueriesForResponses($_POST, $_SESSION["id"]);

$quizRepository->saveQuizResponses($sqlQuery);

header('location: resultQuizFinalPage.php');

?>