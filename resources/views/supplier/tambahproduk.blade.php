@extends('layouts.app')

@section('page-header')
	<i class="fa fa-plus"></i>
	Tambah Produk <small>tambah produk supplier</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{!! $supplier->namasupplier !!}</h3>
					<div class="box-tools pull-right">
						<a href="{{ route('supplier::supplier') }}" data-tooltip="Batal"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-body">
					<h5 class="text-info">Tambah Produk {!! $supplier->namasupplier !!}</h5>
					<div class="box-group">
						<div class="box no-header no-border">
							<div class="box-body">
								<div class="form-inline col-xs-12 col-md-10 col-md-offset-1">
									<div class="form-group ui-widget">
										<label for="autocomplete">Cari Produk</label>
										<input type="text" id="autocomplete" data-id="" name="kdbarang" class="form-control" placeholder="Cari Produk">
									</div>
									<div class="form-group">
                                        <label for="harga" class="sr-only">Harga</label>
										<input type="text" id="harga" name="harga" class="form-control" placeholder="Harga Supplier">
									</div>
                                    <button id="btn-add-produk" type="button" class="btn btn-small btn-success"><i class="fa fa-plus"></i></button>
                                </div>
                                <div id="error-block" class="col-xs-12 col-md-10 col-md-offset-1"></div>
							</div>
						</div>
						<div class="box no-header no-border">
							<div class="box-body">
								<table class="table table-bordered table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga Supplier</th>
                                        <th><i class="fa fa-fw fa-wrench"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbl-produk" data-url="{{ route('supplier::saveproduk', $supplier->kdsupplier) }}"></tbody>
                                    <tfoot id="produk-submit"></tfoot>
                                </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		{{ dump(getDataProduk($supplier->kdsupplier)) }}
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ elixir('js/jquery-ui-custom.js') }}"></script>
	<script src="{{ asset('scripts/_addproduk.js') }}"></script>
@endsection