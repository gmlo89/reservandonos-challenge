<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Reservandonos') }}</title>
    @routes()
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <PlacesList/>
        <places-list></places-list>
    </div>
</body>

</html>