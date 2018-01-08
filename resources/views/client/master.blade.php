<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="utf-8">
	<meta name = "format-detection" content = "telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
	<title>@yield('head.title')</title>
	<!-- css -->
	<link rel="stylesheet" href="{{ url('public/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('public/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ url('public/css/style.css') }}">
	@yield('head.css')
	<!-- end css -->
</head>
<body>

	@include('admin.partials.menu')<!-- menu -->
	@yield('body.content')<!-- noi dung -->
<!-- 	@include('client.partials.footer') -->
	<!-- footer -->
<!-- javascript -->
	<script src="{{ url('public/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ url('public/js/bootstrap.min.js') }}"></script>
	@yield('body.js')
<!-- end javascript -->
</body>
</html>