@extends('layout')
@section('title', 'Добавление автомобиля в избранное')
@section('content')
    <style>
        .container {
            color: #424040;

            .car-create {
                display: flex;
                flex-direction: column;
            }

            .create__btn {
                border: 2px solid #8c2424;
                border-radius: 5px;
                background-color: transparent;
                color: #8c2424;
                height: 40px;
                font-weight: bold;
                width: 50%;
                transition: all 0.3s ease;
                text-align: center;

                &:hover {
                    background-color: #8c2424;
                    color: #cacaca;
                }
            }

            .back-to-fav__btn {
                text-decoration: none;
                color: #474747;
                transition: all 0.3s ease;
                transform: scale(1);
                display: inline-block;
                transform-origin: left center;
                font-size: 20px;
                font-weight: bold;

                &:hover {
                    color: #8c2424;
                    transform: scale(1.04);
                }
            }

            .form-select {
                width: 100%;
                height: 40px;
                border-radius: 5px;
                border: 2px solid #8c2424;
                background-color: transparent;
                color: #424040;
                font-size: 18px;
            }

            .form-label {
                font-size: 18px;
                font-weight: 500;
            }

            .checkbox-item {
                position: relative;
                box-sizing: unset;
            }

            .checkbox-item input[type="checkbox"] {
                appearance: none;
                content: "";
                position: absolute;
                left: 0;
                top: 4px;
                width: 20px;
                height: 20px;
                border: 2px solid #8c2424;
                border-radius: 3px;
                background-color: transparent;
                transition: all 0.3s ease;
            }

            .checkbox-item label {
                position: relative;
                padding-left: 30px;
                cursor: pointer;
                font-size: 18px;
                display: inline-block;
            }

            .checkbox-item label:before {
                content: "";
                position: absolute;
                left: 0;
                top: 4px;
                width: 20px;
                height: 20px;
                border: 2px solid #8c2424;
                border-radius: 3px;
                background-color: transparent;
                transition: all 0.3s ease;
            }

            .checkbox-item input[type="checkbox"]:checked + label:before {
                background-color: #8c2424;
                border-color: #8c2424;
            }

            .checkbox-item input[type="checkbox"]:checked + label:after {
                content: "";
                position: absolute;
                left: 7px;
                top: 7px;
                width: 6px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }
        }
    </style>

        <div class="row justify-content-center">
            <div class="">
                <h1 style="text-align: center;">Добавить автомобиль в избранное</h1>

                <form class="car-create" action="{{ route('favorites.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="client_id" class="form-label">Клиент</label>
                        <select class="form-select" id="client_id" name="client_id"
                                aria-describedby="clientHelp" required>
                            <option value="">Выберите клиента</option>
                            @foreach($clients as $client)
                                <option
                                    value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }} {{ $client->lastName ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        <div id="clientHelp" class="form-text">Выберите клиента из списка</div>
                    </div>

                    <div class="mb-3">
                        <label for="car_id" class="form-label">Автомобиль</label>
                        <select class="form-select" id="car_id" name="car_id" aria-describedby="carHelp" required>
                            <option value="">Выберите автомобиль</option>
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                    {{ $car->brand }} {{ $car->model }} ({{ $car->year }}) - {{ $car->price }}
                                    ₽/день
                                </option>
                            @endforeach
                        </select>
                        <div id="carHelp" class="form-text">Выберите автомобиль из списка</div>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="confirm" name="confirm" required>
                        <label for="confirm">Подтверждаю создание заказа</label>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-between align-items-center mt-3">
                        <button type="submit" class="create__btn">Добавить в избранное</button>
                        <a href="{{ route('favorites.index') }}" class="back-to-fav__btn">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
@endsection
