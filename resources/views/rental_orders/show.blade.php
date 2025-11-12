@extends('layout')
@section('title', 'Заказ аренды')
@section('content')
<h1>Заказ аренды № {{ $rentalOrder->id }}</h1>

<h2>Информация о клиенте:</h2>
<p><strong>Имя:</strong> {{ $rentalOrder->client->name }} {{ $rentalOrder->client->lastName }}</p>
<p><strong>Телефон:</strong> {{ $rentalOrder->client->phone }}</p>

<h2>Информация о машине:</h2>
<p><strong>Марка:</strong> {{ $rentalOrder->car->brand }}</p>
<p><strong>Модель:</strong> {{ $rentalOrder->car->model }}</p>
<p><strong>Гос. номер:</strong> {{ $rentalOrder->car->gov_number }}</p>

<h2>Детали заказа:</h2>
<p><strong>Дата начала:</strong> {{ $rentalOrder->pickup_date }}</p>
<p><strong>Дата окончания:</strong> {{ $rentalOrder->dropoff_date }}</p>
<p><strong>Общая стоимость:</strong> {{ $rentalOrder->total_price }}</p>

@if($rentalOrder->payment)
    <h2>Информация об оплате:</h2>
    <p><strong>Сумма оплаты:</strong> {{ $rentalOrder->payment->amount }}</p>
    <p><strong>Дата оплаты:</strong> {{ $rentalOrder->payment->created_at }}</p>
@else
    <p>Оплата по этому заказу не найдена.</p>
@endif
@endsection
