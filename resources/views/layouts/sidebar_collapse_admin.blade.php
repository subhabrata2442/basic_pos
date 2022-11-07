<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>POS</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ url('assets/admin/css/app.css') }}">
<link rel="stylesheet" href="{{ url('assets/admin/css/dev.css') }}">
<script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
 var decimalpoints = '2';
</script>
<script src="{{ url('assets/admin/js/app.js') }}"></script>
</head>


<body class="hold-transition  layout-fixed sidebar-mini sidebar-collapse">
<!--<body class="hold-transition dark_mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">-->
<x-preloader />
<x-ajaxloader />
<div class="wrapper"> @include('admin.includes.header')
  @include('admin.includes.sidenav')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {{ !empty($data['heading']) && $data['heading'] ? $data['heading'] : 'Dashboard' }} </h1>
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
      <div class="container-fluid"> @yield('admin-content') </div>
    </section>
  </div>
  <div class="loader_section" style="display:none"><span>
    <div class="loader"></div>
    Loading, Please wait...</span></div>
    
</div>
@yield('scripts')
</body>
</html>
