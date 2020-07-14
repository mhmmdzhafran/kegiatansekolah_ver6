<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Manajemen Kegiatan Program Penguatan Karakter SMP Islam Sabilurrosyad Malang">
  <meta name="author" content="">
  <title>SMP Islam Sabilurrosyad Malang</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('logo/logo_smp_islam_sabilurrosyad.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/libs.css') }}">
</head>

<body class="bg-gradient-success">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg" style="margin-top: 7rem">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('{{asset("logo/logo_smp_islam_sabilurrosyad.png")}}');"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sistem Informasi Manajemen PPK SMP Islam Sabilurrosyad Malang</h1>
                  </div>
                    @yield('content_form')
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Core plugin JavaScript-->
<script src="{{ asset('js/libs.js') }}"></script>
@yield('scripts')
</body>

</html>
