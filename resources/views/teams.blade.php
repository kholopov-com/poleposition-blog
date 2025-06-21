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
                <p class="team-desc">{{ optional($team->profile)->description }}</p>

                {{-- Пилоты --}}
                <div class="drivers-list">
                    @foreach($team->drivers as $driver)
                        <div class="driver-card" id="driver-{{ $driver->id }}">
                            <h3>#{{ $driver->stats->position }} {{ $driver->name }}</h3>
                            <div class="driver-content">
                                <div class="driver-photo">
                                    <img src="{{ asset('images/'.$driver->stats->photo) }}"
                                         alt="{{ $driver->name }}">
                                </div>
                                <ul class="driver-info">
                                    <li>Сезоны: {{ $driver->stats->seasons }}</li>
                                    <li>Гран-при: {{ $driver->stats->grand_prix_count }}</li>
                                    <li>Дебют: {{ \Carbon\Carbon::parse($driver->stats->debut)->format('Y-m-d') }}</li>
                                    <li>Победы: {{ $driver->stats->wins }}</li>
                                    <li>Поулы: {{ $driver->stats->poles }}</li>
                                    <li>Подиумы: {{ $driver->stats->podiums }}</li>
                                    <li>Очки: {{ $driver->stats->points }}</li>
                                    <li>Быстрые круги: {{ $driver->stats->fastest_laps }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
