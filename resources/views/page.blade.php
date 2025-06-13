@extends('layouts.app')
@section('content')
    <h1>{{ $page->title }}</h1>
    @php
        $imagePath = "images/{$page->slug}.png"; // <- здесь должно быть правильное расширение
    @endphp
    @if(file_exists(public_path($imagePath)))
        <img src="{{ asset($imagePath) }}" alt="{{ $page->title }}" class="page-image">
    @endif
    <p>{!! nl2br(e($page->content)) !!}</p>
@endsection