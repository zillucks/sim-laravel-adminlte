@extends('layouts.app')

@section('page-header')
	<i class="fa fa-plus-square text-info"></i>
	Tambah Supplier, <small>input data supplier baru</small>
@endsection

<style>
	label {
		text-align: right;
		padding-right: 10px;
	}
</style>
@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<div class="box with-border">
				<div class="box-header">
					<h3 class="box-title">Tambah Supplier Baru</h3>
					<div class="box-tools pull-right">
						<a class="btn btn-sm" href="{{ url('supplier') }}" title="Batal">
							<i class="fa fa-lg fa-times"></i>
						</a>
					</div>
				</div>
				<div class="box-body">
					{!! Form::open(['method' => 'post', 'route' => 'supplier::savesupplier', 'class' => 'form-horizontal']) !!}

					<div class="form-group {{ $errors->has('kdsupplier') ? 'has-error' : '' }}">
						{!! Form::label('kdsupplier', 'Kode Supplier', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('kdsupplier', old('kdsupplier'), ['class' => 'form-control', 'placeholder' => 'Kode Supplier']) !!}
							@if($errors->has('kdsupplier'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('kdsupplier') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('namasupplier') ? 'has-error' : '' }}">
						{!! Form::label('namasupplier', 'Nama Supplier', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('namasupplier', old('namasupplier'), ['class' => 'form-control', 'placeholder' => 'Nama Supplier']) !!}
							@if($errors->has('namasupplier'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('namasupplier') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('contactperson') ? 'has-error' : '' }}">
						{!! Form::label('contactperson', 'Contact Person', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('contactperson', old('contactperson'), ['class' => 'form-control', 'placeholder' => 'Contact Person']) !!}
							@if($errors->has('contactperson'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('contactperson') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('notelp') ? 'has-error' : '' }}">
						{!! Form::label('notelp', 'No. Telp', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('notelp', old('notelp'), ['class' => 'form-control', 'placeholder' => 'No. Telp']) !!}
							@if($errors->has('notelp'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('notelp') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('nohp') ? 'has-error' : '' }}">
						{!! Form::label('nohp', 'No. HP', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('nohp', old('nohp'), ['class' => 'form-control', 'placeholder' => 'No. HP']) !!}
							@if($errors->has('nohp'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('nohp') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{!! Form::label('email', 'E-mail', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
							@if($errors->has('email'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('email') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
						{!! Form::label('alamat', 'Alamat', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::textarea('alamat', old('alamat'), ['class' => 'form-control', 'placeholder' => 'Alamat', 'rows' => '4']) !!}
							@if($errors->has('alamat'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('alamat') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }}">
						{!! Form::label('kota', 'Kota', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('kota', old('kota'), ['class' => 'form-control', 'placeholder' => 'Kota']) !!}
							@if($errors->has('kota'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('kota') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('propinsi') ? 'has-error' : '' }}">
						{!! Form::label('propinsi', 'Propinsi', ['class'=> 'control-label col-xs-4 col-md-3']) !!}
						<div class="col-xs-6 col-md-6 input-group">
							{!! Form::text('propinsi', old('propinsi'), ['class' => 'form-control', 'placeholder' => 'Propinsi']) !!}
							@if($errors->has('propinsi'))
								<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
									{!! $errors->first('propinsi') !!}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('propinsi') ? 'has-error' : '' }}">
						<div class="col-xs-4 col-md-3"></div>
						<div class="col-xs-6 col-md-6 input-group">
							<button type="submit" class="btn btn-sm btn-flat btn-info form-control col-xs-6 col-md-6">
								<i class="fa fa-floppy-o"></i> Simpan
							</button>
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection