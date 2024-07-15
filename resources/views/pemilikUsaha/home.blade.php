@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

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

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengajuan Dana</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ format_number($totalPengajuan) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dana Terkumpul</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                {{ format_number(@$investorDetail->total ?: 0) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Dana Terkumpul</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    @php
                                        $totalPendanaan = @$investorDetail->total ?: 0;
                                        $totalPengajuan = @$totalPengajuan;

                                        $percent = ($totalPendanaan / $totalPengajuan) * 100;
                                    @endphp
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $percent }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ __('Total Investor') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ @$investorDetail->total_investor ?: 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Pengajuan Anda
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ str_replace('_', ' ', $status) }}</div>
                            @if ($status == 'TRANSFER_USER')
                                <a onclick="swalApprove('{{ route('pemilikUsaha.receivePendanaan') }}','Receive')"
                                    class="mt-4 btn btn-success btn-sm">Terima Dana</a>
                            @endif
                            @if ($status == 'RECEIVED')
                                <a onclick="swalApprove('{{ route('pemilikUsaha.sendPendanaan') }}','Send')"
                                    class="mt-4 btn btn-success btn-sm">Setor Dana</a>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function swalApprove(uri, status) {
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
