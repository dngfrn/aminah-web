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
    <link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    {{-- <img src="{{asset('img/sidebar-icon.png')}}" style="max-height: 50px; width:auto;" alt="logo"> --}}
                    <img src="{{asset('img/sidebar-icon.png')}}" style="width:100%; height:100%; object-fit:contain" alt="logo">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                @if(!Auth::check())
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>{{ __('Daftar Usaha') }}</span></a>
                @else
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Dashboard') }}</span></a>
                @endif
            </li>
            @if(Auth::check())
                @if(Auth::user()->role == 'pemodal')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo1">

                            <i class="fa-solid fa-gear"></i>
                            <span>{{ __('Master') }}</span>
                        </a>
                        <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">{{ __('Master') }}</h6>
                                <a class="collapse-item" href="/users">{{ __('User') }}</a>
                                <a class="collapse-item" href="{{route('pemodal.index')}}">{{ __('Pemodal') }}</a>
                                <a class="collapse-item" href="{{route('pengajuan.index')}}">{{ __('Pengajuan Usaha') }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ Nav::isRoute('admin.viewPendingReview') }}">
                        <a class="nav-link" href="{{ route('admin.viewPendingReview') }}">
                            <i class="fas fa-fw fa-building"></i>
                            <span>{{ __('Pending Review') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 'pelaku_usaha')
                <li class="nav-item {{ Nav::isRoute('pemilikUsaha.profile') }}">
                    <a class="nav-link" href="{{ route('pemilikUsaha.profile') }}">
                        <i class="fas fa-fw fa-building"></i>
                        <span>{{ __('Profile Usaha') }}</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3" aria-expanded="true" aria-controls="collapseTwo3">

                        <i class="fa-solid fa-money-bill"></i>
                        <span>{{ __('Kelola Profil Keuangan') }}</span>
                    </a>
                    <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo3" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">{{ __('Kelola Profil Keuangan') }}</h6>
                            {{-- <a class="collapse-item" href="#">{{ __('PPH 21') }}</a> --}}
                        </div>
                    </div>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Settings') }}
                </div>

                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('profile') }}">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::check() ? Auth::user()->name : "Guest"  }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::check() ? Auth::user()->name[0] : "G" }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @if(Auth::check())
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                                @else 
                                    <a class="dropdown-item" href="/login">
                                        <i class="fas fa-sign-in fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Login') }}
                                    </a>
                                @endif

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
                        <span>Copyright &copy; <a href="#" target="_blank">Andez M Pradesa</a> {{ now()->year }}</span>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('scripts')
    

    <script>
        $(document).ready(function() {
            swal_delete('.delete', '#myTable')
            
            function swalDell() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            }

            function toasts_success(icons, titles) {
                Swal.fire({
                    position: 'top-end',
                    icon: icons,
                    title: titles,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            function swal_delete(selector, table = false) {
                $(document).on('click', selector, function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "GET",
                                url: $(this).attr('href'),
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: "JSON",
                                success: function(res) {
                                    console.log(res);
                                    $(table).DataTable().ajax.reload(null, false);
                                    toasts_success(res.icon, res.message)
                                }
                            });
                        }
                    })
                })
            }
        });
    </script>

    @stack('scripts')
</body>

</html>