<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Маска телефона
        const input = document.querySelector('input[name="phone"]');
        if (input) {
            input.addEventListener('input', function () {
                let value = input.value.replace(/\D/g, '');
                if (value.startsWith('8')) value = '7' + value.slice(1);
                if (!value.startsWith('7')) value = '7' + value;

                let formatted = '+7(';
                if (value.length > 1) formatted += value.slice(1, 4);
                if (value.length >= 4) formatted += ')-' + value.slice(4, 7);
                if (value.length >= 7) formatted += '-' + value.slice(7, 9);
                if (value.length >= 9) formatted += '-' + value.slice(9, 11);

                input.value = formatted;
            });
            input.addEventListener('blur', function () {
                if (input.value.length < 17) {
                    input.setCustomValidity("Введите полный номер телефона в формате +7(XXX)-XXX-XX-XX");
                } else {
                    input.setCustomValidity("");
                }
            });
        }

        // Темная тема
        const body = document.body;
        const toggleBtn = document.getElementById('themeToggle');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme === 'dark') {
            body.classList.add('dark');
            if (toggleBtn) toggleBtn.textContent = '☀';
        }

        window.toggleTheme = function () {
            body.classList.toggle('dark');
            const isDark = body.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            if (toggleBtn) toggleBtn.textContent = isDark ? '☀' : '🌙';
        };
    });
</script>
<body>
    <div class="wrapper">
        <nav>
            @php
                use App\Models\Page;
                $menuPages = Page::where('show_in_menu', 1)->orderBy('id')->get();
            @endphp
            @foreach ($menuPages as $page)
                <a href="{{ route($page->slug) }}">{{ $page->title }}</a>
            @endforeach

            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('applications.index') }}">Админка</a>
                @else
                    <a href="{{ route('cabinet') }}">Кабинет</a>
                    <a href="{{ route('application') }}">Карточка</a>
                @endif

                <span style="margin-left: 15px; font-weight: bold; color: #fff;">
                    {{ auth()->user()->username }}
                </span>
                <span style="color: #fff; margin: 0 8px;">|</span>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-link">Выход</button>
                </form>
            @else
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
            @endauth

            {{-- Переключатель темы --}}
<a href="#" onclick="toggleTheme(); return false;" id="themeToggle" class="theme-toggle">🌙</a>        </nav>

        @auth
            @if (auth()->user()->is_admin)
                <div style="margin: 15px 15px 0 15px; padding-top: 10px; border-top: 1px solid #ccc;">
                    <strong>Администрирование:</strong><br>
                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}">Страницы</a><br>
                    @endif
                    @if (Route::has('applications.index'))
                        <a href="{{ route('applications.index') }}">Карточки книг</a><br>
                    @endif
                </div>
            @endif
        @endauth

        <div class="container">
            @yield('content')
        </div>    

        <footer class="site-footer">
            <div class="container">
                <p>&copy; {{ date('Y') }} Kholopov.ru — Все права защищены</p>
            </div>
        </footer>
    </div>
</body>
</html>
