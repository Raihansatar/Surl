<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SURL</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">


</head>
<body>
    {{-- <header> --}}
        @include('panels.navbar')
    {{-- </header> --}}
    <main>
        <div class="container mt-4 gy-2">
            @yield('contents')
        </div>
    </main>
    
    <footer class="footer mt-auto py-3 bg-dark fixed-bottom">
        @include('panels.footer')
    </footer>


    <script src=" {{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    @stack('custom-js')
</body>
</html>