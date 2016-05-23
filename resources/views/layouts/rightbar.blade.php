<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        <li><a href="#control-sidebar-stats-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <h4 class="control-sidebar-heading">Admin Setting</h4>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="{{ route('setting::jabatan') }}">
                        <i class="menu-icon fa fa-fw fa-briefcase bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Setting Jabatan</h4>
							<p>Tambah Edit Jabatan</p>
                        </div>
                    </a>
                </li>
                <li>
					<a href="{{ route('setting::level') }}">
                        <i class="menu-icon fa fa-fw fa-suitcase bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Setting Level</h4>
							<p>Tambah Edit Login Role</p>
                        </div>
                    </a>
                </li>
                <li>
					<a href="{{ route('setting::user') }}">
                        <i class="menu-icon fa fa-fw fa-users bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Setting User</h4>
							<p>Tambah Edit User</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">
			<h3 class="control-sidebar-heading">General Settings</h3>
			<div class="menu-info">
				<h4 class="control-sidebar-subheading">Coming Soon!!!</h4>
				<p>Menu lain-lain</p>
			</div>
			<!-- /.form-group -->
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->