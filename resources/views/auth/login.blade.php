<!DOCTYPE html>
<html>
<head>
	@include('layouts.header')
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="{{ url('/') }}"><b>SIM</b><small>Apotek Subur Farma</small></a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg"><i class="fa fa-fw fa-user"></i> Sign in</p>

		{!! Form::open() !!}
			<div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
				{!! Form::text('username', old('username'), ['class'=>'form-control', 'placeholder'=>'Username']) !!}
				<!-- <input type="text" name="username" class="form-control" placeholder="Username"> -->
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				@if($errors->has('username'))
					<span class="help-block">
						<strong class="text-danger">{{ $errors->first('username') }}</strong>
					</span>
				@endif()
			</div>
			<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
				{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if($errors->has('password'))
					<span class="help-block">
						<strong class="text-danger">{{ $errors->first('password') }}</strong>
					</span>
				@endif()
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				<div class="checkbox">
						<label>
							{!! Form::checkbox('remember') !!} Remember Me!
							<!-- <input type="checkbox"> Remember Me -->
						</label>
					</div>
			</div>
		{!! Form::close() !!}

		<p><a href="#">I forgot my password</a></p>
		<p><a href="{{ url('auth.register') }}" class="text-center">Register a new membership</a></p>

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@include('layouts.footscript')
</body>
</html>