<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}"><img src="{{ Vite::asset('resources/images/icon.png') }}" alt=""> SIKAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><img src="{{ Vite::asset('resources/images/icon.png') }}" alt="" class="sideBar"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="menu {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>
            <li class="menu">
                <a href="#" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Agenda</span></a>
            </li>
            <li class="menu">
                <a href="#" class="nav-link"><i class="fas fa-file-alt"></i><span>Aduan</span></a>
            </li>
            <li class="menu">
                <a href="#" class="nav-link"><i class="fas fa-wallet"></i><span>Pendanaan</span></a>
            </li>

            {{-- @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin' || Auth::user()->jabatan->nama_jabatan == 'Admin') --}}
                <li class="menu {{ request()->routeIs('people.*') ? 'active' : '' }}">
                    <a href="{{ route('people.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Data Warga</span></a>
                </li>
            {{-- @endif --}}
            {{-- @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin') --}}
                <li class="menu">
                    <a href="#" class="nav-link"><i class="fas fa-user"></i><span>Data Pengguna</span></a>
                </li>
            {{-- @endif --}}
        </ul>
    </aside>
</div>
