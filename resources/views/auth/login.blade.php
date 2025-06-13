@extends('layouts.app')
@section('content')
<div class="auth-container">
    <h2>Вход</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="username">Логин</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
        @error('username') <div style="color:red;">{{ $message }}</div> @enderror

        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div style="color:red;">{{ $message }}</div> @enderror

        <input type="submit" value="Войти">
    </form>
    <div class="auth-links">
        <a href="{{ route('password.request') }}">Забыли пароль?</a>
    </div>
</div>
@endsection