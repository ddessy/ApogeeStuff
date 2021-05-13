<?php $__env->startSection('content'); ?>
<div id="signupbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
        <div class="panel-heading">
            <div class="panel-title">Регистрация в APOGEE</div>

        </div>

        <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form id="registrationform" class="form-horizontal" role="form" action="<?php echo e(route('home.doRegistration')); ?>" onsubmit="return validateForm();"  method="POST">
                <?php echo csrf_field(); ?>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="fullname" type="text" class="form-control" name="fullname" placeholder="Име и фамилия">
                    <span id="error-name" style="font-size: 85%;color: red;"></span>
                </div>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="reg-username" type="text" class="form-control" name="email" placeholder="email">
                    <span id="error-email" style="font-size: 85%;color: red;"></span>
                </div>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="reg-password" type="password" class="form-control" name="password" placeholder="парола">
                    <span id="error-password" style="font-size: 85%;color: red;"></span>
                </div>
                <div style="margin-bottom: 25px" class="inputs">
                    <input id="reg-password-r" type="password" class="form-control" name="password_r" placeholder="повтори парола">
                    <span id="error-password-r" style="font-size: 85%;color: red;"></span>
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" id="reg_user" name="reg_user" style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">Регистрация</button>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px;" >
                            Имаш профил в APOGEE?
                            <a href="<?php echo e(route('home.showLogin')); ?>">Вход</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/apogeeon/public_html/apogee/resources/views/registration.blade.php ENDPATH**/ ?>