<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('img/user-default.png') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{!! Auth::user()->karyawans->namadepan . ' ' . Auth::user()->karyawans->namabelakang !!}</p>
				<!-- Status -->
				<i class="fa fa-circle text-success"></i> {!! Auth::user()->levels->level !!}
			</div>
		</div>

		<!-- search form (Optional) -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					</span>
			</div>
		</form>
		<!-- /.search form -->

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<!-- Optionally, you can add icons to the links -->

			{{--user role permission--}}
			@if(Auth::user()->hasLevel('administrator'))
				<li><a href="#"><i class="fa fa-fw fa-users"></i> <span>Data Karyawan</span></a></li>
				<li><a href="{{ url('supplier') }}"><i class="fa fa-fw fa-truck"></i> <span>Supplier</span></a></li>
				<li class="treeview">
					<a href="#"><i class="fa fa-fw fa-medkit"></i> <span>Obat</span> <i class="fa fa-fw fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="{{ route('setting::jabatan') }}">Daftar Kategori Obat</a></li>
						<li><a href="{{ route('setting::jabatan') }}">Daftar Obat</a></li>
					</ul>
				</li>
			@elseif(Auth::user()->hasLevel('manager'))
				<li><a href="#"><i class="fa fa-fw fa-users"></i> <span>Data Karyawan</span></a></li>
				<li class="treeview">
					<a href="#"><i class="fa fa-fw fa-medkit"></i> <span>Obat</span> <i class="fa fa-fw fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="{{ route('setting::jabatan') }}">Daftar Kategori Obat</a></li>
						<li><a href="{{ route('setting::jabatan') }}">Daftar Obat</a></li>
					</ul>
				</li>
			@elseif(Auth::user()->hasLevel('apoteker'))
				<li class="treeview">
					<a href="#"><i class="fa fa-fw fa-medkit"></i> <span>Obat</span> <i class="fa fa-fw fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="{{ route('obat::kategori') }}">Daftar Kategori Obat</a></li>
						<li><a href="{{ route('obat::obat') }}">Daftar Obat</a></li>
					</ul>
				</li>
			@elseif(Auth::user()->hasLevel('kasir'))
				<li class="treeview">
					<a href="#"><i class="fa fa-fw fa-medkit"></i> <span>Obat</span> <i class="fa fa-fw fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="{{ route('setting::jabatan') }}">Daftar Kategori Obat</a></li>
						<li><a href="{{ route('setting::jabatan') }}">Daftar Obat</a></li>
					</ul>
				</li>
			@else
				<li><a href="#"><i class="fa fa-fw fa-dashboard"></i> <span>Dashboard</span></a></li>
			@endif
			{{--//user role permission--}}
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>