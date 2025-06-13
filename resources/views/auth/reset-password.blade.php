@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>Сброс пароля</h2>

    @if(session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif

@error('system')
    <div style="color: red; margin-bottom: 20px;">
        {{ $message }}
        <div style="margin-top: 10px;">
            <a href="{{ route('password.request') }}" style="color:#c00; font-weight:bold;">Запросить новую ссылку</a>
        </div>
    </div>
@enderror

    <form method="POST" action="/reset-password">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <label for="password">Новый пароль</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div style="color:red;">{{ $message }}</div> @enderror

        <label for="password_confirmation">Подтвердите пароль</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation') <div style="color:red;">{{ $message }}</div> @enderror

        <input type="submit" value="Сбросить пароль">
    </form>

    <div class="auth-links">
        <a href="{{ route('login') }}">Вернуться к входу</a>
    </div>
</div>
@endsection
