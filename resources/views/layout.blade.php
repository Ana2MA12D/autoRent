<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
    <title>@yield('title', 'AutoRent')</title>
</head>
<style>
    .container {
        height: 90vh;
        color: #2c2c2c;
        display: grid;
        place-items: center;
        align-content: center;
        max-height: max-content;
    }

    .login_bg--img {
        top: 0;
        left: 0;
        position: fixed;
        z-index: -100;
        width: 100%;
        object-fit: cover;
        opacity: 0.6;
        filter: blur(13px);
    }

    .navbar {
        background-color: #424040;
        font-size: 16px;

        .navbar__brand {
            text-decoration: none;
            color: #f1f1f1;
            font-size: 18px;
        }

        .navbar-nav {
            display: flex;
        }

        .btn {
            border: 2px solid #a8a8a8;
            color: #a8a8a8;
            font-weight: bold;
            font-size: 18px;

            &:hover {
                background-color: #a8a8a8;
                color: #424040;
            }
        }
    }

</style>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container" style="height: auto;">
            <a class="navbar-brand" href="{{ url('/') }}">AutoRent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Заказы
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('rental_orders') }}">Все заказы</a></li>
                            <li><a class="dropdown-item" href="{{ route('rental_orders.create') }}">Добавить заказ</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Автомобили
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('cars') }}">Все автомобили</a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites.index') }}">Все любимые
                                    автомобили</a>
                            <li><a class="dropdown-item" href="{{ route('favorites.create') }}">Добавить любимый
                                    автомобиль</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        @auth
                            @if(Auth::user()->is_admin)
                                <a class="nav-link" href="{{ url('clients') }}">Клиенты</a>
                            @else
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Клиенты</a>
                            @endif
                        @else
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Клиенты</a>
                        @endauth
                    </li>
                </ul>

                @if(Auth::check())
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fa fa-user" style="font-size: 20px; color: white;"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn my-2 my-sm-0" href="{{ url('logout') }}">Выйти</a>
                        </li>
                    </ul>
                @else
                    <form class="d-flex" method="post" action="{{ url('auth') }}">
                        @csrf
                        <input type="text" class="form-control me-2" name="email" placeholder="Логин"
                               value="{{ old('email') }}">
                        <input type="password" class="form-control me-2" name="password" placeholder="Пароль">
                        <button class="btn" type="submit">Войти</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>
</header>
<body class="d-flex flex-column h-auto">
<img src="{{ asset('images/autopark.jpg') }}" class="login_bg--img" alt="">
@include('error')

<div class="section__styles">

    <main class="flex-shrink-0">
        <div class="container">

            @yield('content')
        </div>

    </main>
</div>
</body>
</html>
