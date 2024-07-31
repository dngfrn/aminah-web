@extends('layouts.admin')
@section('main-content')
    <div>

        <h1 class="h3 mb-4 text-gray-800">List Pengajuan Usaha</h1>

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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-lg">List Pengajuan Usaha</h6>
                        <div class="d-flex flex-row mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Pemilik Usaha </th>
                                        <th scope="col">Nama Usaha</th>
                                        <th scope="col">Jumlah Pengajuan</th>
                                        <th scope="col">Status Pengajuan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $dataPengajuan->namaPemilik }}</td>
                                        <td>{{ $dataPengajuan->namaUsaha }}</td>
                                        <td>Rp{{ format_number($dataPengajuan->jumlahPengajuan ?: 0) }}</td>
                                        <td
                                            class="font-weight-bold {{ $dataPengajuan->review->statusPengajuan == 'CANCELED' ? 'text-danger' : 'text-primary' }}">
                                            {{ $dataPengajuan->review->statusPengajuan }}</td>
                                        <td>

                                            @if ($dataPengajuan->review->statusPengajuan == 'REVIEW')
                                                <a href="{{ route('pemilikUsaha.profileUpdate') }}"
                                                    class="btn btn-warning mr-3 text-dark">Edit</a>
                                                <a href="#"
                                                    onclick="modalCancelPengajuan('{{ route('pemilikUsaha.cancelPengajuan', $dataPengajuan->id) }}')"
                                                    class="btn btn-danger">Batalkan Pengajuan</a>
                                            @else
                                                <a href="{{ route('pemilikUsaha.viewPengajuan', $dataPengajuan->review->pengajuan_id) }}"
                                                    class="mr-3"><u>View</u></a>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
