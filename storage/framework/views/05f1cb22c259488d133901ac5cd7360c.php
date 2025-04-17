<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прайс-лист</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <style>
        body, .col, .row {
            margin: 0;
            padding: 0;
        }

        /* Шапка с висячим бургером */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: transparent; /* Прозрачный фон */
            padding: 10px;
        }

        .navbar-toggler {
            border: none;
            background-color: transparent;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 0, 0, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .offcanvas {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .offcanvas-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .offcanvas-title {
            color: #000;
        }

        .offcanvas-body .nav-link {
            color: #000 !important;
        }
    </style>
</head>
<body>
    <!-- Шапка -->
    <nav class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>">Главное</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('price-list')); ?>">Прайс-лист</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('bookings.create')); ?>">Записаться</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('create')); ?>">Зарегистрироваться</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('authorization')); ?>">Войти</a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('price-list')); ?>">Прайс-лист</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('bookings.create')); ?>">Записаться</a>
                            </li>
                            <li class="nav-item">
                                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-link">Выйти</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <?php echo $__env->yieldContent('content'); ?>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php /**PATH C:\OSPanel\domains\test\resources\views/layouts/header.blade.php ENDPATH**/ ?>