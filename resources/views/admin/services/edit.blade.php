@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование услуги</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Название услуги:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена:</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $service->price }}" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Длительность (в минутах):</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ $service->duration }}" required>
        </div>

        <!-- Добавьте другие поля, если необходимо -->

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
@endsection
