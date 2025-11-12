@extends('layout')
@section('title', 'Автомобили')
@section('content')
    <style>
        th {
            font-weight: bold;
            color: #2c2c2c;
            padding: 10px 15px;
        }

        td {
            color: #474747;
            font-weight: bold;
            border-top: 1px solid #e8edff;
            padding: 10px 15px;

            a {
                text-decoration: none;
                color: #474747;
                transition: all 0.3s ease;
                transform: scale(1);


            }
        }

        tr:hover td {
            background: #b3b3b3;
        }

        .car-show {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

    </style>
    <div class="car-show">
        <h1>Автомобиль: {{ $car->brand }} {{ $car->model }}</h1>

        <h2>Основная информация:</h2>
        <p><strong>Гос. номер:</strong> {{ $car->gov_number }}</p>
        <p><strong>Марка:</strong> {{ $car->brand }}</p>
        <p><strong>Модель:</strong> {{ $car->model }}</p>
        <p><strong>Статус:</strong> {{ $car->status ? 'Доступна' : 'Не доступна' }}</p>
        <p><strong>Цена:</strong> {{ $car->price }}</p>

        <h2>Заказы аренды для этой машины:</h2>
        @if($car->rentalOrders->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>ID заказа</th>
                    <th>Клиент</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Общая стоимость</th>
                </tr>
                </thead>
                <tbody>
                @foreach($car->rentalOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->client->name }} {{ $order->client->lastName }}</td>
                        <td>{{ $order->pickup_date }}</td>
                        <td>{{ $order->dropoff_date }}</td>
                        <td>{{ $order->total_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Для этой машины нет заказов аренды.</p>
        @endif
        <h2>Клиенты, добавившие эту машину в избранное:</h2>
        @if($car->favoriteClients->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>ID клиента</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                @foreach($car->favoriteClients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->lastName }}</td>
                        <td>{{ $client->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Эту машину еще никто не добавил в избранное.</p>
        @endif
    </div>
@endsection
