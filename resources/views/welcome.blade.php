<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Este sitio web te permitirá encontrar Gifs animados, imágenes y videos. Fuentes: Giphy y Pixabay">

    <title>Images,Video&Gifs</title>

    <!-- Styles -->

    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles

</head>

<body class="antialiased">
    <div class="container mx-auto bg-gray-900 text-white">
        @livewire('show')
    </div>

    @livewireScripts
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>