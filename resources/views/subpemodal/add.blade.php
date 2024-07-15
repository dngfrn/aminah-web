@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Lengkapi Data Diri') }}</h1>

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
            <form action="{{route('pemodal.subStore')}}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" name="user_id" value="{{auth()->id()}}" aria-describedby="namaLengkap">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="namaLengkap" value="{{old('namaLengkap')}}" aria-describedby="namaLengkap">
                                <small id="namaLengkap" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                                    <option value="">--Select Option--</option>
                                    <option value="Laki - Laki" @if(old('jenisKelamin') == "Laki - Laki") selected @endif>Laki - Laki</option>
                                    <option value="Perempuan" @if(old('jenisKelamin') == "Perempuan") selected @endif>Perempuan</option>
                                </select>
                                <small id="email" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control">{{old('alamat')}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempatLahir" value="{{old('tempatLahir')}}"  aria-describedby="tempatLahir">
                                <small id="name" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggalLahir" value="{{old('tanggalLahir')}}"  aria-describedby="tanggalLahir">
                                <small id="tanggalLahir" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" value="{{old('pekerjaan')}}"  aria-describedby="pekerjaan">
                                <small id="name" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Foto KTP</label>
                                <input type="file" class="form-control" name="fotoKtp"  aria-describedby="fotoKtp">
                                <small id="tanggalLahir" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Bank</label>
                                <input type="text" class="form-control" name="namaBank" value="{{old('namaBank')}}" aria-describedby="namaBank">
                                <small id="name" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">No Rekening</label>
                                <input type="text" class="form-control" name="noRekening" value="{{old('noRekening')}}" aria-describedby="noRekening">
                                <small id="noRekening" class="form-text text-danger">*Required</small>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a href="{{route('pemodal.subIndex')}}" type="button" class="btn btn-sm btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@endsection