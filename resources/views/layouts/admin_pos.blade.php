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
<link rel="stylesheet" href="{{ url('assets/admin/css/dev.css') }}">
<link rel="stylesheet" href="{{ url('assets/admin/css/pos.css') }}">
<script>
 var base_url = "{{url('/')}}";
 var csrf_token = "{{csrf_token()}}";
 var prop = <?php echo json_encode(array('url'=>url('/'), 'ajaxurl' => url('/ajaxpost'),  'csrf_token'=>csrf_token()));?>;
</script>
<script src="{{ url('assets/admin/js/app.js') }}"></script>
</head>

<body class="hold-transition dark_mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse" id="fullscreen">
<x-preloader />
<x-ajaxloader />
<div class="wrapper"> @include('admin.includes.posheader')
  @include('admin.includes.sidenav')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid"> @yield('admin-content') </div>
    </section>
  </div>
</div>
@yield('scripts') 
<script>
	$(document).on('click','.nav-link-btn',function(){
		if ($( "#navbar-nav" ).hasClass('active')) {
			$( "#navbar-nav" ).removeClass( 'active');
		} else {
			$( "#navbar-nav" ).addClass( 'active');
		}
		
	});
	</script>
</body>
</html>
