<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PLUTUS - POINT OF SALE</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/fabicon.ico') }}">



<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
<link rel="stylesheet" href="{{ url('assets/front/css/app.css') }}">
<script src="{{ url('assets/front/js/app.js') }}"></script>
</head>

<body class="hold-transition dark-mode">
<x-ajaxloader />
<div class="wrapper"> @yield('front-content') </div>
@yield('scripts')
</body>
</html>
