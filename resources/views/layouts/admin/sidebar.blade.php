
<nav class="sb-sidenav accordion sb-sidenav-dark" style="background: #332042" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">User Registration</div>

            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Users
            </a>

            <a class="nav-link collapsed {{ request()->is('staff') ? 'active' : '' }} 
                    {{ request()->is('payroll') ? 'active' : '' }} 
                    {{ request()->is('salary') ? 'active' : '' }}
                    {{ request()->is('loans') ? 'active' : '' }}
                    {{ request()->is('sms') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#hrm" aria-expanded="false" aria-controls="hrm">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Human Res. Mgt.
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="hrm" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('staff') }}">Staff</a>
                    <a class="nav-link" href="{{ route('salary') }}">Salaries</a>
                    <a class="nav-link" href="{{ route('payroll') }}">Payroll</a>
                    <a class="nav-link" href="{{ route('loans') }}">Loans</a>
                    <a class="nav-link" href="{{ route('sms') }}">SMS</a>
                </nav>
            </div>
            
            <div class="sb-sidenav-menu-heading">Settings</div>

            <a class="nav-link collapsed {{ request()->is('room_types') ? 'active' : '' }} {{ request()->is('rooms') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#room-setup" aria-expanded="false" aria-controls="room-setup">
                <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                Room Setup
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="room-setup" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('room_types') }}">Room Types</a>
                    <a class="nav-link" href="{{ route('rooms') }}">Rooms</a>
                </nav>
            </div>

            <a class="nav-link {{ request()->is('customers') ? 'active' : '' }}" href="{{ route('customers') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Guests
            </a>

            <a class="nav-link {{ request()->is('setup_image') ? 'active' : '' }}" href="{{ route('setup_image') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                Gallery Setup
            </a>

            <a class="nav-link collapsed 
                {{ request()->is('prices') ? 'active' : '' }}
                {{ request()->is('dropdowns') ? 'active' : '' }}
                {{ request()->is('tax') ? 'active' : '' }}
                {{ request()->is('setup') ? 'active' : '' }}
                " href="#" data-bs-toggle="collapse" data-bs-target="#setup" aria-expanded="false" aria-controls="room-setup">
                <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                System Setups
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="setup" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('prices') }}">Price Setup</a>
                    <a class="nav-link" href="{{ route('tax') }}">Tax Setup</a>
                    <a class="nav-link" href="{{ route('dropdowns') }}">Dropdowns</a>
                    <a class="nav-link" href="{{ route('setup') }}">Hotel Name</a>
                </nav>
            </div>
            
        </div>
    </div>
    <div class="sb-sidenav-footer" style="background: radial-gradient(#653d84, #332042)">
        <div class="small">Create & Designed By:</div>
        Sammav IT Consult
    </div>
</nav>
