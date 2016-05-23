@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-users"></i>
	User, <small>Atur User sistem</small>
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Data User</h3>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<thead>
					<th>#</th>
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Username</th>
					<th>Role</th>
					</thead>
					<tbody>
					@foreach($users as $key => $user)
						<tr>
							<td>{!! ++$key !!}</td>
							<td>{!! $user->karyawans->namadepan . ' ' . $user->karyawans->namabelakang !!}</td>
							<td>{!! $user->karyawans->jabatans->jabatan !!}</td>
							<td>{!! $user->username !!}</td>
							<td>{!! $user->levels->level !!}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm pull-right">
					<li>{!! $users->links() !!}</li>
				</ul>
			</div>
		</div>
	</div>
@endsection