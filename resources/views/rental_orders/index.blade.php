<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все заказы аренды</title>
</head>
<body>
<h1>Список всех заказов аренды</h1>
<table border="1">
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
                <a href="{{ route('rental_orders.edit', $order->id) }}">Редактировать</a>
                <a href="{{ route('rental_orders.destroy', $order->id) }}">Удалить</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
