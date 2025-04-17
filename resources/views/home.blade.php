<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
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
            background-color: rgba(255, 255, 255, 0.9); /* Прозрачный бургер */
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

        /* Название посередине блока */
        .main_title {
            text-align: center;
            margin-top: 80px; /* Отступ сверху, чтобы не перекрывалось шапкой */
            font-size: 2.5rem;
            color: #000;
        }

        /* Остальные стили */
        .main_left {
            background-color: #CBA9A9;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main_content {
            margin-left: 5%;
            width: 90%;
            text-align: center;
        }

        .main_content h1 {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
            text-align: center;

        }

        .main_content p {
            font-size: 2rem;
            color: white;
            text-align: justify;
        }

        .main_content button {
            position: relative;
            width: 180px;
            height: 40px;
            border: none;
            background-color: #CBA9A9;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin: 0 auto;
        }

        .main_content button::before,
        .main_content button::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: white;
            transition: transform 0.3s ease;
        }

        .main_content button::before {
            top: 0;
            left: 0;
            transform-origin: left;
        }

        .main_content button::after {
            bottom: 0;
            right: 0;
            transform-origin: right;
        }

        .main_content button:hover::before {
            transform: scaleX(0);
        }

        .main_content button:hover::after {
            transform: scaleX(0);
        }

        .main_content a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }

        #main_background {
            height: 100vh;
            overflow: hidden;
        }

        #main_background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Контейнер для бегущей строки */
        .marquee-container {
            overflow: hidden; /* Скрываем содержимое, выходящее за пределы */
            white-space: nowrap; /* Запрещаем перенос строк */
            border-top: 1px solid #000; /* Верхняя граница */
            border-bottom: 1px solid #000; /* Нижняя граница */
            padding: 10px 0; /* Отступы сверху и снизу */
            background-color: #f8f9fa; /* Цвет фона */
        }

        /* Внутренний блок с анимацией */
        .runstroke_content {
            display: inline-block;
            padding-left: 100%; /* Начальная позиция за пределами экрана */
            animation: marquee 20s linear infinite; /* Анимация бегущей строки (20 секунд) */
        }

        /* Стили для изображений */
        .runstroke_content img {
            margin-right: 50px; /* Отступ между изображениями */
            height: 50px; /* Высота изображений */
            width: auto; /* Ширина автоматически подстраивается */
        }

        /* Анимация для бегущей строки (слева направо) */
        @keyframes marquee {
            0% {
                transform: translateX(0%); /* Начальная позиция (контент виден) */
            }
            100% {
                transform: translateX(-100%); /* Конечная позиция (контент уходит влево) */
            }
        }

        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .runstroke_content img {
                margin-right: 30px; /* Уменьшаем отступ на мобильных устройствах */
                height: 40px; /* Уменьшаем высоту изображений */
            }
        }

        @media (max-width: 576px) {
            .runstroke_content img {
                margin-right: 20px; /* Еще меньше отступ на маленьких экранах */
                height: 30px; /* Еще меньше высота изображений */
            }
        }

        .info_block_right {
            padding-left: 100px;
        }

        .info_block_right p {
            font-size: 1.1rem;
        }

        .text_info_block_right h3 {
            margin: auto;
        }

        .text_info_block_right {
            width: 80%;
            display: flex;
            justify-content: center;
            margin: auto;
        }

        .text_info_block_right p {
            margin-top: 40px;
            font-size: 1.2rem;
            text-align: justify;
        }

        .services h3, .feedback h3, .gallery h3 {
            margin-top: 100px;
            margin-bottom: 50px;
            margin-left: 20px;
        }

        .service {
            margin-bottom: 20px;
            width: 100%; /* Адаптивная ширина */
            height: auto; /* Адаптивная высота */
            object-fit: cover; /* Сохраняет пропорции изображения */
        }

        .services a {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .services_row {
            margin: 0 auto; /* Центрируем блоки */
            max-width: 100%; /* Ограничиваем максимальную ширину контейнера */
            padding: 0 20px; /* Добавляем отступы слева и справа */
        }

        .serv_img {
            padding: 10px; /* Отступы вокруг каждого элемента */
        }

        .serv_img img {
            width: 100%; /* Чтобы изображение занимало всю ширину контейнера */
            height: auto; /* Сохраняем пропорции изображения */
            border-radius: 8px; /* Закругленные углы */
        }

        .registration {
            background-color: #CBA9A9;
            margin-top: 100px;
        }

        .registration h3 {
            padding-top: 50px;
            margin-left: 20px;
        }

        .feedback .carousel-item {
            padding: 20px;
            text-align: center;
        }

        .feedback .card {
            margin: 0 10px;
        }

        .feedback .card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .feedback .stars {
            color: gold;
            font-size: 1.2rem;
        }

        .gal {
            border: 1px solid black;
        }

        .gallery-image {
            width: 100%; /* Адаптивная ширина */
            height: auto; /* Адаптивная высота */
            object-fit: cover; /* Сохраняет пропорции изображения */
        }

        /* Добавляем анимацию для изображений */
        .gallery-image, .service {
            transition: transform 0.3s ease; /* Плавное изменение за 0.3 секунды */
        }

        /* Анимация при наведении */
        .gallery-image:hover, .service:hover {
            transform: scale(1.03);
        }

        /* Адаптация для мобильных устройств */
        @media (max-width: 768px) {
            .main_title {
                font-size: 2rem;
            }

            .main_content h1 {
                font-size: 2rem;
            }

            .main_content p {
                font-size: 1rem;
            }

            .info_block_right h3 {
                padding-top: 10px;
            }

            .info_block_right p {
                font-size: 0.1rem;
            }

            .services h3, .feedback h3, .gallery h3 {
                margin-top: 30px;
                margin-left: 10px;
            }

            .registration h3 {
                padding-top: 30px;
                margin-left: 10px;
            }

            .service {
                width: 100%; /* На мобильных устройствах блоки занимают всю ширину */
            }
        }

        @media (max-width: 576px) {
            .main_title {
                font-size: 1.5rem;
            }

            .main_content h1 {
                font-size: 1.5rem;
            }

            .main_content p {
                font-size: 0.9rem;
            }

            .info_block_right h3 {
                padding-top: 5px;
            }

            .info_block_right p {
                font-size: 0.9rem;
            }

            .services h3, .feedback h3, .gallery h3 {
                margin-top: 20px;
                margin-left: 5px;
            }

            .registration h3 {
                padding-top: 20px;
                margin-left: 5px;
            }

            .service {
                width: 100%; /* На мобильных устройствах блоки занимают всю ширину */
            }
        }

        /* Стили для левой части (карусель) */
        .info_block_left {
            height: 100vh; /* Высота на весь экран */
            display: flex; /* Для центрирования содержимого */
            align-items: center; /* Вертикальное центрирование */
            justify-content: center; /* Горизонтальное центрирование */
            background-color: #f8f9fa; /* Фоновый цвет (можно изменить) */
        }

        /* Стили для карусели */
        #carouselExampleCaptions {
            width: 100%; /* Ширина на всю доступную область */
            height: 100%; /* Высота на всю доступную область */
            overflow: hidden; /* Скрываем содержимое, выходящее за пределы */
        }

        /* Стили для изображений в карусели */
        .carousel-item img {
            height: 100vh; /* Высота изображений на весь экран */
            object-fit: cover; /* Сохраняем пропорции изображения */
        }

        .carousel-item {
            display: flex; /* Для центрирования содержимого */
            align-items: center; /* Вертикальное центрирование */
            justify-content: center; /* Горизонтальное центрирование */
            margin: 0;
        }

        /* Стили для текстовых подписей */
        .carousel-caption {
            background: rgba(0, 0, 0, 0.5); /* Полупрозрачный фон для текста */
            padding: 20px;
            bottom: 20px; /* Отступ снизу */
        }

        .carousel-caption h5 {
            font-size: 1.5rem; /* Размер заголовка */
            font-weight: bold; /* Жирный шрифт */
            margin-bottom: 10px; /* Отступ снизу */
        }

        .carousel-caption p {
            font-size: 1rem; /* Размер текста */
            margin-bottom: 0; /* Убираем отступ снизу */
        }

        /* Стили для индикаторов */
        .carousel-indicators {
            bottom: 20px; /* Позиция индикаторов */
        }

        .carousel-indicators button {
            width: 10px; /* Ширина индикатора */
            height: 10px; /* Высота индикатора */
            border-radius: 50%; /* Круглая форма */
            background-color: rgba(255, 255, 255, 0.5); /* Полупрозрачный фон */
            border: none; /* Убираем границу */
            margin: 0 5px; /* Отступ между индикаторами */
        }

        .carousel-indicators .active {
            background-color: #fff; /* Активный индикатор */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1); /* Инвертируем цвет иконок (белые) */
        }

        /* Стили для подвала */
        .footer {
            background-color: #f8f9fa; /* Цвет фона */
            font-family: Arial, sans-serif; /* Шрифт */
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 0;
            padding: 0;
        }

        .footer-section {
            flex: 1;
            min-width: 100px;
            margin-top: 100px;
            margin-left: 40px;
        }

        .footer-section h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #333; /* Цвет заголовков */
        }

        .footer-section p {
            font-size: 1rem;
            color: #666; /* Цвет текста */
            margin: 5px 0;
        }

        .footer-map {
            /* width: 100%;
            margin-bottom: 20px; */
            width: 800px;
            margin: 0;
            padding: 0;
        }

        .footer-map iframe {
            width: 100%; /* Ширина на всю доступную область */
            height: auto; /* Автоматическая высота */
            aspect-ratio: 16 / 9; /* Соотношение сторон (можно изменить) */
            margin: 0;
            padding: 0;
        }

        .centered-caption {
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>

</head>
<body>
    <div class="container-fluid p-0">
        @extends('layouts.header')
        <!-- Шапка -->
        {{-- <nav class="navbar">
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
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('price-list') }}">Прайс-лист</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bookings.create') }}">Записаться</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('create') }}">Зарегистрироваться</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('authorization') }}">Войти</a>
                                </li>
                            @endguest

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('price-list') }}">Прайс-лист</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bookings.create') }}">Записаться</a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link">Выйти</button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav> --}}

        <!-- Главный экран -->
