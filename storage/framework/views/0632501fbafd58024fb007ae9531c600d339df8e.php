<?php $__env->startSection('content'); ?>
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title"><?php echo e($quiz->quiz_name); ?></div>

            </div>
            <div style="padding-top:30px" class="panel-body" >
                <p style="text-align: justify;"><?php echo e($quiz->quiz_descr); ?></p>
                <br>
                <form action="<?php echo e(route('quiz.doQuiz')); ?>" method="POST" style="margin: auto;max-width: 90vw;width: 640px;">
                <?php echo csrf_field(); ?>
                    <ol>
                        <?php $__currentLoopData = $quizQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="question">
                                <li>
                                    <div class="questionContent"><?php echo e($question->q_name); ?></div>
                                </li>
                                <?php
                                    $questionType = \App\Http\Controllers\QuizController::getQuestionType($question->q_type_id);
                                ?>

                                <?php if($questionType == "NUMBER" || $questionType == "WORD" || $questionType == "TEXTAREA"): ?>

                                    <input type="<?php echo e(App\Util\QuizUtil::getInputTextType($questionType)); ?>"
                                       name="<?php echo e($question->id); ?>_text"
                                       value="<?php echo e($responsesMap[$question->id] ?? ''); ?>" <?php echo e($question->q_descr); ?>>
                                <?php endif; ?>

                                <?php if($questionType == "RADIO_BUTTON" || $questionType == "CHECKBOX"): ?>

                                    <?php
                                        $answers = \App\Http\Controllers\QuizController::getAnswersList($question->id);
                                    ?>

                                    <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <label class="container">
                                            <input type="<?php echo e(App\Util\QuizUtil::getInputType($questionType)); ?>"
                                                   name="<?php echo e($questionType == "CHECKBOX"
                                                                             ? $question->id . "[]"
                                                                             : $question->id); ?>"
                                                   value="<?php echo e($answer->id); ?>"
                                                   <?php echo e(App\Util\QuizUtil::isChecked($responsesMap, $question->id, $answer->id) ? "checked" : ""); ?>>
                                                   <?php echo e($answer->answer_name); ?>

                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if($questionType == "GRID"): ?>
                                    <?php
                                        $answers = \App\Http\Controllers\QuizController::getAnswersList($question->id);
                                    ?>

                                    <table>
                                        <tr>
                                            <td></td>
                                            <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td> <?php echo e($answer->answer_name); ?></td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>

                                        <?php
                                            $answersGrid = \App\Http\Controllers\QuizController::getAnswersGrid($question->id);
                                        ?>

                                        <?php $__currentLoopData = $answersGrid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answerGrid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><span class="questionContent"><?php echo e($answerGrid->answer_grid_entry_name); ?></span></td>

                                                <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td><input type="radio"
                                                           name="<?php echo e($answerGrid->quiz_question_id); ?>_<?php echo e($answerGrid->id); ?>_grid"
                                                           value="<?php echo e($answer->id); ?>"
                                                               <?php if(($responsesMap != null)
                                                                    && array_key_exists($answerGrid->quiz_question_id . "_" . $answerGrid->id, $responsesMap)
                                                                    && ($responsesMap[$answerGrid->quiz_question_id . "_" . $answerGrid->id] === $answer->id) ): ?>
                                                            checked
                                                    <?php endif; ?>>
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>

                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <br>
                    <input type="hidden" name="quizId" value="<?php echo e($quiz->id); ?>">
                    <input type="hidden" name="action" value="<?php echo e($action); ?>">
                    <a class="btn btn-default btn-close" href="<?php echo e(route('quiz.listQuizzes')); ?>">Cancel</a>
                    <input type="submit" class="btn btn-default btn-close" value="Submit">
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dessivassileva/Projects/php/app/resources/views/quiz.blade.php ENDPATH**/ ?>