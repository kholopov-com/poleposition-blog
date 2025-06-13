@extends('layouts.app')

@section('content')
    <h1>Все карточки пользователя {{ auth()->user()->username }}</h1>

    @if($applications->isEmpty())
        <p>Заявок не найдено.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Автор</th>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Статус</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                    <tr>
                        <td>{{ $app->id }}</td>
                        <td>{{ $app->author }}</td>
                        <td>{{ $app->title }}</td>
                        <td>{{ $app->type }}</td>
                        <td>{{ $app->status }}</td>
                        <td>{{ $app->created_at ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
