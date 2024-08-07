@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Pemodal') }}</h1>

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
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h4>Data Pemodal</h4>
                        <a href="{{ route('pemodal.create') }}" type="button" class="add btn btn-sm btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form id="searchForm" method="GET">
                            <div class="row mb-2 justify-content-end">
                                <div class="col-sm-3">
                                    <label>Rows per page: <select name="perPage"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            style="width:auto;display:inline-block;" id="perPageDropdown"
                                            onchange="search()">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select></label>
                                </div>
                                <div class="col"></div>
                                <div class="col-sm-2">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-sm-3">
                                            <label for="periodeSelect2" class="col-form-label">Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" value="{{request('name')}}" placeholder="Search By Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-sm-5">
                                            <label for="kontrakSelect2" class="col-form-label">Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="pekerjaan" value="{{request('pekerjaan')}}" placeholder="Search By Pekerjaan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-sm-5">
                                            <label for="kontrakSelect2" class="col-form-label">No Rekening</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="noRekening" value="{{request('noRekening')}}" placeholder="Search By No Rek">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" onclick="search()" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <table id="myTable" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datas->total() > 0)
                                @foreach ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $key }}</td>
                                        <td>{{ @$data->user->email }}</td>
                                        <td>{{ @$data->namaLengkap }}</td>
                                        <td>{{ @$data->jenisKelamin }}</td>
                                        <td>{{ @$data->tempatLahir }}, {{@$data->tanggalLahir}}</td>
                                        <td>{{ @$data->pekerjaan }}</td>
                                        <td>
                                            <a href="{{ route('pemodal.edit', $data->id) }}"
                                                class="mr-2 btn btn-warning btn-sm">Edit</a>
                                            <a onclick="swalDell('{{ route('pemodal.destroy', $data->id) }}')"
                                                href="#" class="mr-2 btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else 
                                    <tr>
                                        <td colspan="7" style="text-align:center"> Empty Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <span>Showing {{ $datas->firstItem() }} to {{ $datas->lastItem() }} of
                                    {{ $datas->total() }} entries </span>
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex justify-content-end">
                                {{-- {{$datas->links()}} --}}
                                {!! $datas->appends(request()->except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
         function swalDell(uri) {
            console.log(uri);
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
                    window.location.href = uri;
                }
            });
        }
    </script>
@endpush
@endsection
