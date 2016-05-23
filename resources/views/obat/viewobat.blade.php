@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-plus-square"></i>
	Form Obat, <small>Tambah data baru</small>
@endsection
<style>
	label {
		text-align: right;
		padding-right: 10px;
	}
</style>
@section('content')
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Form Tambah Obat</h3>
				<div class="box-tools pull-right">
					<a class="btn btn-sm" href="{{ route('obat::obat') }}" title="Batal">
						<i class="fa fa-lg fa-times"></i>
					</a>
				</div>
			</div>
			<div class="box-body with-border">
				{!! Form::open(['method' => 'post', 'route' => 'obat::saveobat', 'class' => 'form-horizontal']) !!}

				<div class="form-group {{ $errors->has('kdbarang') ? 'has-error' : '' }}">
					{!! Form::label('kdbarang', 'Kode Obat', ['class'=> 'control-label col-xs-3 col-md-3']) !!}
					<div class="col-xs-6 col-md-6 input-group">
						{!! Form::text('kdbarang', old('kdbarang'), ['class' => 'form-control', 'placeholder' => 'Kode Obat']) !!}
						@if($errors->has('kdbarang'))
							<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
								{!! $errors->first('kdbarang') !!}
							</span>
						@endif
					</div>
				</div>

				<div class="form-group {{ $errors->has('kdkategori') ? 'has-error' : '' }}">
					{!! Form::label('kdkategori', 'Kategori', ['class'=> 'control-label col-xs-3 col-md-3']) !!}
					<div class="col-xs-6 col-md-6 input-group">
						{!! Form::select('kdkategori', $ddlkategori, old('kdkategori'), ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group {{ $errors->has('namabarang') ? 'has-error' : '' }}">
					{!! Form::label('namabarang', 'Nama Obat', ['class'=> 'control-label col-xs-3 col-md-3']) !!}
					<div class="col-xs-6 col-md-6 input-group">
						{!! Form::text('namabarang', old('namabarang'), ['class' => 'form-control', 'placeholder' => 'Nama Obat']) !!}
						@if($errors->has('namabarang'))
							<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
								{!! $errors->first('namabarang') !!}
							</span>
						@endif
					</div>
				</div>

				<div class="form-group {{ $errors->has('satuan') ? 'has-error' : '' }}">
					{!! Form::label('satuan', 'Satuan', ['class'=> 'control-label col-xs-3 col-md-3']) !!}
					<div class="col-xs-6 col-md-6 input-group">
						{!! Form::text('satuan', old('satuan'), ['class' => 'form-control', 'placeholder' => 'Satuan']) !!}
						@if($errors->has('satuan'))
							<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
								{!! $errors->first('satuan') !!}
							</span>
						@endif
					</div>
				</div>

				<div class="form-group {{ $errors->has('stokmin') ? 'has-error' : '' }}">
					{!! Form::label('stokmin', 'Stok Minimal', ['class'=> 'control-label col-xs-3 col-md-3']) !!}
					<div class="col-xs-6 col-md-6 input-group">
						{!! Form::text('stokmin', old('stokmin'), ['class' => 'form-control', 'placeholder' => 'Stok Minimal']) !!}
						@if($errors->has('stokmin'))
							<span class="help-block">
								<i class="fa fa-fw fa-exclamation"></i>
								{!! $errors->first('stokmin') !!}
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-3 col-md-3"></div>
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
@endsection