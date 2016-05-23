@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-suitcase"></i>
	Level, <small>Atur level role sistem</small>
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Data Level</h3>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<thead>
					<th>#</th>
					<th>Kode Level</th>
					<th>Level</th>
					<th><i class="fa fa-fw fa-wrench"></i></th>
					</thead>
					<tbody>
					@foreach($levels as $key => $level)
						<tr>
							<td>{!! ++$key !!}</td>
							<td>{!! $level->kdlevel !!}</td>
							<td>{!! $level->level !!}</td>
							<td>Settings goes here...</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm pull-right">
					<li>{!! $levels->links() !!}</li>
				</ul>
			</div>
		</div>
	</div>
@endsection