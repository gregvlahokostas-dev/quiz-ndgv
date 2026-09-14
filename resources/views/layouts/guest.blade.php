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
<div class="auth-page">
    <div class="auth-card">
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none">
                <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
                     style="width: 64px; height: 64px; background: linear-gradient(135deg, #3b82f6, #4f46e5);">
                    <i class="bi bi-patch-check-fill text-white fs-2"></i>
                </div>
                <h1 class="h3 fw-bold text-dark mb-0">Quiz ΑΣΕΠ</h1>
            </a>
        </div>

        {{ $slot }}
    </div>
</div>

@stack('scripts')
</body>
</html>
