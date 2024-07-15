@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengajuan Usaha') }}</h1>

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
                <form action="{{ route('pengajuan.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">User</label>
                                    <select name="user_id" class="form-control" id="userSelect2"></select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Nama Usaha</label>
                                    <input type="namaUsaha" class="form-control" id="namaUsaha" name="namaUsaha"
                                        value="{{ old('namaUsaha') }}" placeholder="Nama Usaha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="namaPemilik" name="namaPemilik"
                                        value="{{ old('namaPemilik') }}" placeholder="Nama Pemilik">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Alamat Usaha</label>
                                    <textarea class="form-control" id="alamatUsaha" name="alamatUsaha" placeholder="Alamat Usaha">{{ old('alamatUsaha') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="NIK" value="{{ old('nik') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Kategori Usaha</label>
                                    <input type="kategori" class="form-control" id="kategori" name="kategoriUsaha"
                                        placeholder="Kategori Usaha" value="{{ old('kategoriUsaha') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alamat Pemilik Usaha</label>
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Pemilik Usaha">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Deskripsi Produk</label>
                                    <textarea class="form-control" id="deskripsiUsaha" name="deskripsiUsaha" placeholder="Deskripsi Produk">{{ old('deskripsiUsaha') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Telpon</label>
                                    <input type="text" class="form-control" disabled id="no_telp"
                                        placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Omset Perbulan</label>
                                    <input type="text" class="form-control" id="omsetPerBulan" name="omsetPerBulan"
                                        value="{{ old('omsetPerBulan') }}" placeholder="Omset Per Bulan (Rp)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" disabled class="form-control" id="email"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Rencana Penggunaan Dana</label>
                                    <textarea class="form-control" id="rencanaPengajuan" name="rencanaPengajuan" placeholder="Rencana Penggunaan Dana">{{ old('rencanaPengajuan') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Dana Yang Dibutuhkan</label>
                                    <input type="text" class="form-control" id="jumlahPengajuan"
                                        name="jumlahPengajuan" value="{{ old('jumlahPengajuan') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Jumlah Dana Yang Dibutuhkan">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label for="">Presentase Bagi Hasil</label>
                                    <input type="text" class="form-control" id="persentaseBagiHasil"
                                        name="persentaseBagiHasil" value="{{ old('persentaseBagiHasil') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Presentase Bagi Hasil">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Periode Bagi Hasil</label>
                                    <input type="text" class="form-control" id="periodeBagiHasil"
                                        value="{{ old('periodeBagiHasil') }}" name="periodeBagiHasil" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Periode Bagi Hasil">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Company Profile</label>
                                    <input type="file" class="form-control" id="companyProfile"
                                        name="companyProfile">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Foto KTP Pemilik Usaha</label>
                                    <input type="file" class="form-control" id="fotoKtp" name="fotoKtp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gambar Produk Usaha</label>
                                    <input type="file" class="form-control" id="gambarProduk" name="gambarProduk">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Laporan Keuangan Tiga Bulan Terakhir</label>
                                    <input type="file" class="form-control" id="omsetTigaBulanTerakhir"
                                        name="omsetTigaBulanTerakhir">
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        <a href="{{ route('pengajuan.index') }}" type="button" class="btn btn-sm btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#userSelect2').select2({
                    ajax: {
                        delay: 250,
                        url: '{{ route('users.listUser') }}?role=pelaku_usaha',
                        data: function(params) {
                            var query = {
                                "search": params.term
                            }
                            return query;
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.datas.data,
                                pagination: {
                                    more: (params.page * data.datas.per_page) < data.datas.total
                                }
                            }
                        }
                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    },
                    allowClear: true,
                    placeholder: 'Select User',
                    templateResult: function(data) {
                        return data.name || data.text;
                    },
                    templateSelection: function(data) {
                        return data.name || data.text;
                    }
                });
                $('#userSelect2').on("change",function(e){checkData($(this).select2('data'))})
                function checkData(e){
                    if(e.length > 0){
                        let data = e[0];
    
                        if(data.text === ""){
                            $("#no_telp").val(data.noTelp);
                            $("#email").val(data.email);
                        }
                    }else{
                        $("#no_telp").val("");
                        $("#email").val("");
                    }
                }
            });
        </script>
        @if (old('user_id'))
            <script>
                $(document).ready(function() {
                    function setUserData(uri) {
                        $.ajax({
                            type: 'GET',
                            url: uri
                        }).then(function(data) {
                            // create the option and append to Select2
                            var option = new Option(data.datas.name, data.datas.id, true, true);

                            $('#userSelect2').append(option).trigger('change');
                            console.log(data);
                            var detailUser = data.datas;
                            $("#no_telp").val(detailUser.noTelp);
                            $("#email").val(detailUser.email);
                            $('#userSelect2').trigger({
                                type: 'select2:select',
                                params: {
                                    data: data.datas
                                }
                            });

                        });
                    }

                    var uri = '{{ route('users.edit', old('user_id')) }}';
                    setUserData(uri);
                });
            </script>
        @endif
    @endpush
@endsection
