@extends('layouts.app')

@section('content')
<h1>Календарь сезона 2025</h1>

<table class="calendar-table">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Гран При</th>
            <th>Трасса</th>
            <th>Победитель</th>
            <th>Команда</th>
        </tr>
    </thead>
    <tbody>
        @foreach($races as $race)
            <tr>
                <td>{{ \Carbon\Carbon::parse($race->race_date)->format('d.m.Y') }}</td>
                <td><a href="#">{{ $race->grand_prix }}</a></td>
                <td><a href="#">{{ $race->circuit?->name }}</a></td>
                <td>
                    @if($race->winner)
                        <a href="#">{{ $race->winner->name }}</a>
                    @else
                        —
                    @endif
                </td>
                <td>
                    @if($race->team)
                        <a href="#">{{ $race->team->name }}</a>
                    @else
                        —
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
