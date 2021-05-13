<?php $__env->startSection('content'); ?>
<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
        <div class="panel-heading">
            <div class="panel-title">Вход в APOGEE</div>

        </div>

        <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form id="loginform" class="form-horizontal" role="form" action="/login" method="POST">
                <?php echo csrf_field(); ?>
                <div id="login-error" style="font-size: 85%;color: red; padding-bottom: 10px;margin-top: -10px;">
                    <?php if(session()->get('login') != null): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e(session()->get('login')); ?></strong>
                    </span>
                    <?php endif; ?>

                    <?php
                        session(['login' => null]);
                    ?>
                </div>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="email">
                </div>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="парола">
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" id="reg_user" name="reg_user"
                            style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">
                        вход
                    </button>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px;" >
                            Нямаш профил в APOGEE?
                            <a href="<?php echo e(route('home.showRegistration')); ?>">Регистрирай се тук</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dessivassileva/Projects/php/apogee/quiz2/resources/views/login.blade.php ENDPATH**/ ?>