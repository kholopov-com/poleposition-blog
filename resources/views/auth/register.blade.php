@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>Регистрация</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="username">Логин</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
        @error('username') <div style="color:red;">{{ $message }}</div> @enderror

        <label for="full_name">ФИО</label>
        <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" required>
        @error('full_name') <div style="color:red;">{{ $message }}</div> @enderror

<label for="phone">Телефон</label>
<input id="phone" type="text" name="phone" value="{{ old('phone') }}" required>
@error('phone') <div style="color:red;">{{ $message }}</div> @enderror


        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div style="color:red;">{{ $message }}</div> @enderror

        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div style="color:red;">{{ $message }}</div> @enderror

        <label for="password_confirmation">Повторите пароль</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <input type="submit" value="Зарегистрироваться">
    </form>

    <div class="auth-links">
        <a href="{{ route('login') }}">Уже зарегистрированы?</a>
    </div>
</div>
@endsection
