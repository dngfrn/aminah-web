@extends('layouts.mainPage.layout')

@section('main-content')
    <!--
                   =============================================
                    Theme Inner Banner
                   ==============================================
                   -->
    <div class="inner-banner">
        <div class="overlay">
            <div class="container clearfix">
                <h2>Pendaftaran Usaha</h2>
                <ul>
                    <li><a href="{{ route('indexPage') }}">Home</a></li>
                    <li>/</li>
                    <li>Pendaftaran Usaha</li>
                </ul>
            </div> <!-- /.container -->
        </div> <!-- /.overlay -->
    </div> <!-- /.inner-banner -->
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="contact-us-form">
                        <form action="{{ route('sendFormulirPendanaan') }}" method="POST" class="form-styl-two"
                            autocomplete="off">
                            @csrf
                            <div class="mt-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Pemilik Usaha</label>
                                <input type="text" name="name"
                                    class="form-control @if ($errors->has('name')) is-invalid @endif" value="{{old('name')}}"
                                    style="margin-bottom: 0px !important;">
                                {{-- <input type="text" name="name" class="form-control is-invalid" style="margin-bottom: 0px !important;"> --}}
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif" name="email"  value="{{old('email')}}"
                                    style="margin-bottom: 0px !important;">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">No Hp</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('noTelp')) is-invalid @endif" name="noTelp" value="{{old('noTelp')}}"
                                    style="margin-bottom: 0px !important;"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                @if ($errors->has('noTelp'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('noTelp') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password"
                                    class="form-control @if ($errors->has('password')) is-invalid @endif" name="password" value="{{old('password')}}"
                                    style="margin-bottom: 0px !important;">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"
                                    style="margin-bottom: 0px !important;">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div> <!-- /.contact-us-form -->
                </div> <!-- /.col- -->
                <div class="col-lg-5 col-12">
                    <div class="contact-address">
                        <h2>Kembangkan Bisnis Anda Bersama Kami, Jika Bersama Pasti Ada Solusi</h2>
                        <br>
                        <a href="#" class="tran3s">880 876 65 455</a>
                        <ul>
                            <li><a href="" class="tran3s"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="" class="tran3s"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="" class="tran3s"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                            <li><a href="" class="tran3s"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div> <!-- /.contact-address -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
        </div> <!-- /.conatiner -->

        <!--Contact Form Validation Markup -->
        <!-- Contact alert -->
        <div class="alert-wrapper" id="alert-success">
            <div id="success">
                <button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
                <div class="wrapper">
                    <p>Your message was sent successfully.</p>
                </div>
            </div>
        </div> <!-- End of .alert_wrapper -->
        <div class="alert-wrapper" id="alert-error">
            <div id="error">
                <button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
                <div class="wrapper">
                    <p>Sorry!Something Went Wrong.</p>
                </div>
            </div>
        </div> <!-- End of .alert_wrapper -->
    </div> <!-- /.contact-us -->
@endsection
