@extends('layout')
@section('title', 'Клиент')
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

            }
        }

        tr:hover td {
            background: #b3b3b3;
        }

        .client-show {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
    </style>
    <div class="client-show">
        <h1>Клиент: {{ $client->name }} {{ $client->lastName }}</h1>
        <p><strong>Телефон:</strong> {{ $client->phone }}</p>
        <p><strong>Паспортные данные:</strong> {{ $client->passportData }}</p>

        <h2>Заказы аренды этого клиента:</h2>
        @if($client->rentalOrders->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>ID заказа</th>
                    <th>Машина</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Общая стоимость</th>
                </tr>
                </thead>
                <tbody>
                @foreach($client->rentalOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                        <td>{{ $order->pickup_date }}</td>
                        <td>{{ $order->dropoff_date }}</td>
                        <td>{{ $order->total_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>У этого клиента нет заказов аренды.</p>
        @endif
        <h1>Избранные машины клиента:</h1>

        @if($client->favoriteCars->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>ID машины</th>
                    <th>Марка</th>
                    <th>Модель</th>
                    <th>Гос. номер</th>
                    <th>Цена</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($client->favoriteCars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->gov_number }}</td>
                        <td>{{ $car->price }}</td>
                        <td>{{ $car->status ? 'Доступна' : 'Не доступна' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>У этого клиента нет избранных машин.</p>
        @endif
    </div>
@endsection
