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
                    include 'QuizRepository.php';
                    include 'QuizUtil.php';

                    $quizRepository = new QuizRepository();
                    $quizUtil = new QuizUtil();
                    
                    $quizResponses = $quizRepository->getUserResponses($_SESSION['id']);

                    $result = $quizRepository->getQuestions();

                    if ($result->num_rows > 0) {
                        while($question = $result->fetch_assoc()) {
                ?>
                    <div class="question">
                        <li><div class="questionContent"><?php echo $question["q_name"]; ?></div></li>

                        <?php

                            $questionType = $quizRepository->getQuestionType($question["q_type_id"])->fetch_assoc();
                            if($questionType["q_type"] == "NUMBER" || $questionType["q_type"] == "WORD" || $questionType["q_type"] == "TEXTAREA") {
                        ?>

                        <input type="<?php $quizUtil->getInputTextType($questionType['q_type'])?>" name="<?php echo $question["id"] . "_text"; ?>"> <?php $question["q_descr"]?>

                        <?php 
                            }

                            if($questionType["q_type"] == "RADIO_BUTTON" || $questionType["q_type"] == "CHECKBOX") {

                                $answers = $quizRepository->getAnswersList($question["id"]);

                                while($answer = $answers->fetch_assoc()) {
                        ?> 

                        <label class="container">
                            <input type="<?php $quizUtil->getInputType($questionType["q_type"]) ?>" 
                                   name="<?php 
                            if ($questionType["q_type"] == "CHECKBOX") {
                                echo $question["id"] . "[]";
                            
                            } else { echo $question["id"]; } ?>" value="<?php echo $answer["id"]; ?>">
                            <?php echo $answer["answer_name"]; ?>
                        </label>

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

                                <td><input type="radio" name="<?php echo $answerGrid["quiz_question_id"] . "_" . $answerGrid["id"] . "_grid"; ?>" value="<?php echo $answer["id"]; ?>"></td>

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
                    <input type="submit" class= "submitButton" value="Submit">
                </div>
            </ol>
        </form>
    </body>
</html>
