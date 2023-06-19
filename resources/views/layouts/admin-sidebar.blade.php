<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-hms.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<!-- user info -->
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/admin.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">Thor Adminson</h4>
							<span class="mb-0 text-muted">Admin</span>
						</div>
					</div>
				</div>
				<!-- menu elements -->
				<ul class="side-menu">
					<li class="side-item side-item-category">Home</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='admin-index') }}"><span class="side-menu__icon"><i class="las la-chart-pie"></i></span></i></span><span class="side-menu__label">Dashboard</span></a>
					</li>
					<li class="side-item side-item-category">Staff</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='admin-staff') }}"><span class="side-menu__icon"><i class="las la-id-card-alt"></i></span><span class="side-menu__label">Manage Staff</span></a>
					</li>
					<li class="side-item side-item-category">Departments</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='admin-departments') }}"><span class="side-menu__icon"><i class="las la-building"></i></span><span class="side-menu__label">Manage Departments</span></a>
					</li>
					<li class="side-item side-item-category">Shifts</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='admin-shifts') }}"><span class="side-menu__icon"><i class="las la-stopwatch"></i></span><span class="side-menu__label">Manage Shifts</span></a>
					</li>
					<li class="side-item side-item-category">Management Tools</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='admin-tools') }}"><span class="side-menu__icon"><i class="las la-toolbox"></i></span><span class="side-menu__label">Tools</span></a>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
