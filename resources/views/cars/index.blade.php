<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все автомобили</title>
</head>
<body>
<h1>Список всех автомобилей</h1>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Гос. номер</th>
        <th>Марка</th>
        <th>Модель</th>
        <th>Статус</th>
        <th>Цена</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cars as $car)
        <tr>
            <td>{{ $car->id }}</td>
            <td>{{ $car->gov_number }}</td>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->status ? 'Доступна' : 'Не доступна' }}</td>
            <td>{{ $car->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $cars->links() }}
</body>
</html>
