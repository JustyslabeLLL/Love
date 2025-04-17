@extends('layouts.app')

@section('content')
    <h1>Детали мастера</h1>
    <p><strong>Имя:</strong> {{ $master->name }}</p>
    <p><strong>Описание:</strong> {{ $master->description }}</p>
    <a href="{{ route('masters.edit', $master->id) }}">Редактировать</a>
    <form action="{{ route('masters.destroy', $master->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>
@endsection
