
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
            
            <div class="sb-sidenav-menu-heading">Settings</div>

            <a class="nav-link {{ request()->is('dropdowns') ? 'active' : '' }}" href="{{ route('dropdowns') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-angle-double-down"></i></div>
                Dropdowns
            </a>

             <a class="nav-link collapsed {{ request()->is('room_types') ? 'active' : '' }} {{ request()->is('rooms') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                Room Setup
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('room_types') }}">Room Types</a>
                    <a class="nav-link" href="{{ route('rooms') }}">Rooms</a>
                </nav>
            </div>

            <a class="nav-link {{ request()->is('customers') ? 'active' : '' }}" href="{{ route('customers') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Customers
            </a>

            <a class="nav-link {{ request()->is('prices') ? 'active' : '' }}" href="{{ route('prices') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-alt"></i></div>
                Price Setup
            </a>

            <a class="nav-link {{ request()->is('setup_image') ? 'active' : '' }}" href="{{ route('setup_image') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                Gallery Setup
            </a>
            
        </div>
    </div>
    <div class="sb-sidenav-footer" style="background: radial-gradient(#653d84, #332042)">
        <div class="small">Create & Designed By:</div>
        Sammav IT Consult
    </div>
</nav>
