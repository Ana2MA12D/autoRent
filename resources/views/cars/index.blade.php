@extends('layout')
@section('title', 'Все автомобили')
@section('content')

    <style>
        .container--cars {
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

            .show-all__btn {
                &:hover {
                    color: #03537a;
                    transform: scale(1.1);
                }
            }
        }

        tr:hover td {
            background: #b3b3b3;
        }
    </style>
    <div class="container--cars">
        <h1 style="margin-top: 35px;" >Список всех автомобилей</h1>
        <table>
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
                    <td>
                        <a class="show-all__btn" href="{{ url('cars', $car->id) }}">Показать полностью</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $cars->links() }}
    </div>
@endsection
