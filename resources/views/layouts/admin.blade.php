<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>POS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/fabicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/admin/css/app.css') }}">
    <!--<link rel="stylesheet" href="{{ url('assets/admin/css/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/css/vendors.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/css/style.bundle.css') }}">-->
    <link rel="stylesheet" href="{{ url('assets/admin/css/dev.css') }}">

    <script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
 var decimalpoints = '2';
</script>
    <script src="{{ url('assets/admin/js/app.js') }}"></script>
<!--    <script src="{{ url('assets/admin/js/datatables.bundle.js') }}"></script>
    <script src="{{ url('assets/admin/js/vendors.bundle.js') }}"></script>
    <script src="{{ url('assets/admin/js/scripts.bundle.js') }}"></script>-->
</head>

<body class="hold-transition dark_mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <x-preloader />
    <x-ajaxloader />
    <div class="wrapper">

        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div> --}}

        @include('admin.includes.header')
        @include('admin.includes.sidenav')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                {{ !empty($data['heading']) && $data['heading'] ? $data['heading'] : 'Dashboard' }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                @foreach ($data['breadcrumb'] as $item)
                                    <li class="breadcrumb-item active">{{ $item }}</li>
                                @endforeach

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('admin-content')
                </div>
            </section>
        </div>
        <div class="loader_section" style="display:none"><span><div class="loader"></div>Loading, Please wait...</span></div>
        @include('admin.includes.footer')

    </div>
    @yield('scripts')
</body>

</html>
