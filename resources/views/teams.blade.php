@extends('layouts.app')

@section('content')
    <h1>Команды сезона 2025</h1>

    {{-- обёрнул всё в .teams-grid --}}
    <div class="teams-grid">
        @foreach($teams as $team)
            <div class="team-panel" id="team-{{ $team->id }}">
                {{-- Заголовок --}}
                <h2>{{ $team->name }}</h2>

                {{-- Фото машины --}}
                <div class="team-car">
                    <img 
                        src="{{ asset('images/' . (optional($team->profile)->image ?: 'default-team.png')) }}" 
                        alt="{{ $team->name }}"
                    >
                </div>

                {{-- Описание команды --}}
                <p class="team-desc">{{ optional($team->profile)->description ?? '' }}</p>

                {{-- Пилоты --}}
                <div class="drivers-list">
                    @foreach($team->drivers as $driver)
                        <div class="driver-card" id="driver-{{ $driver->id }}">
                            <h3>
                                #{{ optional($driver->stats)->position ?? '-' }}
                                {{ $driver->name }}
                            </h3>
                            <div class="driver-content">
                                <div class="driver-photo">
                                    <img 
                                        src="{{ asset('images/' . (optional($driver->stats)->photo ?: 'default-driver.png')) }}"
                                        alt="{{ $driver->name }}"
                                    >
                                </div>
                                <ul class="driver-info">
                                    <li>Сезоны: {{ optional($driver->stats)->seasons ?? '-' }}</li>
                                    <li>Гран-при: {{ optional($driver->stats)->grand_prix_count ?? '-' }}</li>
                                    <li>Дебют: 
                                        @if(optional($driver->stats)->debut)
                                            {{ \Carbon\Carbon::parse($driver->stats->debut)->format('Y-m-d') }}
                                        @else
                                            -
                                        @endif
                                    </li>
                                    <li>Победы: {{ optional($driver->stats)->wins ?? '0' }}</li>
                                    <li>Поулы: {{ optional($driver->stats)->poles ?? '0' }}</li>
                                    <li>Подиумы: {{ optional($driver->stats)->podiums ?? '0' }}</li>
                                    <li>Очки: {{ optional($driver->stats)->points ?? '0' }}</li>
                                    <li>Быстрые круги: {{ optional($driver->stats)->fastest_laps ?? '0' }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
