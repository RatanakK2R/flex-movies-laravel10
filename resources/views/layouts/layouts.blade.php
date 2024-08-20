<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/slider-radio.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/plyr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>

    @yield('content')


	<!-- JS -->
	<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/slider-radio.js')}}"></script>
	<script src="{{asset('assets/js/select2.min.js')}}"></script>
	<script src="{{asset('assets/js/smooth-scrollbar.js')}}"></script>
	<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('assets/js/plyr.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
	@yield('scripts')
</body>
</html>