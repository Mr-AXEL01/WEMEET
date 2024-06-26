<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title >{{ config('app.name', 'WEMEET') }}</title>

    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @routes
    @inertiaHead
</head>
<body class="font-sans antialiased bg-gray-100  lg:overflow-hidden lg:h-full">
@inertia
</body>
</html>
