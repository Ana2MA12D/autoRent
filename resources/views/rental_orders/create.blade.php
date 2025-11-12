<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать заказ аренды</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Создать заказ аренды</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rental_orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Клиент:</label>
            <select class="form-select" id="client_id" name="client_id" required>
                <option style="display:none">Выберите клиента</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} {{ $client->surname ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="car_id" class="form-label">Автомобиль:</label>
            <select class="form-select" id="car_id" name="car_id" required>
                <option style="display:none">Выберите автомобиль</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                        {{ $car->brand }} {{ $car->model }} ({{ $car->year }}) - {{ $car->price }} ₽/день
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_date" class="form-label">Дата начала аренды:</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="{{ old('pickup_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="dropoff_date" class="form-label">Дата окончания аренды:</label>
            <input type="date" class="form-control" id="dropoff_date" name="dropoff_date" value="{{ old('dropoff_date') }}" required>
        </div>

        <div class="alert alert-info">
            <strong>Стоимость будет рассчитана автоматически</strong><br>
            Формула: количество дней × цена автомобиля за день
        </div>

        <button type="submit" class="btn btn-primary">Создать заказ</button>
        <a href="/rental_orders" class="btn btn-secondary">Отмена</a>
    </form>
</div>
</body>
</html>
