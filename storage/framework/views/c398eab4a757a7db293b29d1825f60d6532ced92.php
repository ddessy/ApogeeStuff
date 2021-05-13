<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('/js/script.js')); ?>" defer></script>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <ul class="nav">
            <li class="navLi"><a href="#home">Home</a></li>
            <li class="navLi"><a href="#news">News</a></li>
            <li class="navLi"><a href="#contact">Contact</a></li>
            <li class="navLi"><a href="#about">About</a></li>
        </ul>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH /Users/dessivassileva/Projects/php/app/resources/views/layouts/main.blade.php ENDPATH**/ ?>