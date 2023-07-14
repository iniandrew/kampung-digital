<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    </form>
    <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-list-content dropdown-list-icons">
                {{-- @if ($userDie > 0) --}}
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-warning text-white">
                            <i class="far fa-user" style="margin-top: 10px"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Terdapat 10 Pengguna non-aktif!
                        </div>
                    </a>
                {{-- @endif --}}
                {{-- @if ($reviewReport > 0) --}}
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                            <i class="far fa-file-alt" style="margin-top: 10px"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            4 Aduan Perlu ditinjau!
                        </div>
                    </a>
                {{-- @endif --}}
                {{-- @if ($responReport > 0) --}}
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="far fa-file-alt" style="margin-top: 10px"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            2 Aduan Perlu ditanggapi!
                        </div>
                    </a>
                {{-- @endif --}}
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-bell" style="margin-top: 10px"></i>
                </div>
                <div class="dropdown-item-desc">
                    Selamat Datang Di SIKAT (Sistem Informasi Kampung Digital)
                </div>
                </a>
            </div>
        </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block">bagus</div></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('changePassword') }}" class="dropdown-item has-icon">
            <i class="fas fa-cog"></i> Ubah Password
        </a>
        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"  data-toggle="modal" data-target="#exampleModal" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        </div>
    </li>
    </ul>
</nav>
