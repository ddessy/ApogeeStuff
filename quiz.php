<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>


        <form action="quizResult.php" method="post" style="margin: auto;max-width: 90vw;width: 640px;">
            <div class="question">
                QUIZ PAGE
            </div>
            <ol>
                <div class="questionsContainer">

                <?php
                    include 'repositories/QuizRepository.php';
                    include 'QuizUtil.php';

                    $quizRepository = new QuizRepository();
                    $quizUtil = new QuizUtil();

                    $quizResponses = $quizRepository->getUserResponses($_SESSION['id']);
                    $responsesMap = [];

                    if ($quizResponses->num_rows > 0) {

                      while($response = $quizResponses->fetch_assoc()) {
                        if (!empty($response['response_text'])) {
                          $responsesMap[$response['quiz_question_id']] = $response['response_text'];
                        } else if (!empty($response['answer_grid_entry_id'])) {
                          $responsesMap[$response['quiz_question_id'] . "_" . $response['answer_grid_entry_id']] = $response['answer_type_id'];
                        } else if (empty($response['response_text']) && empty($response['answer_grid_entry_id'])) {
                          $responseRadioCheckbox = $responsesMap[$response['quiz_question_id']];
                          if (empty($responsesMap[$response['quiz_question_id']])) {
                              $responsesMap[$response['quiz_question_id']] = $response['answer_type_id'];
                          } else if (is_array($responsesMap[$response['quiz_question_id']])) {
                              array_push($responsesMap[$response['quiz_question_id']], $response['answer_type_id']);
                          } else {
                              $responsesMap[$response['quiz_question_id']] = array($responsesMap[$response['quiz_question_id']], $response['answer_type_id']);
                          }
                        }
                      }
                    }

                    $questions = $quizRepository->getQuestions();

                    if ($questions->num_rows > 0) {
                        while($question = $questions->fetch_assoc()) {
                ?>
                    <div class="question">
                        <li><div class="questionContent"><?php echo $question["q_name"]; ?></div></li>

                        <?php

                            $questionType = $quizRepository->getQuestionType($question["q_type_id"])->fetch_assoc();
                            if($questionType["q_type"] == "NUMBER" || $questionType["q_type"] == "WORD" || $questionType["q_type"] == "TEXTAREA") {
                        ?>

                        <input type="<?php $quizUtil->getInputTextType($questionType['q_type'])?>"
                               name="<?php echo $question["id"] . "_text"; ?>"
                               value="<?php echo $responsesMap[$question["id"]]; ?>"> <?php $question["q_descr"]?>

                        <?php
                            }

                            if($questionType["q_type"] == "RADIO_BUTTON" || $questionType["q_type"] == "CHECKBOX") {

                                $answers = $quizRepository->getAnswersList($question["id"]);

                                while($answer = $answers->fetch_assoc()) {
                        ?>

                        [<label class="container">
                            <input type="<?php $quizUtil->getInputType($questionType["q_type"]) ?>"
                                   name="<?php
                            if ($questionType["q_type"] == "CHECKBOX") {
                                echo $question["id"] . "[]";

                            } else { echo $question["id"]; } ?>" value="<?php echo $answer["id"]; ?>"
                                <?php if ($responsesMap[$question["id"]] === $answer["id"]
                                    || (is_array($responsesMap[$question["id"]]) && in_array($answer["id"], $responsesMap[$question["id"]]))) {
                                  echo "checked";
                                }?> >
                            <?php echo $answer["answer_name"]; ?>
                        </label>]

                        <?php
                                }
                            }
                        ?>

                        <br>

                        <?php
                            if($questionType["q_type"] == "GRID") {
                        ?>

                        <table>
                            <tr>
                                <td></td>

                                <?php

                                $answers = $quizRepository->getAnswersList($question["id"]);

                                while($answer = $answers->fetch_assoc()) {
                                ?>

                                <td><?php echo $answer["answer_name"]; ?></td>

                                <?php } ?>
                            </tr>

                            <?php

                                $answersGrid = $quizRepository->getAnswersGrid($question["id"]);

                                while($answerGrid = $answersGrid->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $answerGrid["answer_grid_entry_name"] ?></td>

                                <?php

                                $answers = $quizRepository->getAnswersList($question["id"]);
                                while($answer = $answers->fetch_assoc()) {
                                ?>

                                <td><input type="radio"
                                           name="<?php echo $answerGrid["quiz_question_id"] . "_" . $answerGrid["id"] . "_grid"; ?>"
                                           value="<?php echo $answer["id"]; ?>"
                                        <?php if ($responsesMap[$answerGrid["quiz_question_id"] . "_" . $answerGrid["id"]] === $answer["id"]) {
                                            echo "checked";
                                        }?>></td>

                                <?php } ?>
                            </tr>

                            <?php } ?>

                        </table>

                        <?php } ?>
                    </div>

                <?php
                        }
                    }
                ?>
                    <br>
                    <input type="hidden" name="action" value="<?php if ($quizResponses->num_rows > 0) { echo "update"; } else { echo "insert" ;} ?>">
                    <input type="submit" class= "submitButton" value="Submit">
                </div>
            </ol>
        </form>
    </body>
</html>
