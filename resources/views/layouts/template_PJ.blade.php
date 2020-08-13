<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/libs.css') }}" rel="stylesheet">
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
          <span>Pengajuan Kegiatan</span></a>
        </li>

    <li class="nav-item {{(request()->segment(2) == 'unggah-dokumentasi-kegiatan') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('pj.dokumentasi_kegiatan.index') }}">
        <i class="fas fa-fw fa-folder-open"></i>
        <span>Dokumentasi Kegiatan</span></a>
      </li>

      <li class="nav-item {{(request()->segment(2) == 'user-profile') ? 'active' : ''}}">
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
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}">
                <span class="ml-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
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
  <script src="{{ asset('js/libs.js') }}"></script>
  @yield('script')
  {{-- @stack('script') --}}
</body>

</html>
