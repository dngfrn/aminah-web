@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pendanaan Usaha') }}</h1>

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
                            <h4>Data Pendanaan</h4>
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
                                            <div class="col">
                                                <input type="text" class="form-control" name="namaUsaha"
                                                    value="{{ request('namaUsaha') }}" placeholder="Search By Nama Usaha">
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
                                                    {{-- <option @if(request('status') == 'reject')          selected @endif value="reject">Reject</option> --}}
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
                                            <th>Nama Pemodal</th>
                                            <th>Nama Nama Usaha</th>
                                            <th>Jumlah Unit</th>
                                            <th>Total Pembayaran</th>
                                            <th>Persentase Bagi Hasil</th>
                                            <th>Estimasi Bagi Hasil</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($datas->total() > 0)
                                            @foreach ($datas as $key => $data)
                                                <tr>
                                                    <td>{{ $datas->firstItem() + $key }}</td>
                                                    <td>{{ @$data->pemodal->namaLengkap }} </td>
                                                    <td>{{ @$data->namaUsaha }} </td>
                                                    <td>{{ @$data->jumlahUnit }}</td>
                                                    <td>Rp. {{ number_format(@$data->totalPembayaran ?: 0) }}</td>
                                                    <td>
                                                        {{@$data->review->pengajuan->persentaseBagiHasil}}
                                                    </td>
                                                    <td>
                                                        @php 
                                                            $percent = @$data->review->pengajuan->persentaseBagiHasil ?: 0;
                                                            $percentValue = @$data->totalPembayaran ?: 0 * ($percent/100);
                                                            $percentValue += @$data->totalPembayaran ?: 0;
                                                        @endphp 

                                                        Rp. {{ number_format(@$percentValue ?: 0) }}
                                                    </td>
                                                    <td>{{ @$data->statusPendanaan->statusPendanaan }}</td>
                                                    <td>
                                                        @if(@$data->statusPendanaan->statusPendanaan == 'REVIEW')
                                                            <a onclick="swalApprove('{{ route('admin.acceptPemodalTransfer', $data->id) }}','Accept')"
                                                                class="mr-2 btn btn-primary btn-sm">Terima Dari Pemodal</a>
                                                            <a onclick="swalApprove('{{ route('admin.rejectPemodalTransfer', $data->id) }}','Reject')"
                                                                class="mr-2 btn btn-primary btn-sm">Tolak Dari Pemodal</a>
                                                        @endif

                                                        @if(@$data->statusPendanaan->statusPendanaan == 'ACCEPT' && @$data->review->statusPengajuan == 'DONE')
                                                            <a onclick="swalApprove('{{ route('admin.PemodalTransfered', $data->id) }}','Receive')"
                                                                class="mr-2 btn btn-primary btn-sm">Setor Ke Pemodal</a>
                                                        @endif
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
                    confirmButtonText: "Yes, "+status+" it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: uri,
                            type: "POST",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire(
                                    status,
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
