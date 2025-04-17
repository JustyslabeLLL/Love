@extends('admin.layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h2>Список услуг</h2>
        <a href="{{ route('services.create') }}" class="btn btn-success">Добавить услугу</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Длительность</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ $service->price }} руб.</td>
                <td>{{ $service->duration }} мин.</td>
                <td>
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-primary">Изменить</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
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
