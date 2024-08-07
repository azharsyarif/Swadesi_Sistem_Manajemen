<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

@if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'view_dashboard'))
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
@endif


    @if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'manage_human_resource'))
<hr class="sidebar-divider">

<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Rekanan') }}
</div>

<!-- Nav Item - Rekanan -->
    <li class="nav-item {{ Nav::isRoute('rekanan.index') }}">
        <a class="nav-link" href="{{ route('rekanan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Data Rekanan') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('pic-index') }}">
        <a class="nav-link" href="{{ route('pic-index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Data PIC') }}</span>
        </a>
    </li>
@endif

@if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'manage_human_resource'))
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Human Resource') }}
</div>

<!-- Nav Item - Data Karyawan -->
    <li class="nav-item {{ Nav::isRoute('karyawan.index') }}">
        <a class="nav-link" href="{{ route('karyawan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Data Karyawan') }}</span>
        </a>
    </li>

<!-- Nav Item - Absensi -->
    <li class="nav-item {{ Nav::isRoute('rekanan.index') }}">
        <a class="nav-link" href="{{ route('rekanan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Absensi') }}</span>
        </a>
    </li>

<!-- Nav Item - Permohonan Cuti -->

    

    @if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('admin'))
   
    @endif
<!-- Nav Item - Permohonan Izin Sakit --><li class="nav-item {{ Nav::isRoute('pengajuan.izin-sakit.index') }}">
    <a class="nav-link" href="{{ route('pengajuan.izin-sakit.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>{{ __('Permohonan Izin Sakit') }}</span>
    </a>
</li>

@endif
@if (Auth::user()->hasRole('staff') || Auth::user()->hasRole('admin'))
<li class="nav-item {{ Nav::isRoute('pengajuan.cuti.index') }}">
    <a class="nav-link" href="{{ route('pengajuan.cuti.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>{{ __('Permohonan Cuti') }}</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('approval.index') }}">
    <a class="nav-link" href="{{ route('approval.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>{{ __('Approval Cuti,Izin dan sakit') }}</span>
    </a>
</li>
@endif
@if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'manage_marketing'))
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Marketing') }}
</div>

<!-- Nav Item - Order Management -->
    <li class="nav-item {{ Nav::isRoute('marketing.order.index') }}">
        <a class="nav-link" href="{{ route('marketing.order.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Order Management') }}</span>
        </a>
    </li>

<!-- Nav Item - Invoice Management -->
    <li class="nav-item {{ Nav::isRoute('marketing.invoice.index') }}">
        <a class="nav-link" href="{{ route('marketing.invoice.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Invoice Management') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Nav::isRoute('marketing.po.index') }}">
        <a class="nav-link" href="{{ route('marketing.po.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('PO Customer Management') }}</span>
        </a>
    </li>
    

@endif


@if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'manage_operasional'))
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Operasional') }}
</div>

<!-- Nav Item - Data Kendaraan -->
    <li class="nav-item {{ Nav::isRoute('kendaraan.index') }}">
        <a class="nav-link" href="{{ route('kendaraan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Data Kendaraan') }}</span>
        </a>
    </li>

<!-- Nav Item - Instruksi Jalan -->
    <li class="nav-item {{ Nav::isRoute('intruksiJalan.index') }}">
        <a class="nav-link" href="{{ route('intruksiJalan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Instruksi Jalan') }}</span>
        </a>
    </li>

<!-- Nav Item - Service Kendaraan -->
    <li class="nav-item {{ Nav::isRoute('service.index') }}">
        <a class="nav-link" href="{{ route('service.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Service Kendaraan') }}</span>
        </a>
    </li>

@endif


@if(Auth::user()->hasRole('admin') || Auth::user()->permissions->contains('name', 'manage_finance'))

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Finance') }}
</div>

<!-- Nav Item - Approved Payment -->
    {{-- <li class="nav-item {{ Nav::isRoute('approved.payment.index') }}">
        <a class="nav-link" href="{{ route('approved.payment.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Approved Payment') }}</span>
        </a>
    </li> --}}

<!-- Nav Item - Monitoring Tagihan -->
    {{-- <li class="nav-item {{ Nav::isRoute('monitoring.tagihan.index') }}">
        <a class="nav-link" href="{{ route('monitoring.tagihan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Monitoring Tagihan') }}</span>
        </a>
    </li> --}}
@endif


@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('super-admin'))
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading Data -->
<div class="sidebar-heading">
    {{ __('Admin') }}
</div>

<!-- Nav Item - Hak Akses -->
    <li class="nav-item {{ Nav::isRoute('admin.permission.index') }}">
        <a class="nav-link" href="{{ route('admin.permission.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Hak Akses') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('admin.user_permissions.index') }}">
        <a class="nav-link" href="{{ route('admin.user_permissions.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('User Permission') }}</span>
        </a>
    </li>
@endif

<!-- Divider -->
<hr class="sidebar-divider">



        {{-- <!-- Heading Setting-->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('User Management') }}</span>
            </a>
        </li>
        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>


        <!-- Nav Item - About -->
        <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('About') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div> --}}

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

                {{-- <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    {{-- <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
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
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li> --}}

                    {{-- <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li> --}}

                    {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="https://github.com/aleckrh" target="_blank">Aleckrh</a> {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
