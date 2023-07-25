<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@stack('titlePages')</title>

    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    @stack('css')

    <link rel="stylesheet" href="{{ asset('assets/modules/prism/prism.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>
@php
    $userDie = DB::table('users')->where('status', 'mati')->count();
    $reviewReport = DB::table('aduans')->where('status', 'ditinjau')->count();
    $responReport = DB::table('aduans')->where('status', 'diterima')->count();
@endphp
<body>
    <div id="app">
        {{-- navigation --}}
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
                        @if ($userDie > 0)
                            <a href="{{ route('users.index') }}" class="dropdown-item">
                                <div class="dropdown-item-icon bg-warning text-white">
                                    <i class="far fa-user" style="margin-top: 10px"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Terdapat {{ $userDie }} Pengguna non-aktif!
                                </div>
                            </a>
                        @endif
                        @if ($reviewReport > 0)
                            <a href="{{ route('aduan.index') }}" class="dropdown-item">
                                <div class="dropdown-item-icon bg-danger text-white">
                                    <i class="far fa-file-alt" style="margin-top: 10px"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    {{ $reviewReport }} Aduan Perlu ditinjau!
                                </div>
                            </a>
                        @endif
                        @if ($responReport > 0)
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="far fa-file-alt" style="margin-top: 10px"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    {{ $responReport }} Aduan Perlu ditanggapi!
                                </div>
                            </a>
                        @endif
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
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->warga->nama_warga }}</div></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('akun.reset') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Ubah Password
                </a>
                <a href="" class="dropdown-item has-icon text-danger"  data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                </div>
            </li>
            </ul>
        </nav>

        {{-- sidebar --}}
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('img/icon.png') }}" alt=""> SIKAT</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('img/icon.png') }}" alt="" class="sideBar"></a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li class="menu @stack('dashboard')">
                        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="menu-header">Menu</li>
                    <li class="dropdown @stack('agenda') @stack('addAgenda')">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-alt"></i> <span>Agenda</span></a>
                        <ul class="dropdown-menu">
                            <li class="@stack('agenda')"><a class="nav-link" href="{{ route('agenda.index') }}">List Agenda</a></li>
                            @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin')
                                <li class="@stack('addAgenda')"><a class="nav-link" href="{{ route('agenda.create') }}">Tambah Agenda</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown @stack('aduan') @stack('addAduan')">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i> <span>Aduan</span></a>
                        <ul class="dropdown-menu">
                            <li class="@stack('aduan')"><a class="nav-link" href="{{ route('aduan.index') }}">List Aduan</a></li>
                            <li class="@stack('addAduan')"><a class="nav-link" href="{{ route('aduan.create') }}">Tambah Aduan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown  @stack('dana') @stack('addDana')">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i> <span>Pendanaan</span></a>
                        <ul class="dropdown-menu">
                            <li class="@stack('dana')"><a class="nav-link" href="{{ route('dana.index') }}">List Pendanaan</a></li>
                            @if (Auth::user()->jabatan->nama_jabatan == 'Bendahara')
                                <li class=" @stack('addDana')"><a class="nav-link" href="{{ route('dana.create') }}">Tambah Pendanaan</a></li>
                            @endif
                        </ul>
                    </li>
                    @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin' || Auth::user()->jabatan->nama_jabatan == 'Admin')
                        <li class="dropdown @stack('warga') @stack('addWarga')">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Data Warga</span></a>
                            <ul class="dropdown-menu">
                                <li class="@stack('warga')"><a class="nav-link" href="{{ route('warga.index') }}">List Warga</a></li>
                                <li class="@stack('addWarga')"><a class="nav-link" href="{{ route('warga.create') }}">Tambah Warga</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin')
                        <li class="dropdown @stack('user') @stack('addUser')">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i> <span>Data Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li class="@stack('user')"><a class="nav-link" href="{{ route('users.index') }}">List Pengguna</a></li>
                                <li class="@stack('addUser')"><a class="nav-link" href="{{ route('users.create') }}">Tambah Pengguna</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </aside>
        </div>
        <div class="main-wrapper main-wrapper-1">
            @yield('content')
        </div>
        @include('template.component.footer')
    </div>

    {{-- modal logout --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Anda Yakin?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin logout?</p>
            </div>
            <form action="{{ route('logoutSystem') }}" method="get">
                @csrf
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>
            </form>
          </div>
        </div>
      </div>


    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    @stack('js')

     <!-- JS Libraies -->
     <script src="{{ asset('assets/modules/prism/prism.js') }}"></script>

     <!-- Page Specific JS File -->
     <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
