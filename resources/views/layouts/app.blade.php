<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-gray-50">
    <div class="mt-8 container mx-auto w-full">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>
