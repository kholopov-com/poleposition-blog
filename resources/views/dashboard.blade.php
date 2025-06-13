@extends('layouts.app')
@section('content')
    <h1>Редактирование страниц</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('dashboard.update') }}">
        @csrf
        <button type="submit">Сохранить</button><br><br>
        @foreach($pages as $slug => $page)
            <div style="margin-bottom: 30px;">
                <div class="page-editor-block">
                    <label><strong>Заголовок меню ({{ $slug }}):</strong></label><br>
                    <input type="text" name="titles[{{ $slug }}]" value="{{ old("titles.$slug", $page->title) }}" class="page-editor-title"><br>                
                    <label>
                        <input type="checkbox" name="show_in_menu[{{ $slug }}]" value="1"
                            {{ $page->show_in_menu ? 'checked' : '' }}>
                        Показывать в меню
                    </label><br>
                    <label><strong>Содержимое:</strong></label>
                    <textarea name="pages[{{ $slug }}]" rows="6" class="page-editor-textarea">{{ old("pages.$slug", $page->content) }}</textarea>
                </div>
            </div>
        @endforeach
    </form>
@endsection