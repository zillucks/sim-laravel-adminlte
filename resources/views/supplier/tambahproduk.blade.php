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
								<div class="form-inline">
									<div class="form-group ui-widget">
										<label for="autocomplete">Cari Produk</label>
										<input type="text" id="autocomplete" name="kdbarang" class="form-control" placeholder="Cari Produk">
									</div>
									<div class="form-group">
										<input type="text" name="harga" class="form-control">
									</div>
									<button type="button" class="btn btn-small btn-success"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div class="box no-header no-border">
							<div class="box-body">
								Temp view list produk akan ditambahkan, simpan jika ok, dismiss jika batal
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ elixir('js/jquery-ui-custom.js') }}"></script>
	{{--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>--}}
	<script src="{{ asset('scripts/_addproduk.js') }}"></script>
@endsection