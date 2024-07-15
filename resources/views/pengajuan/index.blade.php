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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <h4>Data Pengajuan</h4>
                            <a href="{{ route('pengajuan.create') }}" type="button"
                                class="add btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form id="searchForm" method="GET">
                                <div class="row mb-2 justify-content-end">
                                    <div class="col mr-auto">
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
                                    <div class="col-auto">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <input type="text" class="form-control" name="namaPemilik"
                                                    value="{{ request('namaPemilik') }}" placeholder="Search By Nama Pemilik">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row g-3 align-items-center">
                                            <div class="col">
                                                <input type="text" class="form-control" name="namaUsaha"
                                                    value="{{ request('namaUsaha') }}" placeholder="Search By Nama Usaha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <input type="text" class="form-control" name="nik"
                                                    value="{{ request('nik') }}" placeholder="Search By Nik">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <input type="text" class="form-control" name="kategoriUsaha"
                                                    value="{{ request('kategoriUsaha') }}" placeholder="Search By Kategori Usaha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <select name="status" class="form-control" onchange="this.form.submit()">
                                                    <option value="">Filter Status</option>
                                                    <option @if(request('status') == 'review')          selected @endif value="review">Review</option>
                                                    <option @if(request('status') == 'accept')          selected @endif value="accept">Accept</option>
                                                    <option @if(request('status') == 'reject')          selected @endif value="reject">Reject</option>
                                                    <option @if(request('status') == 'review')          selected @endif value="review">Review</option>
                                                    <option @if(request('status') == 'fulfill')         selected @endif value="fulfill">Fulfill</option>
                                                    <option @if(request('status') == 'transfer_user')   selected @endif value="transfer_user">Transfer User</option>
                                                    <option @if(request('status') == 'received')        selected @endif value="received">Received</option>
                                                    <option @if(request('status') == 'transfered')      selected @endif value="transfered">Transfered</option>
                                                    <option @if(request('status') == 'done')            selected @endif value="done">Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" onclick="search()" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table id="myTable" class="display table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Nama Pemilik</th>
                                            <th>Nik</th>
                                            <th>Nama Usaha</th>
                                            <th>Kategori Usaha</th>
                                            <th>Jumlah Pengajuan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($datas->total() > 0)
                                            @foreach ($datas as $key => $data)
                                                <tr>
                                                    <td>{{ $datas->firstItem() + $key }}</td>
                                                    <td>{{ @$data->user->email }}</td>
                                                    <td>{{ @$data->namaPemilik }}</td>
                                                    <td>{{ @$data->nik }}</td>
                                                    <td>{{ @$data->namaUsaha }} </td>
                                                    <td>{{ @$data->kategoriUsaha }}</td>
                                                    <td>Rp. {{ format_number(@$data->jumlahPengajuan) }}</td>
                                                    <td>{{ @$data->review->statusPengajuan }}</td>
                                                    <td>
                                                        @if(@$data->review->statusPengajuan == 'REVIEW')
                                                            <a href="{{ route('pengajuan.edit', $data->id) }}"
                                                                class="mr-2 btn btn-warning btn-sm">Edit</a>
                                                            <a onclick="swalApprove('{{ route('pengajuan.approvePengajuan', $data->id) }}','accept')"
                                                                class="mr-2 btn btn-secondary btn-sm">Approve</a>
                                                            <a onclick="swalreject('{{ route('pengajuan.approvePengajuan', $data->id) }}','reject')"
                                                                class="mr-2 btn btn-secondary btn-sm">Reject</a>
                                                        @endif
                                                        <a href="{{ route('pengajuan.show', $data->id) }}"
                                                            class="mr-2 btn btn-primary btn-sm">Detail</a>
                                                        <a onclick="swalDell('{{ route('pengajuan.destroy', $data->id) }}')"
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
                            </div>

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
                        $.ajax({
                            url: uri,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire(
                                    'Cancelled',
                                    'Delete Is Failed',
                                    'error'
                                );
                            }
                        });

                    }
                });
            }
            function swalApprove(uri,status) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, approve it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: uri,
                            type: "POST",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                'status':status
                            },
                            success: function() {
                                Swal.fire(
                                    'Approved!',
                                    '',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire(
                                    'Cancelled',
                                    'Update Is Failed',
                                    'error'
                                );
                            }
                        });

                    }
                });
            }
            function swalreject(uri,status) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, reject it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: uri,
                            type: "POST",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                'status':status
                            },
                            success: function() {
                                Swal.fire(
                                    'Rejected!',
                                    '',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire(
                                    'Cancelled',
                                    'Update Is Failed',
                                    'error'
                                );
                            }
                        });

                    }
                });
            }
        </script>
    @endpush
@endsection
