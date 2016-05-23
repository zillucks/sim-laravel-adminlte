<!DOCTYPE html>
<html>
<head>
    @include('layouts.header')
</head>
<body class="hold-transition skin-blue-light layout-top-nav">
<div class="wrapper">
    <div class="main-header">
		<nav class="navbar navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/') }}">SIM Apotek Subur Farma</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>

				{{-- Collect nav links and other content for toggling --}}
				<div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
					{!! Form::open(['url' => '/customlogin', 'method' => 'post', 'class' => 'navbar-form', 'role' => 'login']) !!}
					<div class="form-group">
						{!! Form::text('username', old('username'), ['class' => 'form-control input-sm', 'placeholder' => 'Username']) !!}
						{!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Password']) !!}
					</div>
					<button type="submit" class="btn btn-sm btn-default btn-flat"><i class="fa fa-fw fa-sign-in"></i> Sign in</button>
					{!! Form::close() !!}
				</div>
			</div>
		</nav>
	</div>
    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>Welcome to SIM Apotek Subur Farma</h1>
                <p>Description goes here</p>
            </section>
        </div>
    </div>
</div>

@include('layouts.footscript')

</body>
</html>