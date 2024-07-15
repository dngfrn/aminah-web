<!--
=============================================
    Theme Header
==============================================
-->
<header class="theme-main-header">


    <div class="main-menu-wrapper clearfix">
        <div class="container clearfix">
            <!-- Logo -->
            {{-- <div class="logo float-left"><a href="index.html"><img src="{{asset('siteTemplate/images/logo/logo.png')}}" alt="Logo"></a></div> --}}
            <div class="logo float-left"><a href="/"><img style="width:auto; max-height:40px;"
                        src="{{ asset('img/sidebar-icon.png') }}" alt="Logo"></a></div>

            <div class="right-widget float-right">
                <ul>
                    <li class="cart-icon">
                        <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>2</span></a>
                    </li>
                </ul>
            </div> <!-- /.right-widget -->

            <!-- ============================ Theme Menu ========================= -->
            <nav class="navbar-expand-lg float-right navbar-light" id="mega-menu-wrapper">
                <button class="navbar-toggler float-right clearfix" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="flaticon-menu-options"></i>
                </button>
                <div class="collapse navbar-collapse clearfix" id="navbarNav">
                    <ul class="navbar-nav nav">
                        <li class="nav-item dropdown-holder {{ Request::routeIs('indexPage') ? 'active' : '' }}">
                            <a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item dropdown-holder {{ Request::routeIs('listUsaha') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('listUsaha')}}">Daftar Usaha</a></li>
                        <li class="nav-item dropdown-holder {{ Request::routeIs('formulirPendanaan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('formulirPendanaan')}}">Ajukan Pendanaan</a></li>
                        @if(Auth::check())
                        <li class="nav-item dropdown-holder {{ Request::routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('home')}}">Dashboard</a></li>
                        @else 
                        <li class="nav-item dropdown-holder {{ Request::routeIs('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('login')}}">Login</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div> <!-- /.container -->
    </div> <!-- /.main-menu-wrapper -->
</header> <!-- /.theme-main-header -->
