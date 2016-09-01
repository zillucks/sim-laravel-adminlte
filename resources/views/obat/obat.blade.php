@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-medkit"></i>
	Daftar Obat, <small>Daftar obat tersedia</small>
@endsection

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Daftar Obat</h3>
				<div class="box-tools">
					<div class="pull-right">
						<a href="{{ route('obat::tambahobat') }}" title="Tambah Data Obat" class="btn btn-link">
							<i class="fa fa-fw fa-plus"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="box-body table-responsive no-padding">
				@if(session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif
				@if(session('danger'))
					<div class="alert alert-error">{{ session('danger') }}</div>
				@endif
				<meta name="csrf-token" content="{{ csrf_token() }}">
				<table class="table table-hover">
					<thead>
					<th>#</th>
					<th>Nama Obat</th>
					<th>Kategori</th>
					<th>Satuan</th>
					<th>Stok</th>
					<th>Stok Minimal</th>
					<th>Harga Jual</th>
					</thead>
					<tbody id="editable" data-url="{{ route('obat::updateobat') }}">
					@foreach($obats as $key => $obat)
						<tr>
							<td>{!! ++$key !!}</td>
							<td><a href="#" class="namabarang" id="namabarang" data-type="text" data-pk="{!! $obat->kdbarang !!}">{!! $obat->namabarang !!}</a></td>
							<td><a href="#" class="kdkategori" id="kdkategori" data-type="select" data-source="{{ $ddlkategori }}" data-value="{!! $obat->kdkategori !!}" data-pk="{!! $obat->kdbarang !!}">{!! $obat->kategories->kategori !!}</a></td>
							{{--<td>{!! $obat->kategories->kategori !!}</td>--}}
							<td><a href="#" class="satuan" id="satuan" data-type="text" data-pk="{!! $obat->kdbarang !!}">{!! $obat->satuan !!}</a></td>
							<td>{!! $obat->stok!!}</td>
							<td>{!! $obat->stokmin !!}</td>
							<td>{!! $obat->hargajual !!}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('scripts/x-obat.js') }}"></script>
@endsection