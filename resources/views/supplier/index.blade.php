@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-truck"></i>
	Supplier, <small>Daftar supplier</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{{--alert based on session--}}
			@if(session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif
			@if(session('danger'))
				<div class="alert alert-error">{{ session('danger') }}</div>
			@endif
			{{--/.alert--}}

			<div class="box box-solid no-border no-padding table-responsive">
				<div class="box-header with-border">
					<h3 class="box-title">Daftar Supplier</h3>
					@if(Auth::user()->hasLevel('administrator') || Auth::user()->hasLevel('manager'))
						<div class="box-tools pull-right">
							<a class="btn-box-tool" href="{{ route('supplier::tambahsupplier') }}" title="Tambah Data Supplier">
								<i class="fa fa-lg fa-plus"></i>
							</a>
						</div>
					@endif
				</div>
				<div class="box-body">
					<meta name="csrf-token" content="{{ csrf_token() }}">
					<div class="box-group" id="accordion">
						@foreach($suppliers as $key => $supplier)
							<div id="editable-field" class="panel box no-border" data-pk="{!! $supplier->kdsupplier !!}" data-url="{{ route('supplier::updatesupplier') }}">
								<div class="box-header with-border">
									<div class="box-title">
										<a href="#" class="namasupplier" id="namasupplier" data-type="text" data-pk="{!! $supplier->kdsupplier !!}">{!! $supplier->namasupplier !!}</a>
									</div>
									<div class="box-tools pull-right">
										<a class="btn-box-tool" data-toggle="collapse" data-parent="#accordion" href="#produk-{!! str_slug($supplier->namasupplier) !!}">
											<i class="fa fa-eye"></i>
										</a>
									</div>
								</div>
								<div id="produk-{!! str_slug($supplier->namasupplier) !!}" class="panel-collapse collapse">
									<div class="box-body no-padding">
										<div class="col-xs-12 col-md-3">
											<div class="box no-padding">
												<div class="box-header">
													<span class="text-info">Detail Supplier</span>
												</div>
												<div id="supplier-detail" class="box-body table-responsive">
													<div class="form-inline visible-xs">
														<div class="row form-group">
															<label for="contactperson" class="control-label col-xs-4">Contact Person</label>
															<div class="col-xs-8">
																<a href="#" class="contactperson" id="contactperson" data-type="text"
																   data-mode="inline">{!! $supplier->contactperson !!}</a>
															</div>
														</div>
														<div class="row form-group">
															<label for="email" class="control-label col-xs-4">E-mail</label>
															<div class="col-xs-8">
																<a href="#" class="email" id="email" data-type="email" data-mode="inline"
																   data-placeholder="E-mail">{!! $supplier->email !!}</a>
															</div>
														</div>
														<div class="row form-group">
															<label for="notelp" class="control-label col-xs-4">No. Telp</label>
															<div class="col-xs-8">
																<a href="#" class="notelp" id="notelp" data-type="text" data-mode="inline"
																   data-placeholder="No. Telp">{!! $supplier->notelp !!}</a>
															</div>
														</div>
														<div class="row form-group">
															<label for="nohp" class="control-label col-xs-4">No. HP</label>
															<div class="col-xs-8">
																<a href="#" class="nohp" id="nohp" data-type="text" data-mode="inline"
																   data-placeholder="No. HP">{!! $supplier->nohp !!}</a>
															</div>
														</div>
														<div class="row form-group">
															<label for="alamat" class="control-label col-xs-4">Alamat</label>
															<div class="col-xs-8">
																<a href="#" class="alamat" id="alamat" data-type="textarea" data-mode="inline"
																   data-placeholder="Alamat">{!! $supplier->alamat !!}</a>
															</div>
														</div>
													</div>
													<div class="hidden-xs">
														<ul class="list-unstyled">
															<li><a href="#" class="contactperson" id="contactperson" data-type="text">{!! $supplier->contactperson !!}</a></li>
															<li><a href="#" class="email" id="email" data-type="email" data-placeholder="E-mail">{!! $supplier->email !!}</a></li>
															<li><a href="#" class="notelp" id="notelp" data-type="text" data-placeholder="No. Telp">{!! $supplier->notelp !!}</a></li>
															<li><a href="#" class="nohp" id="nohp" data-type="text" data-placeholder="No. HP">{!! $supplier->nohp !!}</a></li>
															<li><a href="#" class="alamat" id="alamat" data-type="textarea" data-placeholder="Alamat">{!! $supplier->alamat !!}</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-9 with-border">
											<div class="box no-border no-padding">
												<div class="box-header">
													<h4 class="box-title text-info">Daftar produk dijual</h4>
													<div class="box-tools pull-right">
														<a href="{{ route('supplier::tambahproduk', $supplier->kdsupplier) }}" title="Tambah Produk Supplier">
															<i class="fa fa-plus"></i>
														</a>
													</div>
												</div>
												<div class="box-body">
													<table class="table table-condensed table-bordered">
														<thead>
														<tr>
															<th>#</th>
															<th>Produk</th>
															<th>Harga</th>
														</tr>
														</thead>
														<tbody>
														@foreach($supplier->barangs()->orderBy('namabarang', 'asc')->get() as $subkey => $produk)
															<tr>
																<td>{!! ++$subkey !!}</td>
																<td>{!! $produk->namabarang !!}</td>
																<td>{!! $produk->harga !!}</td>
															</tr>
														@endforeach
														</tbody>
													</table>
												</div>
												</div>
											</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('scripts/x-supplier.js') }}"></script>
@endsection