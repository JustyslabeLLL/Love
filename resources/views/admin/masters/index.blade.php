@extends('admin.layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h2>Список мастеров</h2>
        <a href="{{ route('masters.create') }}" class="btn btn-success">Добавить мастера</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masters as $master)
            <tr>
                <td>{{ $master->name }}</td>
                <td>{{ $master->description }}</td>
                <td>
                    <a href="{{ route('masters.edit', $master) }}" class="btn btn-primary">Изменить</a>
                    <form action="{{ route('masters.destroy', $master) }}" method="POST" class="d-inline">
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
