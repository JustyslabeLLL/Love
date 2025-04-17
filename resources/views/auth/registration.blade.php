<style>
    .button button {
        background-color: #CBA9A9;
    }

    .form {
        width: 80%;
        margin: auto;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@extends('layouts.header')

@section('content')

<div class="form mt-5">
    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">На главную</a>
    <form method="post" action="{{route('store')}}">
        @csrf
        <div data-mdb-input-init class="form-outline mb-4">
            <input name="name" type="text" id="form3Example1cg" class="form-control form-control-lg" />
            <label class="form-label" for="form3Example1cg">Ваше имя</label>
        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <input name="email" type="text" id="form3Example3cg" class="form-control form-control-lg" />
            <label class="form-label" for="form3Example3cg">Ваша почта</label>
        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <input name="password" type="text" id="form3Example3cg" class="form-control form-control-lg" />
            <label class="form-label" for="form3Example3cg">Введите пароль</label>
        </div>
        <div class="d-flex justify-content-center button">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-block btn-lg gradient-custom-4 text-body">Зарегистрироваться</button>
        </div>
    </form>
</div>

@endsection
