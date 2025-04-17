<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <h2>Список бронирований</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Мастер</th>
                <th>Услуга</th>
                <th>Дата и время</th>
                <th>Имя клиента</th>
                <th>Телефон клиента</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($booking->master->name); ?></td>
                <td><?php echo e($booking->service->name); ?></td>
                <td><?php echo e($booking->booking_date); ?></td>
                <td><?php echo e($booking->client_name); ?></td>
                <td><?php echo e($booking->client_phone); ?></td>
                <td>
                    <form action="<?php echo e(route('bookings.destroy', $booking)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\test\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>