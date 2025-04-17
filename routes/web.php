<?php

use App\Models\Master;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\BookingController as ClientBookingController;

// Главная страница
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Маршруты для гостей (неавторизованных пользователей)
Route::middleware(['guest'])->group(function () {
    Route::get('/registration', [RegisterController::class, 'create'])->name('create');
    Route::post('/registration', [RegisterController::class, 'store'])->name('store');
    Route::get('/authorization', [RegisterController::class, 'authorization'])->name('authorization');
    Route::post('/authorization', [RegisterController::class, 'login'])->name('login');
});

// Маршруты для авторизованных пользователей
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
});

// Админ-панель
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Главная страница админ-панели
    Route::get('/', function () {
        $mastersCount = Master::count();
        $servicesCount = Service::count();
        $bookingsCount = Booking::count();

        return view('admin.dashboard', compact('mastersCount', 'servicesCount', 'bookingsCount'));
    })->name('admin.dashboard');

    // Ресурсы для управления мастерами, услугами и бронированиями
    Route::resource('masters', MasterController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('bookings', BookingController::class);
});

// Маршруты для бронирования (клиентская часть)
Route::get('/bookings/create', [ClientBookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [ClientBookingController::class, 'store'])->name('bookings.store');

// Маршрут для получения слотов (JSON)
Route::get('/slots/json', [BookingController::class, 'slotsJson'])->name('slots.json');

Route::get('/price-list', function () {
    return view('price-list');
})->name('price-list');

// routes/web.php
Route::get('/bookings/available-slots', [BookingController::class, 'getAvailableSlots']);
Route::get('/masters/{master}/services', [BookingController::class, 'getServices']);

