@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('User') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <form action="{{route('users.store')}}" method="post">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" value="{{old('name')}}" name="name" aria-describedby="name">
                                <small id="name" class="form-text text-danger">*Required</small>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" aria-describedby="last_name">
                                <small id="last_name" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" aria-describedby="email" value="{{old('email')}}">
                                <small id="email" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--Select Option--</option>
                                    <option value="admin" @if(old('role') == 'admin') selected @endif>Admin</option>
                                    <option value="pemodal" @if(old('role') == 'pemodal') selected @endif>Pemodal</option>
                                    <option value="pelaku_usaha" @if(old('role') == 'pelaku_usaha') selected @endif>Pelaku Usaha</option>
                                </select>
                                <small id="role" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nomor Telpon</label>
                                <input type="text" class="form-control" value="{{old('noTelp')}}" name="noTelp" aria-describedby="noTelp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <small id="noTelp" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" value="{{old('password')}}" name="password" aria-describedby="password">
                                <small id="password" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" aria-describedby="password_confirmation">
                                <small id="password_confirmation" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a href="{{route('users.index')}}" type="button" class="btn btn-sm btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection