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
  <link href="{{url('/assets/libs/prismjs/themes/prism-okaidia.css')}}" rel="stylesheet">







  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{url('/assets/css/theme.min.css')}}">

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{url('/assets/libs/feather-icons/dist/')}}feather.min.js"></script>
  <script src="{{url('/assets/libs/prismjs/prism.js')}}"></script>
  <script src="{{url('/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{url('/assets/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
  <script src="{{url('/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js')}}"></script>
  <script src="{{url('/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js')}}"></script>
  <!-- Theme JS -->
  <script src="{{url('/assets/js/theme.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>MAHESA GYM & FITNESS</title>
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
        <a class="navbar-brand text-white font-weight-bold" style="font-size: 15px;" href="{{url('admin')}}">
          {{-- <img src="../assets/images/brand/logo/logo.svg" alt="" /> --}}
          MAHESA GYM & FITNESS
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
            </a>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin/class')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Kelas
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin/membership')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Membership
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin/product')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Toko
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin/user')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Pengguna
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url(auth()->user()->role.'/broadcast')}}">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Broadcast Notifikasi
            </a>
          </li>

          {{-- <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading">Layouts & Pages</div>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link has-arrow" href="../index.html">
              <i data-feather="home" class="nav-icon icon-xs me-2"></i> Master Data
            </a>
          </li> --}}


          {{-- <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading">Layouts & Pages</div>
          </li>


          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
              data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
              <i data-feather="layers" class="nav-icon icon-xs me-2">
              </i> Pages
            </a>

            <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link " href="../pages/profile.html">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link has-arrow   " href="../pages/settings.html">
                    Settings
                  </a>

                </li>


                <li class="nav-item">
                  <a class="nav-link " href="../pages/billing.html">
                    Billing
                  </a>
                </li>




                <li class="nav-item">
                  <a class="nav-link " href="../pages/pricing.html">
                    Pricing
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="../pages/404-error.html">
                    404 Error
                  </a>
                </li>
              </ul>
            </div>

          </li>


          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
              data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
              <i data-feather="lock" class="nav-icon icon-xs me-2">
              </i> Authentication
            </a>
            <div id="navAuthentication" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link " href="../pages/sign-in.html"> Sign In</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  " href="../pages/sign-up.html"> Sign Up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="../pages/forget-password.html">
                    Forget Password
                  </a>
                </li>

              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link  active " href="../pages/layout.html">
              <i data-feather="sidebar" class="nav-icon icon-xs me-2">
              </i>
              Layouts
            </a>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading">UI Components</div>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow " href="../docs/accordions.html">
              <i data-feather="package" class="nav-icon icon-xs me-2">
              </i> Components
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
              data-bs-target="#navMenuLevel" aria-expanded="false" aria-controls="navMenuLevel">
              <i data-feather="corner-left-down" class="nav-icon icon-xs me-2">
              </i> Menu Level
            </a>
            <div id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">
                    Two Level
                  </a>
                  <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link " href="#!"> NavItem 1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#!"> NavItem 2</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link has-arrow  collapsed  " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#navMenuLevelThree" aria-expanded="false" aria-controls="navMenuLevelThree">
                    Three Level
                  </a>
                  <div id="navMenuLevelThree" class="collapse " data-bs-parent="#navMenuLevel">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse"
                          data-bs-target="#navMenuLevelThreeOne" aria-expanded="false"
                          aria-controls="navMenuLevelThreeOne">
                          NavItem 1
                        </a>
                        <div id="navMenuLevelThreeOne" class="collapse collapse "
                          data-bs-parent="#navMenuLevelThree">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link " href="#!">
                                NavChild Item 1
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#!"> Nav Item 2</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading">Documentation</div>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow " href="../docs/index.html">
              <i data-feather="clipboard" class="nav-icon icon-xs me-2">
              </i> Docs
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link has-arrow " href="../docs/changelog.html">
              <i data-feather="git-pull-request" class="nav-icon icon-xs me-2">
              </i> Changelog
            </a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link has-arrow " href="{{url('admin/transaction')}}">
              <i data-feather="git-pull-request" class="nav-icon icon-xs me-2">
              </i> Transaksi
            </a>
          </li>
          {{-- <li class="nav-item">
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
                    <a href="{{url('admin/profile')}}" class="text-inherit fs-6">Lihat Profile</a>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">

                  <li>
                    <a class="dropdown-item" href="{{url('admin/profile')}}">
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
