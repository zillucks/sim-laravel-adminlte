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
				<li class="time-label">
					<span class="bg-red">{{ date('d M, Y') }}</span>
				</li>
				{{--/timeline label--}}
				{{--timeline items--}}
				<li>
					<i class="fa fa-fw fa-exclamation bg-red"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>
						<h3 class="timeline-header">Stok Obat Generik Komik tinggal 30</h3>

						<div class="timeline-body">
							<p>Stok obat generik Komik tinggal 30. Segera re-stok ulang supaya tidak ada orang yang komplain lagi. Understand???</p>
						</div>
						<div class="timeline-footer">
							<a href="#" class="btn btn-link btn-xs">Read Mode...</a>
						</div>
					</div>
				</li>
				<li>
					<i class="fa fa-fw fa-bicycle bg-fuchsia"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>
						<h3 class="timeline-header">Car Free Day Minggu, 22 Mei 2016</h3>

						<div class="timeline-body">
							<p>Ayo ikutan car free day pada hari minggu tanggal 22 Mei 2016 di alun-alun kota Jember. Kesehatan lebih mahal dari gaya hidup</p>
						</div>
						<div class="timeline-footer">
							<a href="#" class="btn btn-link btn-xs">Read Mode...</a>
						</div>
					</div>
				</li>
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
				<li>
					<i class="fa fa-fw fa-birthday-cake bg-aqua"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>
						<h3 class="timeline-header no-border">Selamat Ulang Tahun!!!</h3>
					</div>
				</li>
				<li>
					<i class="fa fa-fw fa-refresh fa-spin bg-aqua"></i>
					<div class="timeline-item">
						<span class="time"><i class="fa fa-fw fa-clock-o"></i> {{ date('H:i') }}</span>
						<h3 class="timeline-header no-border">Refreshing!!!</h3>
					</div>
				</li>
				{{--/timeline items--}}
			</ul>
		</div>
	</div>
@endsection
