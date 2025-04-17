@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Добавить мастера</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('masters.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection


{{-- <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <form action="{{ route('masters.store') }}" method="POST" class="p-4 border rounded bg-light">
                @csrf
                <h2 class="text-center mb-4">Создать мастера</h2>
                <div class="form-group mb-3">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Введите имя">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputDescription">Описание</label>
                    <textarea type="text" class="form-control" id="text" placeholder="Введите описание"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Отправить</button>
            </form>
        </div>
    </div>
</div> --}}
