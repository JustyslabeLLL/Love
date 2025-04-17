@extends('admin.layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->master->name }}</td>
                <td>{{ $booking->service->name }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->client_name }}</td>
                <td>{{ $booking->client_phone }}</td>
                <td>
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
