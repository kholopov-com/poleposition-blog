@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>Восстановление пароля</h2>

    @if (session('status'))
        <div style="color: green;">
            Ссылка для восстановления пароля отправлена на указанный email.
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        @error('email')
            <div style="color: red; margin-top: 5px;">
                {{ $message }}
            </div>
        @enderror

        <input type="submit" value="Отправить ссылку для восстановления">
    </form>

    <div class="auth-links">
        <a href="{{ route('login') }}">Вернуться к входу</a>
    </div>
</div>
@endsection
