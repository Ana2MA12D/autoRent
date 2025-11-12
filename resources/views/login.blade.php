@extends('layout')
@section('title', 'Login')
@section('content')
    <style>
    .login_form--inp {
        display: flex;
        flex-direction: column;
        gap: 15px;
        align-items: center;
        width: 60%;


        input, button {
            height: 50px;
            width: 100%;
        }

        button {
            border: #424040 solid;
            color: #424040;
            font-weight: bold;
            font-size: 18px;

            &:hover {
                background-color: #424040;
                color: #a8a8a8;
            }
        }
    }
    </style>
@if(!Auth::user())
    <h2 style="text-align: center;">Добро пожаловать! <br> Пожалуйста, войдите в систему.</h2>
    <form class="login_form--inp" method="post" action="{{ url('auth') }}">
        @csrf
        <input class="form-control" type="text" placeholder="Логин" name="email" aria-label="Логин"
               value="{{ old('email') }}"/>
        <input class="form-control" type="password" placeholder="Пароль" name="password" aria-label="Пароль"
               value="{{ old('password') }}"/>
        <button class="btn" type="submit">Войти</button>
    </form>
@else
    <ul class="navbar-nav">
        <a class="nav-link active" href="#"><i class="fa fa-user" style="font-size: 20px; color: white;"></i>
            <span>   </span>{{ Auth::user()->name }}</a>
        <a class="btn" href="{{ url('logout') }}">Выйти</a>
    </ul>
@endif
@endsection
