<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">Админка</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('masters.index')); ?>">Мастера</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('services.index')); ?>">Услуги</a>
                    </li>
                </ul>
                    <?php echo csrf_field(); ?>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">Выйти</button>
                    </form>

                    <!-- Отображение сообщений (если нужно) -->
                    
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php /**PATH C:\OSPanel\domains\test\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>