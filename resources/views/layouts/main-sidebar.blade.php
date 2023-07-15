<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header text-center active">
    <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-hms.png')}}" class="main-logo" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ asset(auth()->user()->imageUrl()) }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>


			<li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-id-card"></i></span>
                <span class="side-menu__label">&nbsp;Users</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('user.index') }}">Users</a></li>
                    <li><a class="slide-item" href="{{ route('employee.index') }}">Employees</a></li>
                </ul>

            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-address-book"></i></span>
                <span class="side-menu__label">Patients</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('patient.index') }}">Patients</a></li>
                </ul>

            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-fingerprint"></i></span>
                <span class="side-menu__label">Attendance</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('shift.index') }}">Shifts</a></li>
                    <li><a class="slide-item" href="{{ route('attendance.index') }}">Attendance Report</a></li>
                </ul>

            </li>



            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-toggle-on"></i></span>
                <span class="side-menu__label">Pervilages</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route("role.index") }}">Roles</a></li>
                    <li><a class="slide-item" href="{{ route("permission.index") }}">Permissions</a></li>
                </ul>
            </li>


            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-calendar-check"></i></span>
                <span class="side-menu__label">Reservations</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route("room.reserve.index") }}">Rooms Reservation</a></li>
                    <li><a class="slide-item" href="{{ route("appointment.reserve.index") }}">Appointment Reservation</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-sitemap"></i></span>
                <span class="side-menu__label">Departments</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('department.index') }}">Departments</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                <span class="side-menu__icon"><i class="fa fa-bed"></i></span>
                <span class="side-menu__label">Rooms</span><i class="angle fe fe-chevron-down"></i></a>

				<ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('room.index') }}">Rooms</a></li>
                </ul>
            </li>



        </ul>
    </div>
</aside>
<!-- main-sidebar -->
