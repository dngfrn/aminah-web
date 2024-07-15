@extends('layouts.admin')

@section('main-content')

<div class="container">
    <div class="card">
        <div class="col-md-12">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                </div>
                <div class="flex-grow-1 text-center">
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Investasi Bisnis Berlangsung') }}</h1>
                </div>
                <div class="d-flex align-items-center" style="visibility: hidden;">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('asset/gambarProduk/' . $data->gambarProduk) }}" class="img-fluid" alt="Business Image">
                </div>
                <h5 class="card-title mt-3" name="nama_usaha">{{ $data->namaUsaha }}</h5>
                <p class="card-text">Target (Rp): {{ number_format($data->jumlahPengajuan, 0, ',', '.') }}</p>
                <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" style="width: {{$dataProgress[$data->id]}}%;" aria-valuenow="{{$dataProgress[$data->id]}}" aria-valuemin="0" aria-valuemax="100">{{$dataProgress[$data->id]}}%</div>
                    {{-- <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div> --}}
                </div>
                @if(isset($totalInvestor[$data->review->id]))
                    <p class="card-text">Total Investor: {{ number_format($totalInvestor[$data->review->id], 0, ',', '.') }}</p>
                @else
                    <p class="card-text">Total Investor: 0</p>
                @endif
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" id="finansialButton">Finansial</button>
                    <button type="button" class="btn btn-secondary" id="kategoriButton">Kategori</button>
                    <button type="button" class="btn btn-secondary" id="deskripsiButton">Deskripsi Usaha</button>
                    <button type="button" class="btn btn-secondary" id="videoButton">Video Produk</button>
                </div>
                <div id="infoContainer">
                    <!-- Konten dinamis akan ditampilkan di sini -->
                </div>
                <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='{{ route('pemodal.subShowPembelian',encrypt($data->id)) }}'">Beli Unit</button>
            </div>
        </div>
    </div>
</div>
<script>
    const data = {
        finansial: `
            <p class="card-text mt-3">Periode imbal hasil (bulan): Rp. {{ number_format($data->profitBulanan, 0, ',', '.') }}</p>
            <p class="card-text">Persentase imbal hasil: {{ $data->persentaseBagiHasil }}%</p>
            <p class="card-text">Waktu jatuh tempo (bulan): {{ $data->periodeBagiHasil }} Bulan</p>
        `,
        kategori: `
            <p class="card-text">{{ $data->kategoriUsaha }}</p>
        `,
        deskripsi: `
            <p class="card-text">{{ $data->deskripsiUsaha }}</p>
        `,
        video: `
            <p>Informasi tambahan tentang video produk...</p>
        `
    };

    document.getElementById('finansialButton').addEventListener('click', function() {
        document.getElementById('infoContainer').innerHTML = data.finansial;
    });
    document.getElementById('kategoriButton').addEventListener('click', function() {
        document.getElementById('infoContainer').innerHTML = data.kategori;
    });
    document.getElementById('deskripsiButton').addEventListener('click', function() {
        document.getElementById('infoContainer').innerHTML = data.deskripsi;
    });
    document.getElementById('videoButton').addEventListener('click', function() {
        document.getElementById('infoContainer').innerHTML = data.video;
    });

    // Tampilkan konten default finansial saat halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('infoContainer').innerHTML = data.finansial;
    });
</script>

@endsection