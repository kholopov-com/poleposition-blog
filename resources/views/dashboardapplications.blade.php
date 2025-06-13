@extends('layouts.app')

@section('content')
    <h1>Карточки книг</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; margin-bottom: 30px;">
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Автор</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Статус</th>
            <th>Причина</th>
            <th>Действия</th>
        </tr>
        @foreach($applications as $app)
            <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->user->username ?? '-' }}</td>
                <td>{{ $app->author }}</td>
                <td>{{ $app->title }}</td>
                <td>{{ config('book.types')[$app->type] ?? $app->type }}</td>
                <td>
                    @if($app->status == 'опубликована')
                        <span style="color: green;">опубликована</span>
                    @elseif($app->status == 'отклонена')
                        <span style="color: red;">отклонена</span>
                    @else
                        <span>новая</span>
                    @endif
                </td>
                <td>{{ $app->rejection_reason }}</td>
                <td>
                    @if($app->status === 'новая')
                        <form method="POST" action="{{ route('applications.approve', $app->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit">Опубликовать</button>
                        </form>

                        <form method="POST" action="{{ route('applications.reject', $app->id) }}" style="display:inline; margin-top: 5px;">
                            @csrf
                            <input type="text" name="reason" placeholder="Причина" required style="width: 120px;">
                            <button type="submit">Отклонить</button>
                        </form>
                    @else
                        —
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
