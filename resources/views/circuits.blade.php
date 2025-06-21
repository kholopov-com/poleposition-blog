@extends('layouts.app')

@section('content')
    <h1>Трассы сезона 2025</h1>

    <div class="circuits-grid">
        @foreach($circuits as $circuit)
            {{-- добавили id для якоря --}}
            <div class="circuit-panel" id="circuit-{{ $circuit->id }}">
                <h2>{{ $circuit->name }}</h2>

                <div class="circuit-photo">
                    <img
                        src="{{ asset('images/' . ($circuit->image ?: 'default-circuit.png')) }}"
                        alt="{{ $circuit->name }}"
                    >
                </div>

                <ul class="circuit-info">
                    <li>Направление движения: {{ $circuit->direction }}</li>
                    <li>Длина круга: {{ $circuit->lap_length }} км</li>
                    <li>Кругов: {{ $circuit->laps_count }}</li>
                    <li>Дистанция: {{ $circuit->distance }} км</li>
                    <li>Перепад высот: {{ $circuit->elevation_change }} м</li>
                    <li>Число поворотов: {{ $circuit->turns_count }}</li>
                </ul>

                <p class="circuit-desc">{{ $circuit->description }}</p>
            </div>
        @endforeach
    </div>
@endsection
