@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>Карточка книги</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/application">
        @csrf

        <label for="author">Автор книги*</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}" required>
        @error('author') <div style="color: red;">{{ $message }}</div> @enderror

        <label for="title">Название книги*</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title') <div style="color: red;">{{ $message }}</div> @enderror

<div style="margin-bottom: 15px;">
    @foreach(config('book.types') as $value => $label)
        <label>
            <input type="radio" name="type" value="{{ $value }}" {{ old('type') == $value ? 'checked' : '' }}>
            {{ $label }}
        </label><br>
    @endforeach
</div>        @error('type') <div style="color: red;">{{ $message }}</div> @enderror

        <label for="publisher">Издательство</label>
        <input type="text" id="publisher" name="publisher" value="{{ old('publisher') }}">

        <label for="year">Год издания</label>
        <input type="number" id="year" name="year" value="{{ old('year') }}" min="1000" max="{{ date('Y') }}">

        <label for="cover">Переплет</label>
        <select id="cover" name="cover">
            <option value="">-- не выбрано --</option>
            @foreach(config('book.covers') as $option)
                <option value="{{ $option }}" {{ old('cover') == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>

        <label for="condition">Состояние книги</label>
        <select id="condition" name="condition">
            <option value="">-- не выбрано --</option>
            @foreach(config('book.conditions') as $option)
                <option value="{{ $option }}" {{ old('condition') == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>

        <input type="submit" value="Отправить">
    </form>
</div>
@endsection
