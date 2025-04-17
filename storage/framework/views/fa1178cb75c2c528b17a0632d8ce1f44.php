<!DOCTYPE html>
<html>
<head>
    <title>Вход в систему</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .button button {
        background-color: #CBA9A9;
    }

    .form {
        width: 80%;
        padding-top: 200px;
        margin: auto;
    }
</style>
<body>
    
    <?php $__env->startSection('content'); ?>

    <div class="container mt-5">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <a href="<?php echo e(url('/')); ?>" class="btn btn-secondary mb-3">На главную</a>
        <form action="<?php echo e(route('authorization')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center button">
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-block btn-lg gradient-custom-4 text-body">Авторизоваться</button>
            </div>
        </form>
    </div>

    <?php $__env->stopSection(); ?>
</body>
</html>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\test\resources\views/auth/authorization.blade.php ENDPATH**/ ?>