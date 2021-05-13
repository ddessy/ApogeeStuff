<?php $__env->startSection('content'); ?>
    <div id="quizessbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
            <div class="panel-heading">
                <div class="panel-title">Профил в APOGEE</div>

            </div>

            <div style="padding-top:30px" class="panel-body">

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="profileform" class="form-horizontal" role="form" action="<?php echo e(route('home.editProfile')); ?>"
                      onsubmit="return validateProfileForm();" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="labeltext">Име и фамилия:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="fullname" type="text" class="form-control" name="fullname"
                               value="<?php echo e($user->full_name); ?>" placeholder="Име и фамилия">
                        <span id="error-name" style="font-size: 85%;color: red;"></span>
                    </div>
                    <div class="labeltext">Email:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="profile-username" type="text" class="form-control" name="email"
                               value="<?php echo e($user->email); ?>" placeholder="email">
                        <span id="error-email" style="font-size: 85%;color: red;"></span>
                    </div>
                    <div class="labeltext">Парола:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="profile-password" type="password" class="form-control" name="password"
                               placeholder="Парола">
                        <span id="error-password" style="font-size: 85%;color: red;"></span>
                    </div>
                    <div class="labeltext">Нова парола:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="profile-new-password" type="password" class="form-control" name="new_password"
                               placeholder="Нова парола">
                        <span id="error-new-password" style="font-size: 85%;color: red;"></span>
                    </div>
                    <div class="labeltext">Повторете новата парола:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="profile-password-r" type="password" class="form-control" name="new_password_r"
                               placeholder="Повторете новата парола">
                        <span id="error-password-r" style="font-size: 85%;color: red;"></span>
                    </div>
                    <div class="labeltext">Години:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="age" type="text" class="form-control" name="age" value="<?php echo e($user->age); ?>"
                               placeholder="Години">
                    </div>
                    <div class="labeltext">Пол:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <select id="gender" class="form-control" name="gender" <?php echo e($user->gender); ?>>
                            <option value="1"
                            <?php if($user->gender == 1): ?>
                                selected
                            <?php endif; ?>
                            >Мъж</option>
                            <option value="2"
                            <?php if($user->gender == 2): ?>
                                selected
                            <?php endif; ?>
                            >Жена</option>
                        </select>
                    </div>
                    <div class="labeltext">Успех:</div>
                    <div style="margin-bottom: 25px" class="long-inputs">
                        <input id="grade" type="text" class="form-control" name="grade"
                               value="<?php echo e($user->grade); ?>" placeholder="Успех">
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn" id="profile_user" name="profile_user"
                                style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">
                            Запази
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dessivassileva/Projects/php/apogee/resources/views/profile.blade.php ENDPATH**/ ?>