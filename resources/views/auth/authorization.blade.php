<!DOCTYPE html>
<html>
<head>
    <title>Вход в систему</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .button button {
        background-color: #CBA9A9;
    }

    .form {
        width: 80%;
        padding-top: 200px;
        margin: auto;
    }
</style>
<body>
    @extends('layouts.header')
    @section('content')

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ url('/') }}" class="btn btn-secondary mb-3">На главную</a>
        <form action="{{ route('authorization') }}" method="POST">
            @csrf
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center button">
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-block btn-lg gradient-custom-4 text-body">Авторизоваться</button>
            </div>
        </form>
    </div>

    @endsection
</body>
</html>
