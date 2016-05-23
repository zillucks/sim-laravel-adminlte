@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-briefcase bg-red"></i>
	Jabatan, <small>Atur Jenis Jabatan</small>
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Data Jabatan</h3>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<thead>
					<th>#</th>
					<th>Kode Jabatan</th>
					<th>Jabatan</th>
					<th><i class="fa fa-fw fa-wrench"></i></th>
					</thead>
					<tbody>
					@foreach($jabatans as $key => $jabatan)
						<tr>
							<td>{!! ++$key !!}</td>
							<td>{!! $jabatan->kdjabatan !!}</td>
							<td>{!! $jabatan->jabatan !!}</td>
							<td>settings goes here...</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm pull-right">
					<li>{!! $jabatans->links() !!}</li>
				</ul>
			</div>
		</div>
	</div>
@endsection