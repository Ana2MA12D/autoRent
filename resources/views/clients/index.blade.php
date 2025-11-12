@extends('layout')
@section('title', 'Все клиенты')
@section('content')
    <style>
        .container--clients {
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
    <div class="container--clients">
        <h1 style="margin-bottom: 15px; margin-top: 35px;">Наши клиенты</h1>
        <table>
            <thead>
            <td>id</td>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Телефон</td>
            <td>Паспортные данные</td>
            <td>Действия</td>
            </thead>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->lastName }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->passportData }}</td>
                    <td>
                        <a class="show-all__btn" href="{{ url('clients', $client->id) }}">Показать полностью</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
