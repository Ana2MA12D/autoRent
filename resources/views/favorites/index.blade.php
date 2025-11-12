@extends('layout')
@section('title', 'Избранные автомобили')
@section('content')
    <style>
        .container--favorites {
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

        }

        tr:hover td {
            background: #b3b3b3;
        }

        .delete__btn {
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

        .edit__btn {
            &:hover {
                color: #978305;
                transform: scale(1.1);
            }
        }

        a {
            text-decoration: none;
            color: #474747;
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .add-new-fav {
            margin-bottom: 18px;
            font-size: 18px;
            font-weight: bold;

            a {
                transition: all 0.3s ease;

                &:hover {
                    color: #03537a;
                    transform: scale(1.1);
                }
            }
        }

        .btns-edit-delete {
            width: 300px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }
    </style>
    <div class="container--favorites" style="margin-top: 35px;">
        <h1>Список избранных автомобилей</h1>

        <div class="add-new-fav">
            <a href="{{ route('favorites.create') }}">Добавить новое избранное</a>
        </div>

        <table>
            <thead>
            <td>ID</td>
            <td>Клиент</td>
            <td>Автомобиль</td>
            <td>Дата добавления</td>
            <td>Действия</td>
            </thead>
            @foreach($favorites as $favorite)
                <tr>
                    <td>{{ $favorite->id }}</td>
                    <td>
                        @if($favorite->client)
                            {{ $favorite->client->name }} {{ $favorite->client->surname ?? '' }}
                        @else
                            <span>Клиент не найден</span>
                        @endif
                    </td>
                    <td>
                        @if($favorite->car)
                            {{ $favorite->car->brand }} {{ $favorite->car->model }} ({{ $favorite->car->year }})
                        @else
                            <span class="text-danger">Автомобиль не найден</span>
                        @endif
                    </td>
                    <td>
                        @if($favorite->created_at)
                            {{ $favorite->created_at->format('d.m.Y H:i') }}
                        @else
                            <span class="text-muted">Не указана</span>
                        @endif
                    </td>
                    <td class="btns-edit-delete">
                        <a class="edit__btn" href="{{ route('favorites.edit', $favorite->id) }}">Редактировать</a>
                        <a class="delete__btn" href="{{ route('favorites.destroy', $favorite->id) }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
        </table>

        @if($favorites->isEmpty())
            <div class="alert alert-info">
                Нет записей об избранных автомобилях.
            </div>
        @endif
    </div>
@endsection
