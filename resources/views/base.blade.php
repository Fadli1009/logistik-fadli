<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('bootstrap-5.3.3/js/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dist/apexcharts.css') }}">
    <script src="{{ asset('dist/apexcharts.js') }}"></script>
    <style>
        #loading {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            z-index: 9999;
        }

        #content {
            display: none;
        }
    </style>
</head>

<body>
    <div id="loading">Loading...</div>
    @include('partials.navbar')
    <div class="container" id="content">
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        new DataTable('#example');
        window.onload = function() {
            const loadingElement = document.getElementById('loading');
            loadingElement.style.display = 'none';

            const contentElement = document.getElementById('content');
            contentElement.style.display = 'block';
        };
    </script>
</body>

</html>
