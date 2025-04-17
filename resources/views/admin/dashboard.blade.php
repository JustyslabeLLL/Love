@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Добро пожаловать в админ-панель!</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Мастера</h5>
                    <p class="card-text">Количество мастеров: {{ $mastersCount }}</p>
                    <a href="{{ route('masters.index') }}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Услуги</h5>
                    <p class="card-text">Количество услуг: {{ $servicesCount }}</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Бронирования</h5>
                    <p class="card-text">Количество бронирований: {{ $bookingsCount }}</p>
                    <a href="{{ route('bookings.index') }}" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
