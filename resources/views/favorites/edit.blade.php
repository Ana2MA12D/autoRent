@extends('layout')
@section('title', 'Клиент')
@section('content')
    <style>
        .fav-edit {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .update__btn {
            border: 2px solid #8c2424;
            border-radius: 5px;
            background-color: transparent;
            color: #8c2424;
            font-weight: bold;
            width: 100%;
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

        .client__choice {
            width: 45%;
            height: 33px;
            border-radius: 5px;
            border: 2px solid #8c2424;
            background-color: transparent;
            color: #424040;
            font-size: 18px;
        }

        label {
            font-size: 18px;
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

    </style>
    <div>
        <h1>Редактировать избранное</h1>
        <form class="fav-edit" action="{{ route('favorites.update', $favorite->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="client_id">Клиент:</label>
                <select class="client__choice" id="client_id" name="client_id" required>
                    <option style="" value="">Выберите клиента</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}"
                            {{ $favorite->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} {{ $client->surname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="car_id">Автомобиль:</label>
                <select class="client__choice" id="car_id" name="car_id" required>
                    <option style="" value="">Выберите автомобиль</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}"
                            {{ $favorite->car_id == $car->id ? 'selected' : '' }}>
                            {{ $car->brand }} {{ $car->model }} ({{ $car->year }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox-item">
                <input type="checkbox" id="confirm" name="confirm" required>
                <label for="confirm">Подтверждаю изменения</label>
            </div>
            <button class="update__btn" type="submit">Обновить</button>
            <a class="back-to-fav__btn" href="{{ route('favorites.index') }}">Назад к списку</a>
        </form>
    </div>
@endsection
