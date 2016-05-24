@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-truck"></i>
	Supplier, <small>Daftar supplier</small>
@endsection

@section('content')
	<div class="row">
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
					<table class="table table-condensed">
						<thead>
						<tr>
							<th>#</th>
							<th>Nama Supplier</th>
							<th>Kontak Person</th>
							<th>Alamat</th>
							<th></th>
						</tr>
						</thead>
						<tbody class="editable" data-url="{{ route('supplier::updatesupplier') }}">
						@foreach($suppliers as $key => $supplier)
							<tr>
								<td>{!! ++$key !!}</td>
								<td><a href="#" class="namasupplier" id="namasupplier" data-type="text" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->namasupplier !!}</a></td>
								<td>
									<a href="#" class="contactperson" id="contactperson" data-type="text" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->contactperson !!}</a>
									<a href="#" class="nohp" id="nohp" data-type="text" data-pk="{!! $supplier->kdsupplier !!}"><small>({!! $supplier->nohp !!})</small></a>
								</td>
								<td><a href="#" class="alamat" id="alamat" data-type="textarea" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->alamat !!}</a></td>
								<td><a href="{{ route('supplier::produk', $supplier->kdsupplier) }}" title="Lihat Daftar Produk yg Ditawarkan"><i class="fa fa-fw fa-eye"></i></a></td>
							</tr>
							<tr class="collapse">
								<td colspan="6" style="padding-left: 10%">
									<table class="table table-bordered table-condensed">
										<thead>
										<tr>
											<th>#</th>
											<th>Nama Barang</th>
											<th>Harga Supplier</th>
										</tr>
										</thead>
										<tbody>
										@foreach($supplier->barangs as $subkey => $produk)
											<tr>
												<td>{!! ++$subkey !!}</td>
												<td>{!! $produk->namabarang !!}</td>
												<td>{!! $produk->harga !!}</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('scripts/x-supplier.js') }}"></script>
@endsection