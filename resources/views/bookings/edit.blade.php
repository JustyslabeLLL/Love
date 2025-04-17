@extends('layouts.app')

@section('content')
    <h1>Редактирование бронирования</h1>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="master_id">Мастер:</label>
            <select name="master_id" id="master_id" required>
                @foreach ($masters as $master)
                    <option value="{{ $master->id }}" {{ $booking->master_id == $master->id ? 'selected' : '' }}>{{ $master->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="service_id">Услуга:</label>
            <select name="service_id" id="service_id" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }} ({{ $service->price }} руб.)</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="booking_date">Дата и время:</label>
            <input type="datetime-local" name="booking_date" id="booking_date" value="{{ $booking->booking_date }}" required>
        </div>
        <div>
            <label for="client_name">Ваше имя:</label>
            <input type="text" name="client_name" id="client_name" value="{{ $booking->client_name }}" required>
        </div>
        <div>
            <label for="client_phone">Ваш телефон:</label>
            <input type="text" name="client_phone" id="client_phone" value="{{ $booking->client_phone }}" required>
        </div>
        <button type="submit">Обновить бронирование</button>
    </form>
@endsection
