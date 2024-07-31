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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <h4>Data User</h4>
                            <a href="{{ route('users.create') }}" type="button"
                                class="add btn btn-sm btn-primary">Tambah</a>
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
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ request('name') }}" placeholder="Search By Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-sm-3">
                                                <label for="kontrakSelect2" class="col-form-label">Email</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ request('email') }}" placeholder="Search By Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-sm-3">
                                                <label for="kontrakSelect2" class="col-form-label">Role</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="role"
                                                    value="{{ request('role') }}" placeholder="Search By Role">
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($datas->total() > 0)
                                        @foreach ($datas as $key => $data)
                                            <tr>
                                                <td>{{ $datas->firstItem() + $key }}</td>
                                                <td>{{ @$data->name }}</td>
                                                <td>{{ @$data->last_name }}</td>
                                                <td>{{ @$data->email }}</td>
                                                <td>{{ @$data->role ? ucwords(str_replace('_', ' ', $data->role)) : '' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.edit', $data->id) }}"
                                                        class="mr-2 btn btn-warning btn-sm">Edit</a>
                                                    <a onclick="swalDell('{{ route('users.destroy', $data->id) }}')"
                                                        href="#" class="mr-2 btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" style="text-align:center"> Empty Data</td>
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
