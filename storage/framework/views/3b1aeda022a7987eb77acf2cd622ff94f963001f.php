<?php $__env->startSection('content'); ?>
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Анкети</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <?php if(session()->get('message') != null): ?>
                <span style="color: green;">
                    <strong><?php echo e(session()->get('message')); ?></strong>
                </span> <br><br>
                <?php endif; ?>

                <?php
                    session(['message' => null]);
                ?>

                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="list-quizzes"><a href="<?php echo e(route('quiz.showQuiz', $quiz->id)); ?>" ><?php echo e($quiz->quiz_name); ?></a></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dessivassileva/Projects/php/apogee/resources/views/quizzes.blade.php ENDPATH**/ ?>