@section('content')
        <div class="main p-0">
            <div class="row">
                <!-- Левая сторона -->
                <div class="col-md-6 main_left">
                    <div class="container-fluid">
                        <div class="main_content">
                            <h1>С Т У Д И Я &ensp; К Р А С О Т Ы</h1>
                            <p>
                                «Love» – это современный салон красоты, созданный для тех, кто ценит уход за собой и стремится к совершенству.
                            </p>
                            <button>
                                <a href="{{ route('bookings.create') }}">Записаться</a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Правая сторона -->
                <div class="col-md-6 p-0" id="main_background">
                    <img src="/images/main.png" alt="">
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <!-- Бегущая строка -->
            <div class="marquee-container">
                <div class="runstroke_content">
                    <!-- Первый набор изображений -->
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <!-- Второй набор изображений (дубликат первого) -->
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                    <img src="/images/run_stroke1.svg" alt="Заглушка">
                    <img src="/images/run_stroke2.svg" alt="Заглушка">
                </div>
            </div>
        </div>

        <!-- Информационный блок -->
        <div class="container-fluid p-0">
            <div class="info_block p-0">
                <div class="row">
                    <div class="col-md-6 info_block_left p-0">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                            {{-- <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div> --}}
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/test.png" class="img-fluid d-block w-100" alt="Заглушка">
                                    <div class="carousel-caption d-none d-md-block centered-caption">
                                        <h5>First slide label</h5>
                                        <p>Some representative placeholder content for the first slide.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="images/test.png" class="img-fluid d-block w-100" alt="Заглушка">
                                    <div class="carousel-caption d-none d-md-block centered-caption">
                                        <h5>Second slide label</h5>
                                        <p>Some representative placeholder content for the second slide.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="images/test.png" class="img-fluid d-block w-100" alt="Заглушка">
                                    <div class="carousel-caption d-none d-md-block centered-caption">
                                        <h5>Third slide label</h5>
                                        <p>Some representative placeholder content for the third slide.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button> --}}
                        </div>
                    </div>
                    <div class="col-md-6 info_block_right">
                        {{-- <h3>/ О нас</h3> --}}
                        <div class="text_info_block_right">
                            <p>
                                Салон расположен в шаговой доступности от станции метро «Парк Культуры», наш салон красоты «Love» стал местом, где каждая деталь создана для вашего комфорта и красоты. С момента открытия 1 декабря 2016 года мы стремимся подарить нашим гостям не только безупречный сервис, но и атмосферу заботы и уюта.
                                <br>                                <br>
                                «Love» — это современный салон, где сочетаются передовые технологии, высококачественные материалы и индивидуальный подход к каждому клиенту. Мы предлагаем широкий спектр услуг: от стрижек и окрашивания до ухода за кожей и ногтями. Наши мастера — настоящие профессионалы своего дела, которые всегда в курсе последних трендов и готовы воплотить в жизнь любые ваши пожелания.
                                <br>                                <br>
                                Мы гордимся тем, что создаем не просто красоту, а гармонию вашего образа. Приходите в салон «Love», чтобы почувствовать себя особенными и насладиться моментом заботы о себе.
                                <br>                                <br>
                                Ваша красота — наша любовь! 💖
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid p-0">
            <div class="services">
                <h3>/ Услуги</h3>
                <div class="row services_row p-0">
                    <!-- Услуги -->
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                    <a href="" class="serv_img col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/test.png" class="rounded img-fluid">
                    </a>
                </div>
            </div>
        </div>

        <!-- Блок с отзывами -->
        <div class="container-fluid p-0 feedback">
            <h3>/ Отзывы</h3>
            <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Иван Иванов</h5>
                                        <p class="card-text">Отличный сервис, всем рекомендую!</p>
                                        <div class="stars">
                                            ★★★★★
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Мария Петрова</h5>
                                        <p class="card-text">Очень довольна результатом!</p>
                                        <div class="stars">
                                            ★★★★☆
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Алексей Смирнов</h5>
                                        <p class="card-text">Все было сделано быстро и качественно.</p>
                                        <div class="stars">
                                            ★★★★★
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Елена Кузнецова</h5>
                                        <p class="card-text">Спасибо за отличную работу!</p>
                                        <div class="stars">
                                            ★★★★☆
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Дмитрий Васильев</h5>
                                        <p class="card-text">Очень профессионально!</p>
                                        <div class="stars">
                                            ★★★★★
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Аватарка">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Ольга Новикова</h5>
                                        <p class="card-text">Все понравилось, буду рекомендовать!</p>
                                        <div class="stars">
                                            ★★★★☆
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Блок с галереей (безграничная) -->
        <div class="container-fluid p-0 gallery">
            <h3>/ Галерея</h3>
            <div class="row g-0"> <!-- Убираем отступы между колонками -->
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
                <div class="gal col-md-3 col-sm-6 col-12 p-0">
                    <img src="images/test.png" class="img-fluid gallery-image">
                </div>
            </div>
        </div>

        <footer class="footer container-fluid p-0 m-0">
            <div class="container-fluid p-0 m-0">
                {{-- <div class="row">
                    <img src="/images/run_stroke1.svg">
                </div> --}}
                <div class="row">
                    <div class="footer-content">
                        <div class="footer-section">
                            <h4>О НАС</h4>
                            <h4>РАБОТЫ</h4>
                            <h4>ОТЗЫВЫ</h4>
                            <h4>ЗАПИСАТЬСЯ</h4>
                            <h4>КОНТАКТЫ</h4>
                        </div>
                        <div class="footer-section">
                            <h4>МАНИКЮР</h4>
                            <h4>ПЕДИКЮР</h4>
                            <h4>НОГТИ</h4>
                            <h4>СТРИЖКИ</h4>
                        </div>
                        <div class="footer-section">
                            <h4>БРОВИ</h4>
                            <h4>РЕСНИЦЫ</h4>
                            <h4>ЭПИЛИЦИЯ</h4>
                            <h4>ДЕПИЛИЦИЯ</h4>
                        </div>
                        <div class="footer-section">
                            <h4>Номер телефона:</h4>
                            <p>+7 (929) 656-06-17</p>
                            <div class="address">
                                <h4>Адрес:</h4>
                                <p>г. Москва, Зубовский бул.,<br>an1@d, подъезд 1 этаж 3</p>
                            </div>
                        </div>
                        <div class="footer-map">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3554fcb880a752b84e5b3ab7088124b8e00c459e2042508c5483d4da003910d7&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
@endsection
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
