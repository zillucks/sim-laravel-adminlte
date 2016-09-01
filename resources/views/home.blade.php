@extends('layouts.app')

@section('page-header')
	<i class="fa fa-fw fa-medkit"></i>
	Hot News!!!
	<small>Berisikan berita tentang apotek</small>
@endsection()

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ul class="timeline">
				{{--timeline label--}}
				{{--<li class="time-label">
					<span class="bg-red">{{ date('d M, Y') }}</span>
				</li>--}}
				{{--/timeline label--}}
				{{--timeline items--}}
				@if(count($stoklimit) > 0)
					@foreach($stoklimit as $index => $value)
						<li>
							<i class="fa fa-fw fa-exclamation bg-red"></i>
							<div class="timeline-item">
								{{--<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>--}}
								<h3 class="timeline-header">Stok {!! $value->namabarang !!} tinggal {!! $value->stok !!}</h3>

								<div class="timeline-body">
									<p>Stok {!! $value->namabarang !!} tinggal {!! $value->stok !!}. Segera re-stok ulang</p>
								</div>
							</div>
						</li>
					@endforeach
				@endif
				<li>
					<i class="fa fa-fw fa-balance-scale bg-orange"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>
						<h3 class="timeline-header">Laporan Keuangan</h3>

						<div class="timeline-body">
							<p>Rincian laporan keuangan bulan mei 2016. Check it out!!!</p>
						</div>
					</div>
				</li>
				{{--/timeline items--}}
			</ul>
		</div>
		<div class="col-md-10 col-md-offset-1">

		</div>
		<div class="col-md-offset-1 col-md-6">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="box-title">Box Title</h3>
				</div>
				<div class="box-body table-responsive">
					box body
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="box-title">Box Title</h3>
				</div>
				<div class="box-body table-responsive">
					box body
				</div>
			</div>
		</div>
	</div>
@endsection
