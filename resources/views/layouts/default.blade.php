<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">
    @include('layouts.components.header')

    <!-- Nội dung chính -->
    <main class="container mx-auto mt-8 pb-24 flex-grow px-8">
        @yield('content')
    </main>

    @include('layouts.components.navigation')

    <script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('js')
</body>

</html>
