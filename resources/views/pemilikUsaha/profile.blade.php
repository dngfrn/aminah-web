@extends('layouts.admin')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile Usaha') }}</h1>

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


        <div class="col-lg-12 order-lg-1">

            <form method="POST" action="{{ route('pemilikUsaha.profileUpdate') }}" enctype="multipart/form-data"
                autocomplete="off">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-lg">Detail Profile Usaha</h6>
                        <div class="d-flex flex-row">
                            <button type="submit" name="action" value="submitUpdateProfile"
                                class="btn btn-primary mr-3">Simpan</button>
                        </div>
                    </div>

                    <div class="card-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">


                        @if (isset($pengajuan->review))
                            <div class="font-weight-bold mb-3 ">
                                Status Pengajuan : <span
                                    class="text-danger">{{ $pengajuan->review->statusPengajuan }}</span>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">User</label>
                                    <input type="text" value="{{ $user->name }}" disabled class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Nama Usaha</label>
                                    <input type="namaUsaha"
                                        class="form-control @if ($errors->has('namaUsaha')) is-invalid @endif"
                                        id="namaUsaha" name="namaUsaha"
                                        value="{{ old('namaUsaha') ?: @$pengajuan->namaUsaha }}" placeholder="Nama Usaha">
                                    @if ($errors->has('namaUsaha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('namaUsaha') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nama Pemilik</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('namaPemilik')) is-invalid @endif"
                                        id="namaPemilik" name="namaPemilik"
                                        value="{{ old('namaPemilik') ?: (@$pengajuan->namaPemilik ?: $user->name) }}"
                                        placeholder="Nama Pemilik">
                                    @if ($errors->has('namaPemilik'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('namaPemilik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Alamat Usaha</label>
                                    <textarea class="form-control @if ($errors->has('alamatUsaha')) is-invalid @endif" id="alamatUsaha" name="alamatUsaha"
                                        placeholder="Alamat Usaha">{{ old('alamatUsaha') ?: @$pengajuan->alamatUsaha }}</textarea>
                                    @if ($errors->has('alamatUsaha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alamatUsaha') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="">NIK</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('nik')) is-invalid @endif"
                                        id="nik" name="nik" placeholder="NIK"
                                        value="{{ old('nik') ?: @$pengajuan->nik }}">
                                    @if ($errors->has('nik'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Kategori Usaha</label>
                                    <input type="kategori"
                                        class="form-control @if ($errors->has('kategoriUsaha')) is-invalid @endif"
                                        id="kategori" name="kategoriUsaha" placeholder="Kategori Usaha"
                                        value="{{ old('kategoriUsaha') ?: @$pengajuan->kategoriUsaha }}">
                                    @if ($errors->has('kategoriUsaha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kategoriUsaha') }}
                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alamat Pemilik Usaha</label>
                                    <textarea class="form-control @if ($errors->has('alamat')) is-invalid @endif" id="alamat" name="alamat"
                                        placeholder="Alamat Pemilik Usaha">{{ old('alamat') ?: @$pengajuan->alamat }}</textarea>
                                    @if ($errors->has('alamat'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alamat') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Deskripsi Produk</label>
                                    <textarea class="form-control @if ($errors->has('deskripsiUsaha')) is-invalid @endif" id="deskripsiUsaha"
                                        name="deskripsiUsaha" placeholder="Deskripsi Produk">{{ old('deskripsiUsaha') ?: @$pengajuan->kategoriUsaha }}</textarea>
                                    @if ($errors->has('deskripsiUsaha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('deskripsiUsaha') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No. Telpon</label>
                                    <input type="text" class="form-control" disabled id="no_telp"
                                        value="{{ $user->noTelp }}" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Omset Perbulan</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('omsetPerBulan')) is-invalid @endif"
                                        id="omsetPerBulan" name="omsetPerBulan"
                                        value="{{ old('omsetPerBulan') ?: @$pengajuan->omsetPerBulan }}"
                                        placeholder="Omset Per Bulan (Rp)"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @if ($errors->has('omsetPerBulan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('omsetPerBulan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" disabled class="form-control" id="email"
                                        value="{{ $user->email }}" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Rencana Penggunaan Dana</label>
                                    <textarea class="form-control @if ($errors->has('rencanaPengajuan')) is-invalid @endif" id="rencanaPengajuan"
                                        name="rencanaPengajuan" placeholder="Rencana Penggunaan Dana">{{ old('rencanaPengajuan') ?: @$pengajuan->kategoriUsaha }}</textarea>
                                    @if ($errors->has('rencanaPengajuan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rencanaPengajuan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Dana Yang Dibutuhkan</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('jumlahPengajuan')) is-invalid @endif"
                                        id="jumlahPengajuan" name="jumlahPengajuan"
                                        value="{{ old('jumlahPengajuan') ?: @$pengajuan->jumlahPengajuan }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Jumlah Dana Yang Dibutuhkan">
                                    @if ($errors->has('jumlahPengajuan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jumlahPengajuan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Presentase Bagi Hasil</label>
                                    <select name="persentaseBagiHasil"
                                        class="form-control @if ($errors->has('persentaseBagiHasil')) is-invalid @endif"
                                        id="persentaseBagiHasil">
                                        <option value="">-- Pilih Option -- </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 1) selected @endif value="1">1%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 2) selected @endif value="2">2%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 3) selected @endif value="3">3%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 4) selected @endif value="4">4%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 5) selected @endif value="5">5%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 6) selected @endif value="6">6%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 7) selected @endif value="7">7%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 8) selected @endif value="8">8%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 9) selected @endif value="9">9%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 10) selected @endif value="10">10%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 11) selected @endif value="11">11%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 12) selected @endif value="12">12%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 13) selected @endif value="13">13%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 14) selected @endif value="14">14%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 15) selected @endif value="15">15%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 16) selected @endif value="16">16%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 17) selected @endif value="17">17%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 18) selected @endif value="18">18%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 19) selected @endif value="19">19%
                                        </option>
                                        <option @if (old('persentaseBagiHasil') ?: @$pengajuan->persentaseBagiHasil == 20) selected @endif value="20">20%
                                        </option>
                                    </select>
                                    @if ($errors->has('persentaseBagiHasil'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('persentaseBagiHasil') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Periode Bagi Hasil</label>
                                    <select name="periodeBagiHasil"
                                        class="form-control @if ($errors->has('periodeBagiHasil')) is-invalid @endif"
                                        id="periodeBagiHasil">
                                        <option value="">-- Pilih Option -- </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '1') selected @endif value="1">1
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '2') selected @endif value="2">2
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '3') selected @endif value="3">3
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '4') selected @endif value="4">4
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '5') selected @endif value="5">5
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '6') selected @endif value="6">6
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '7') selected @endif value="7">7
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '8') selected @endif value="8">8
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '9') selected @endif value="9">9
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '10') selected @endif value="10">10
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '11') selected @endif value="11">11
                                            Bulan
                                        </option>
                                        <option @if (old('periodeBagihasil') ?: @$pengajuan->periodeBagiHasil == '12') selected @endif value="12">12
                                            Bulan
                                        </option>
                                    </select>
                                    @if ($errors->has('periodeBagiHasil'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('periodeBagiHasil') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Company Profile</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('companyProfile')) is-invalid @endif"
                                        id="companyProfile" name="companyProfile">
                                    @if ($errors->has('companyProfile'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('companyProfile') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Foto KTP Pemilik Usaha</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('fotoKtp')) is-invalid @endif"
                                        id="fotoKtp" name="fotoKtp">
                                    @if ($errors->has('fotoKtp'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fotoKtp') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gambar Produk Usaha</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('gambarProduk')) is-invalid @endif"
                                        id="gambarProduk" name="gambarProduk">
                                    @if ($errors->has('gambarProduk'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gambarProduk') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Laporan Keuangan Tiga Bulan Terakhir</label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('omsetTigaBulanTerakhir')) is-invalid @endif"
                                        id="omsetTigaBulanTerakhir" name="omsetTigaBulanTerakhir">
                                    @if ($errors->has('omsetTigaBulanTerakhir'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('omsetTigaBulanTerakhir') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Button -->
                        {{-- <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div> --}}

                    </div>


                </div>
            </form>

        </div>

    </div>

@endsection
