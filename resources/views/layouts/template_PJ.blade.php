{{--   
    Nama: Muhammad Zhafran Auristianto
    Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
  --}}
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user-authorization" content="{{ Auth::user()->id }}">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/libs.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" type="image/x-icon">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #00a85a">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon text-white">
          {{-- <i class="fas fa-school"></i> --}}
          <img class="img-profile rounded-circle" src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" width="60px">
        </div>
        <div class="sidebar-brand-text mx-3 text-white">SIMPPK</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      {{-- <li class="nav-item {{(request()->is('penanggungjawab-home')) ? 'active' : ''}}">
        <a class="nav-link" href="{{ url('/penanggungjawab-home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> --}}

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Fungsi Penanggung Jawab
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item {{ (request()->segment(2) == 'mengelola-kegiatan') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengajuan Kegiatan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Fungsi Pengajuan Kegiatan</h6>
            <a class="collapse-item" href="{{ route('pj.kelola_kegiatan.create') }}">Buat Pengajuan Kegiatan</a>
            <a class="collapse-item" href="{{ route('pj.kelola_kegiatan.index') }}">Proposal Kegiatan</a>
            <a class="collapse-item" href="{{ route('pj.dokumentasi_kegiatan.index') }}">Pengajuan Dokumentasi</a>
          </div>
        </div>
      </li> --}}

      <li class="nav-item {{(request()->segment(2) == 'mengelola-kegiatan') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('pj.kelola_kegiatan.index') }}">
          <i class="fas fa-fw fa-clipboard-check"></i>
          <span>Proposal Kegiatan</span></a>
        </li>

    <li class="nav-item {{(request()->segment(2) == 'unggah-dokumentasi-kegiatan') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('pj.dokumentasi_kegiatan.index') }}">
        <i class="fas fa-fw fa-folder-open"></i>
        <span>Laporan Kegiatan</span></a>
      </li>

      <li class="nav-item {{(request()->segment(2) == 'user-profile') || (request()->segment(2) == 'notifications') ? 'active' : ''}}">
        <a class="nav-link" href="{{  route("userprofile.pj.index") }}">
          <i class="fas fa-id-card-alt"></i>
          <span>Profil Penanggung Jawab</span></a>
        </li>

      <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item {{ (request()->segment(2) == 'dokumentasi-kegiatan') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Dokumentasi Kegiatan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Fungsi Dokumentasi Kegiatan:</h6>
            <a class="collapse-item" href="{{ route('pj.kelola_dokumentasi.index') }}">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li> --}}

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      {{-- <div class="sidebar-heading">
        Addons
      </div> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> --}}

      <!-- Nav Item - Charts -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> --}}

      <!-- Nav Item - Tables -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> --}}

      <!-- Divider -->
      {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">0</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifikasi Anda
                </h6>
                <div class="notification-items">
                  {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 12, 2019</div>
                      <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                  </a> --}}
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('pj.userprofile.getAllNotify') }}">Lihat Notifikasi Anda</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (is_null(Auth::user()->photo_user))
                  <img class="img-profile rounded-circle" src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}">
                @else 
                  <img class="img-profile rounded-circle" src="{{ asset('storage/photo_user_simppk/'.Auth::user()->photo_user) }}">
                @endif
                <span class="ml-2 d-none d-lg-inline text-gray-600 small">{{ ucwords(Auth::user()->name) }}</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route("userprofile.pj.index") }}">
                  <i class="fas fa-id-card-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      {{-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer> --}}
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  {{-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

  <!-- Core plugin JavaScript-->
  {{-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> --}}

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/libs.js') }}"></script>
  <script src="{{ asset('js/penanggungjawab.js') }}"></script>
  @yield('script')
  {{-- @stack('script') --}}
</body>

</html>
