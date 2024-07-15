@extends('layouts.mainPage.layout')

@section('main-content')
    <!--
    =============================================
    Theme Main Banner
    ==============================================
    -->
    <div id="theme-main-banner" class="banner-one">
        <div data-src="{{ asset('siteTemplate/customImage/slider/slide1.jpg') }}">
            <div class="camera_caption">
                <div class="container">
                    <h1 class="wow fadeInUp animated">Aminah</h1>
                    <p class="wow fadeInUp animated" data-wow-delay="0.2s"> Aman, Terjamin, dan Berbasis Syariah
                    </p>
                    <a href="{{ route('formulirPendanaan') }}" class="button-one wow fadeInLeft animated"
                        data-wow-delay="0.3s">Ajukan Pendanaan</a>
                    <a href="{{ route('listUsaha') }}" class="button-one wow fadeInRight animated"
                        data-wow-delay="0.3s">Mulai Pendanaan</a>
                </div> <!-- /.container -->
            </div> <!-- /.camera_caption -->
        </div>

        <div data-src="{{ asset('siteTemplate/customImage/slider/slide2.jpg') }}">
            <div class="camera_caption">
                <div class="container">
                    <h1 class="wow fadeInUp animated">Aminah</h1>
                    <p class="wow fadeInUp animated" data-wow-delay="0.2s"> Aman, Terjamin, dan Berbasis Syariah
                    </p>
                    <a href="{{ route('formulirPendanaan') }}" class="button-one wow fadeInLeft animated"
                        data-wow-delay="0.3s">Ajukan Pendanaan</a>
                    <a href="{{ route('listUsaha') }}" class="button-one wow fadeInRight animated"
                        data-wow-delay="0.3s">Mulai Pendanaan</a>
                </div> <!-- /.container -->
            </div> <!-- /.camera_caption -->
        </div>

    </div> <!-- /#theme-main-banner -->
    <!--
    =============================================
    Top Feature
    ==============================================
    -->
    <div class="top-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                    <div class="single-feature clearfix">
                        <img src="{{ asset('siteTemplate/images/icon/1.png') }}" alt="" class="float-left tran3s">
                        <div class="text float-left">
                            <p>Up to $5M</p>
                            <h4><a href="#" class="tran3s">FAST LOAN</a></h4>
                        </div> <!-- /.text -->
                    </div> <!-- /.single-feature -->
                </div> <!-- /.col- -->
                <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                    <div class="single-feature clearfix">
                        <img src="{{ asset('siteTemplate/images/icon/2.png') }}" alt="" class="float-left tran3s">
                        <div class="text float-left">
                            <p>We always Ready</p>
                            <h4><a href="#" class="tran3s">DEDICATED TEAM</a></h4>
                        </div> <!-- /.text -->
                    </div> <!-- /.single-feature -->
                </div> <!-- /.col- -->
                <div class="col-lg-4 d-md-none d-lg-block col-sm-4 col-12">
                    <div class="single-feature clearfix">
                        <img src="{{ asset('siteTemplate/images/icon/3.png') }}" alt="" class="float-left tran3s">
                        <div class="text float-left">
                            <p>24 Hours </p>
                            <h4><a href="#" class="tran3s">24/7 SUPPORTS</a></h4>
                        </div> <!-- /.text -->
                    </div> <!-- /.single-feature -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.top-feature -->


    <!--
           =============================================
            Our Service
           ==============================================
           -->
    <div class="our-service-two">
        <div class="container">
            <div class="theme-title text-center">
                <h2>Cara Kerja Kami</h2>
            </div> <!-- /.theme-title -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                        <h5><a href="service-details.html">Investment Banking</a></h5>
                        <p>Viamus aliquet rutrus duia variu sath eu Mauris ornoare tortor. Dosi quality fact. ipsum
                            ample text.</p>
                    </div> <!-- /.single-service -->
                </div> <!-- /.col- -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                        <h5><a href="service-details.html">Investment Banking</a></h5>
                        <p>Viamus aliquet rutrus duia variu sath eu Mauris ornoare tortor. Dosi quality fact. ipsum
                            ample text.</p>
                    </div> <!-- /.single-service -->
                </div> <!-- /.col- -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                        <h5><a href="service-details.html">Investment Banking</a></h5>
                        <p>Viamus aliquet rutrus duia variu sath eu Mauris ornoare tortor. Dosi quality fact. ipsum
                            ample text.</p>
                    </div> <!-- /.single-service -->
                </div> <!-- /.col- -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                        <h5><a href="service-details.html">Investment Banking</a></h5>
                        <p>Viamus aliquet rutrus duia variu sath eu Mauris ornoare tortor. Dosi quality fact. ipsum
                            ample text.</p>
                    </div> <!-- /.single-service -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.our-service -->



@endsection
