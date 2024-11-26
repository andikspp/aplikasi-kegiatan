<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo kemendikbudristek.png') }}">
    <title>@yield('title')</title>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        #page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #content-wrap {
            flex: 1 0 auto;
            padding-bottom: 20px;
        }

        .bg-custom {
            background-color: #0090D4 !important;
        }

        .custom-footer {
            flex-shrink: 0;
        }
    </style>

    @yield('styles')
</head>

<body id="page-container">
    <div id="content-wrap">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-custom text-white text-center text-lg-start custom-footer">
        <div class="text-center p-3">
            © 2024 Guru PAUD Dikmas | All Rights Reserved
        </div>
    </footer>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')

</html>
