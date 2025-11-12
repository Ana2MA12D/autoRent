@extends('layout')
@section('title', 'AutoRent')
@section('content')
    <style>
        .container {
            height: 90vh;
            color: #2c2c2c;
            display: grid;
            place-items: center;
            align-content: center;
        }

    </style>

    @if($user)
        <h1>Здравствуйте, {{ $user->name }}</h1>
        <h2>Добро пожаловать в систему управления проектом AutoRent</h2>
    @else
        <h1>Добро пожаловать в систему управления проектом AutoRent</h1>
        <h2>Пожалуйста, войдите в систему</h2>
    @endif
@endsection
