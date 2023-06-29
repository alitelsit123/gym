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

  <title>Trainer - Gym Kenangan</title>
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
        <a class="navbar-brand text-white font-weight-bold" href="{{url('trainer')}}">
          {{-- <img src="../assets/images/brand/logo/logo.svg" alt="" /> --}}
          Gym Bersama
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('member')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('member/trainer')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Ambil Paket
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('member/membership')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Membership
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('member/product')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Toko
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('member/history')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Riwayat
            </a>
          </li>

          <li class="nav-item">
            <form action="{{url('logout')}}" method="post" id="logout"></form>
            <a class="nav-link has-arrow " href="#" onclick="$('#logout').submit()">
              <i data-feather="git-pull-request" class="nav-icon icon-xs me-2">
              </i> Logout
            </a>
          </li>


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
              {{-- <a class="btn btn-light btn-icon rounded-circle indicator
          indicator-primary text-muted"
                href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="icon-xs" data-feather="bell"></i>
              </a> --}}
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                <div>
                  <div
                    class="border-bottom px-3 pt-2 pb-3 d-flex
              justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a href="#" class="text-muted">
                      <span>
                        <i class="me-1 icon-xxs" data-feather="settings"></i>
                      </span>
                    </a>
                  </div>
                  <!-- List group -->
                  <ul class="list-group list-group-flush notification-list-scroll">
                    <!-- List group item -->
                    <li class="list-group-item bg-light">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Rishi Chopra</h5>
                        <p class="mb-0">
                          Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Neha Kannned</h5>
                        <p class="mb-0">
                          Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Nirmala Chauhan</h5>
                        <p class="mb-0">
                          Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Sina Ray</h5>
                        <p class="mb-0">
                          Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                        </p>
                      </a>



                    </li>
                  </ul>
                  <div class="border-top px-3 py-2 text-center">
                    <a href="#" class="text-inherit fw-semi-bold">
                      View all Notifications
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
              <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  <img alt="avatar" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">


                  <div class="lh-1 ">
                    <h5 class="mb-1"> John E. Grainger</h5>
                    <a href="#" class="text-inherit fs-6">View my profile</a>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">

                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit
                      Profile
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i>Activity Log
                    </a>


                  </li>

                  <li>
                    <a class="dropdown-item text-primary" href="#">
                      <i class="me-2 icon-xxs text-primary dropdown-item-icon" data-feather="star"></i>Go Pro
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="settings"></i>Account Settings
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../index.html">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                    </a>
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
