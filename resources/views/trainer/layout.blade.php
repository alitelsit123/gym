<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="{{url('/assets/images/favicon/favicon.ico')}}">

  <!-- Libs CSS -->


  <link href="{{url('/assets/libs/bootstrap-icons/font/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('/assets/libs/dropzone/dist/dropzone.css')}}" rel="stylesheet">
  <link href="{{url('/assets/libs/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet" />
  <link href="{{url('/assets/libs/prismjs/themes/prism-okaidia.min.css')}}" rel="stylesheet">







  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{url('/assets/css/theme.min.css')}}">

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{url('/assets/libs/feather-icons/dist/feather.min.js')}}"></script>
  <script src="{{url('/assets/libs/prismjs/prism.js')}}"></script>
  <script src="{{url('/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{url('/assets/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
  <script src="{{url('/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js')}}"></script>
  <script src="{{url('/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js')}}"></script>
  <!-- Theme JS -->
  <script src="{{url('/assets/js/theme.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Trainer - MAHESA GYM & FITNESS</title>
</head>

<body class="bg-light">
  @if (session('success'))
  <script>
    Swal.fire(
      'Success',
      '{{session('success')}}',
      'success'
    )
  </script>
  @endif
  @if (session('error') || $errors->any())
  <script>
    Swal.fire(
      'Error!',
      '{{session('error') ?? 'Wajib mengisi input'}}',
      'error'
    )
  </script>
  @endif
  <div id="db-wrapper">
    <!-- navbar vertical -->
    <!-- Sidebar -->
    <nav class="navbar-vertical navbar">
      <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand text-white font-weight-bold" style="font-size: 15px;" href="{{url('trainer')}}">
          {{-- <img src="../assets/images/brand/logo/logo.svg" alt="" /> --}}
          MAHESA GYM & FITNESS
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/member')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Anggota Aktif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/product')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Toko
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/packet')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Manajemen Paket
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/specialist')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Bidang Saya
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/transaction')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Transaksi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url(auth()->user()->role.'/broadcast')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Broadcast Notifikasi
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url(auth()->user()->role.'/chat')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Chat
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('/user')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> View User
            </a>
          </li>


          {{-- <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('trainer/profile')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Profile
            </a>
          </li>

          <li class="nav-item">
            <form action="{{url('logout')}}" method="post" id="logout"></form>
            <a class="nav-link has-arrow " href="#" onclick="$('#logout').submit()">
              <i data-feather="git-pull-request" class="nav-icon icon-xs me-2">
              </i> Logout
            </a>
          </li> --}}


        </ul>

      </div>
    </nav>
    <!-- page content -->
    <div id="page-content">
      <div class="header @@classList">
        <!-- navbar -->
        <nav class="navbar-classic navbar navbar-expand-lg">
          <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
          <div class="ms-lg-3 d-none d-md-none d-lg-block">
            <!-- Form -->
            <form class="d-flex align-items-center">
              {{-- <input type="search" class="form-control" placeholder="Search" /> --}}
              <strong>{{ucfirst(request()->segment(2) ?? 'Dashboard')}}</strong>

            </form>
          </div>
          <!--Navbar nav -->
          <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="dropdown stopevent">
              @include('notification')
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
              <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  @if (auth()->user()->photo)
                  <img alt="avatar" src="{{asset('storage/profile/'.auth()->user()->photo)}}" class="rounded-circle" />
                  @else
                  <img alt="avatar" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle" />
                  @endif
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">


                  <div class="lh-1 ">
                    <h5 class="mb-1">{{auth()->user()->name}}</h5>
                    <a href="{{url('trainer/profile')}}" class="text-inherit fs-6">Lihat Profile</a>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">
                  <li>
                    <a class="dropdown-item" href="{{url('print')}}">
                      Cetak Kartu Anggota
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('trainer/profile')}}">
                      Edit Profile
                    </a>
                  </li>
                  <li>
                    <form action="{{url('logout')}}" method="post">
                      <button class="dropdown-item" type="submit">
                        Logout
                      </button>
                    </form>
                  </li>
                </ul>

              </div>
            </li>
          </ul>
        </nav>
      </div>
      <!-- Container fluid -->
      <div class="container-fluid px-6 py-4">
        @yield('body')
      </div>

    </div>
  </div>





</body>

</html>
