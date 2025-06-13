@extends('layouts.app')
@section('content')
    <h1>Мои карточки</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <h2>Активные</h2>
    @forelse($active as $app)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>{{ $app->title }}</strong> — {{ $app->author }} ({{ config('book.types')[$app->type] ?? $app->type }})
            <form action="{{ route('cabinet.delete', $app->id) }}" method="POST" style="display:inline; margin-left:10px;">
                @csrf
                <button type="submit">Удалить</button>
            </form>
        </div>
    @empty
        <p>Нет активных карточек.</p>
    @endforelse
    <h2>Архив</h2>
    @forelse($archived as $app)
        <div style="border:1px solid #eee; padding:10px; margin-bottom:10px; background:#f9f9f9;">
            <strong>{{ $app->title }}</strong> — {{ $app->author }} ({{ config('book.types')[$app->type] ?? $app->type }})<br>
            <small>Статус: {{ $app->status }}{{ $app->rejection_reason ? ' — ' . $app->rejection_reason : '' }}</small>
        </div>
    @empty
        <p>Нет архивных карточек.</p>
    @endforelse
@endsection