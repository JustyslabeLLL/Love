@extends('layouts.app')

@section('content')
    <h1>Детали бронирования</h1>
    <p><strong>Мастер:</strong> {{ $booking->master->name }}</p>
    <p><strong>Услуга:</strong> {{ $booking->service->name }} ({{ $booking->service->price }} руб.)</p>
    <p><strong>Дата и время:</strong> {{ $booking->booking_date }}</p>
    <p><strong>Имя клиента:</strong> {{ $booking->client_name }}</p>
    <p><strong>Телефон клиента:</strong> {{ $booking->client_phone }}</p>
    <a href="{{ route('bookings.edit', $booking->id) }}">Редактировать</a>
    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>
@endsection
