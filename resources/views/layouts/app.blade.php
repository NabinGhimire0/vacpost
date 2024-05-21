<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?? "title here "}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">


    {{-- <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <x-nav/>
    <x-post-form/>
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            {{ $slot }}
        </div>
    </div>


    
</body>

</html>
