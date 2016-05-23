@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-truck"></i>
	Supplier, <small>Daftar supplier</small>
@endsection

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Daftar Supplier</h3>
				@if(Auth::user()->hasLevel('administrator') || Auth::user()->hasLevel('manager'))
					<div class="box-tools pull-right">
						<a href="{{ route('supplier::tambahsupplier') }}" title="Tambah Data Supplier" class="btn btn-sm btn-info">
							<i class="fa fa-fw fa-plus"></i>
						</a>
					</div>
				@endif
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
					<tr>
						<th>#</th>
						<th>Nama Supplier</th>
						<th>Kontak Person</th>
						<th>Alamat</th>
						<th>Daftar Produk</th>
					</tr>
					</thead>
					<tbody class="editable" data-url="{{ route('supplier::updatesupplier') }}">
					@foreach($suppliers as $key => $supplier)
						<tr>
							<td>{!! ++$key !!}</td>
							<td><a href="#" class="namasupplier" id="namasupplier" data-type="text" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->namasupplier !!}</a></td>
							<td><a href="#" class="contactperson" id="contactperson" data-type="text" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->contactperson !!}</a></td>
							<td><a href="#" class="alamat" id="alamat" data-type="textarea" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->alamat !!}</a></td>
							<td><i class="fa fa-fw fa-eye"></i></td>
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
	<script src="{{ asset('scripts/x-supplier.js') }}"></script>
@endsection