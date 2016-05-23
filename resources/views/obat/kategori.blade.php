@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-th-list"></i>
	Kategori Obat, <small>Penggolongan obat</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Daftar Kategori Obat</h3>
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
						<th>#</th>
						<th>Kode Kategori</th>
						<th>Kategori</th>
						<th><i class="fa fa-fw fa-wrench"></i></th>
						<tbody>
						@foreach($kategories as $key => $kategori)
							<tr>
								<td>{!! ++$key !!}</td>
								<td>{!! $kategori->kdkategori !!}</td>
								<td><a href="#" class="kategori" id="kategori" data-type="text" data-url="{{ route('obat::updatekategori') }}" data-pk="{!! $kategori->kdkategori !!}" data-placeholder="required" data-title="Enter Kategori">{!! $kategori->kategori !!}</a></td>
								<td>
									{!! Form::open(['route' => ['obat::hapuskategori', $kategori->kdkategori], 'method' => 'delete', 'onsubmit' => 'return confirm("Data akan dihapus. Lanjutkan?");']) !!}
									<button type="submit" class="btn-link text-red" title="Hapus Kategori">
										<i class="fa fa-fw fa-lg fa-trash"></i>
									</button>
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach()
						</tbody>
						<tfoot>
						<td><i class="fa fa-plus-circle"></i></td>
						<td colspan="3">
							{!! Form::open(['method' => 'post', 'class' => 'form form-inline']) !!}
							<div class="form-group">
								{!! Form::label('kdkategori', 'Tambah Kategori Baru', ['class' => 'control-label', 'style' => 'padding-right: 5px']) !!}
								{!! Form::text('kdkategori', '', ['class' => 'form-control input-sm', 'placeholder' => 'Kode Kategori']) !!}
								{!! Form::text('kategori', '', ['class' => 'form-control input-sm', 'placeholder' => 'Kategori']) !!}
							</div>
							<button type="submit" class="btn btn-sm btn-warning btn-flat" disabled="disabled"><i class="fa fa-fw fa-plus"></i></button>
							{!! Form::close() !!}
						</td>
						</tfoot>
					</table>
				</div>
				@if($kategories->total() > $kategories->perPage())
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li>{!! $kategories->links() !!}</li>
						</ul>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('scripts/x-kategori.js') }}"></script>
@endsection