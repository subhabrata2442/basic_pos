<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/fabicon.ico') }}">
    <title>POS</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/new/fonts/stylesheet.css') }}" media="all">
    <link rel="stylesheet" href="{{ url('assets/admin/new/css/bootstrap.css') }}" media="all">
    <link rel="stylesheet" href="{{ url('assets/admin/new/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/new/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/new/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/new/css/style.css') }}" media="all">
</head>
<body>
	@yield('mainContent')

    <section class="bodyBg" style="background: url({{ url('assets/admin/new/images/body-bg.jpg') }});"></section>
    <script type="text/javascript" src="{{ url('assets/admin/new/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/new/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/admin/new/js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/new/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/new/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
          $('.posCarousel').owlCarousel({
            items: 1,
            margin:10,
            autoHeight: true
          });
        })
      </script>
      @yield('scripts')
</body>
</html>