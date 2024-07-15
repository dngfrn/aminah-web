@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Search and Sort Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <h4>Total Data Pendanaan: {{$pendanaan->count()}} Data</h4>
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
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table id="myTable" class="display table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Usaha</th>
                                            <th>Status</th>
                                            <th>Dana Di Setor Oleh Pemodal</th>
                                            <th>Pengembalian Dana Diterima Oleh Pemodal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendanaan as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->namaUsaha }}</td>
                                            <td>{{ $item->statusPendanaan->statusPendanaan }}</td>
                                            <td class="text-center">
                                                @if(in_array($item->statusPendanaan->statusPendanaan, ['PENDING','REVIEW']))
                                                    <i class="fa-regular fa-hourglass-half"></i>
                                                @elseif(in_array($item->statusPendanaan->statusPendanaan, ['ACCEPT', 'TRANSFERED', 'DONE']))
                                                    <i class="fa-solid fa-check"></i>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @if($item->statusPendanaan->statusPendanaan == 'DONE')
                                                    <i class="fa-solid fa-check"></i>
                                                @else
                                                    <i class="fa-regular fa-hourglass-half"></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->statusPendanaan->statusPendanaan == 'PENDING')
                                                    <a href="{{ route('pemodal.subIndexSetoran',encrypt($item->id))}}" class="mr-2 btn btn-success btn-sm">Setor Dana</a>
                                                @elseif($item->statusPendanaan->statusPendanaan == 'TRANSFERED')
                                                    <a href="{{ route('pemodal.subIndexPenarikan',encrypt($item->id))}}" class="mr-2 btn btn-success btn-sm">Tarik Dana</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection