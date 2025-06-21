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
                    <td>{{ $race->grand_prix }}</td>
                    <td>
                        @if($race->circuit)
                            <a href="{{ route('circuits') }}#circuit-{{ $race->circuit->id }}">
                                {{ $race->circuit->name }}
                            </a>
                        @else
                            &mdash;
                        @endif
                    </td>
                    <td>
                        @if($race->winner)
                            <a href="{{ route('teams') }}#driver-{{ $race->winner->id }}">
                                {{ $race->winner->name }}
                            </a>
                        @else
                            &mdash;
                        @endif
                    </td>
                    <td>
                        @if($race->team)
                            <a href="{{ route('teams') }}#team-{{ $race->team->id }}">
                                {{ $race->team->name }}
                            </a>
                        @else
                            &mdash;
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
