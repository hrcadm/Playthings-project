<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ ENV('APP_NAME') }} | @yield('page_title')</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

	<!-- Webpack CSS -->
	<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">


</head>

<body>

<!-- Main navbar start -->
@include('partials.main-navbar')
<!-- Main navbar end -->

<!-- Second navbar start -->
@include('partials.second-navbar')
<!-- Second navbar end -->

<!-- Header start -->
@include('partials.header')
<!-- Header end -->

<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page content start -->
			@yield('content')
			<!-- Page content end -->

		</div>
		<!-- Main content end -->
	</div>
	<!-- Page content end -->
</div>
<!-- Page container end -->

<!-- Footer start -->
@include('partials.footer')
<!-- Footer end -->


{{-- WEBPACK JAVASCRIPTS --}}
<script src="{{ asset('js/scripts.js') }}"></script>

{{-- CUSTOM JAVASCRIPTS --}}
@yield('javascripts')

</body>
</html>