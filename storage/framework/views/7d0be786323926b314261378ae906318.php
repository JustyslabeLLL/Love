<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Добро пожаловать в админ-панель!</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Мастера</h5>
                    <p class="card-text">Количество мастеров: <?php echo e($mastersCount); ?></p>
                    <a href="<?php echo e(route('masters.index')); ?>" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Услуги</h5>
                    <p class="card-text">Количество услуг: <?php echo e($servicesCount); ?></p>
                    <a href="<?php echo e(route('services.index')); ?>" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Бронирования</h5>
                    <p class="card-text">Количество бронирований: <?php echo e($bookingsCount); ?></p>
                    <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\test\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>