<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz ΑΣΕΠ') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
<div class="min-vh-100">
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white border-bottom">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        {{ $slot }}
    </main>
</div>

@stack('scripts')
</body>
</html>
