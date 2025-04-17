@extends('layouts.app')

@section('content')
    <h1>Детали услуги</h1>
    <p><strong>Название:</strong> {{ $service->name }}</p>
    <p><strong>Цена:</strong> {{ $service->price }} руб.</p>
    <a href="{{ route('services.edit', $service->id) }}">Редактировать</a>
    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>
@endsection
