@extends('layout')
@section('title', 'Все заказы аренды')
@section('content')

    <style>
        .container__rental-orders {
            height: 90vh;
            color: #2c2c2c;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 50px;
        }

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

            .edit__btn {
                &:hover {
                    color: #978305;
                    transform: scale(1.1);
                }
            }

            .show-all__btn {
                &:hover {
                    color: #03537a;
                    transform: scale(1.1);
                }
            }

            .delete__btn {
                border: 2px solid #8c2424;
                border-radius: 5px;
                background-color: transparent;
                color: #8c2424;
                font-weight: bold;
                width: 75%;
                transition: all 0.3s ease;
                margin-top: 10px;

                &:hover {
                    background-color: #8c2424;
                    color: #cacaca;
                }
            }

        }

        tr:hover td {
            background: #b3b3b3;
        }

        .add-new-fav {
            margin-bottom: 18px;
            font-size: 18px;
            font-weight: bold;

            a {
                transition: all 0.3s ease;
                text-decoration: none;
                color: #474747;

                &:hover {
                    color: #03537a;
                    transform: scale(1.1);
                }
            }
        }
    </style>

    <div class="container__rental-orders">

        <h1 style="margin-top: 35px;">Список всех заказов аренды</h1>
        @if(session('success'))
            <div style="color: green; font-weight: bold; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; font-weight: bold; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="add-new-fav">
            <a href="{{ route('rental_orders.create') }}">Добавить новый заказ</a>
        </div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Клиент</th>
                <th>Машина</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Кол-во дней</th>
                <th>Стоимость/день</th>
                <th>Общая стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rentalOrders as $order)
                @php
                    $days = \Carbon\Carbon::parse($order->pickup_date)->diffInDays($order->dropoff_date);
                    $dailyPrice = $order->car->price ?? 0;
                    $totalPrice = $days * $dailyPrice;
                @endphp
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->name }} {{ $order->client->lastName }}</td>
                    <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                    <td>{{ $order->pickup_date }}</td>
                    <td>{{ $order->dropoff_date }}</td>
                    <td>{{ $days }} дн.</td>
                    <td>{{ $dailyPrice }} ₽</td>
                    <td>{{ $totalPrice }} ₽</td>
                    <td>
                        <a class="edit__btn" href="{{ route('rental_orders.edit', $order->id) }}">Редактировать</a>
                        <form action="{{ route('rental_orders.destroy', $order->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete__btn"
                                    onclick="return confirm('Вы уверены, что хотите удалить запись?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                    <td>
                        <a class="show-all__btn" href="{{ route('rental_orders.show', $order->id) }}">Показать
                            полностью</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
