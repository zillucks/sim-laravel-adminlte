<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	@include('layouts.header')
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	@include('layouts.navigation')
	
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		@include('layouts.sidebar')
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>@yield('page-header')</h1>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Your Page Content Here -->
			@yield('content')

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- Default to the left -->
		<div class="pull-left">
			<strong>Copyright &copy; 2016 <a href="{{ url('/') }}">Apotek Subur Farma</a>.</strong> All rights reserved.
		</div>
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Powered by <a href="https://laravel.com" target="_blank">Laravel</a>,
			Designed with <a href="https://almsaeedstudio.com/themes/AdminLTE/index.html" target="_blank">AdminLTE</a>
		</div>
	</footer>

	@if(Auth::user()->hasLevel('administrator') || Auth::user()->hasLevel('manager'))
		@include('layouts.rightbar')
		<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	@endif
</div>
<!-- ./wrapper -->
@section('scripts')
	@include('layouts.footscript')
@show
</body>
</html>