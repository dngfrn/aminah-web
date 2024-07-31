@extends('layouts.admin')

@section('main-content')

<div class="container">
    <div class="card col-md-9 mx-auto">
        
        <div>
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                </div>
                <div class="flex-grow-1 text-center">
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Pembelian') }}</h1>
                </div>
                <div class="d-flex align-items-center" style="visibility: hidden;">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pemodal.subStorePendanaan')}}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{asset('asset/gambarProduk/' . $data->gambarProduk) }}" alt="Business Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            <input type="hidden" name="review_id" id="review_id" value="{{$reviewId}}">
                        <input type="hidden" name="pemodal_id" id="pemodal_id" value="{{auth()->id()}}">
                        <input type="hidden" name="namaUsaha" id="namaUsaha" value="{{ $data->namaUsaha }}">
                        <h5 class="card-title ml-3" name="namaUsaha" id="namaUsaha"><strong style="font-size: 1.2em;">{{ $data->namaUsaha }}</strong></h5>
                    </div><hr>
                    <p class="card-text mt-3"><strong style="font-size: 1.2em;">Periode imbal hasil (bulan): Rp. <span id="totalImbalHasil"></strong></p>
                    {{-- <p class="card-text"><strong style="font-size: 1.2em;">Total Imbal Hasil: Rp. <span id="totalImbalHasil"></span></strong></p> --}}

                    <p class="card-text"><strong style="font-size: 1.2em;">Persentase imbal hasil: {{ $data->persentaseBagiHasil }}%</strong></p>
                    <p class="card-text"><strong style="font-size: 1.2em;">Waktu jatuh tempo (bulan): {{ $data->periodeBagiHasil }} Bulan</strong></p><hr>
                    <p class="card-text"><strong style="font-size: 1.2em;">Harga Per Unit : Rp 10.000.000</strong></p>
                    <p class="mr-3"><strong style="font-size: 1.2em;">Jumlah Unit: <span id="jumlahUnitDisplay" name="jumlahUnitDisplay">1</strong></span></p>
                    <div id="alertPlaceholder"></div>
                    <div class="form-group d-flex align-items-center">
                        <button type="button" class="btn btn-secondary" onmousedown="startDecrement()" onmouseup="stopChange()" onmouseleave="stopChange()">-</button>
                        <input type="number" id="jumlahUnit" name="jumlahUnit" value="1" min="1" class="form-control mx-2 flex-grow-1" style="text-align: center;" oninput="updateJumlahUnit()" max="{{ $sisatotal }}">
                        <button type="button" class="btn btn-secondary" onmousedown="startIncrement()" onmouseup="stopChange()" onmouseleave="stopChange()">+</button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h5 for="metodePembayaran">Pilih Metode Pembayaran</h5>
                        <select class="form-control" id="metodePembayaran">
                            <option>Pilih Metode Pembayaran</option>
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="kartu_kredit">Kartu Kredit</o
                            <!-- Tambahkan opsi metode pembayaran di sini -->
                        </select>
                    </div><hr>
                    <h5>Rincian Pembayaran</h5><br>
                    <div class="form-group">
                        <label for="nilaiInvestasi">Nilai Investasi (Rp)</label>
                        <input type="text" class="form-control" id="nilaiInvestasi" readonly data-max="{{ $data->jumlahPengajuan }}">
                    </div>
                    <div class="form-group">
                        <label for="biayaLayanan">Biaya Layanan (Rp)</label>
                        <input type="text" class="form-control" id="biayaLayanan" readonly value="10.000">
                    </div>
                    <div class="form-group">
                        <label for="totalPembayaran">Total Pembayaran (Rp)</label>
                        <input type="text" class="form-control" id="totalPembayaran" name="totalPembayaran" readonly>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-block">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function showAlert(message) {
        var alertPlaceholder = document.getElementById('alertPlaceholder');
        var alertHTML = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                ${message}
            </div>
        `;
        alertPlaceholder.innerHTML = alertHTML;

        // Menghilangkan alert setelah 3 detik
        setTimeout(function() {
            alertPlaceholder.innerHTML = '';
        }, 7000);
    }
    var interval;

    function startIncrement() {
        increment();
        interval = setInterval(increment, 200);
    }

    function startDecrement() {
        decrement();
        interval = setInterval(decrement, 200);
    }

    function stopChange() {
        clearInterval(interval);
    }

    function updateJumlahUnit() {
        var jumlahUnit = document.getElementById('jumlahUnit').value;
        document.getElementById('jumlahUnitDisplay').innerText = jumlahUnit;
        updatePembayaran();
    }

    function increment() {
        var jumlahUnit = document.getElementById('jumlahUnit');
        var maxUnit = parseInt(jumlahUnit.getAttribute('max'));
        if (parseInt(jumlahUnit.value) < maxUnit) {
            jumlahUnit.value = parseInt(jumlahUnit.value) + 1;
            updateJumlahUnit();
        }else {
            showAlert('Jumlah unit sudah mencapai maksimum dari yang tersedia...');
        }
    }

    function decrement() {
        var jumlahUnit = document.getElementById('jumlahUnit');
        if (jumlahUnit.value > 1) {
            jumlahUnit.value = parseInt(jumlahUnit.value) - 1;
            updateJumlahUnit();
        }
    }

    function updatePembayaran() {
        var jumlahUnit = document.getElementById('jumlahUnit').value;
        var hargaPerUnit = 1000000; // Harga per unit
        var nilaiInvestasi = jumlahUnit * hargaPerUnit;
        var biayaLayanan = 10000; // Biaya layanan tetap
        var totalPembayaran = nilaiInvestasi + biayaLayanan;

        var maxInvestasi = parseInt(document.getElementById('nilaiInvestasi').getAttribute('data-max'));

        if (nilaiInvestasi > maxInvestasi) {
            nilaiInvestasi = maxInvestasi;
            totalPembayaran = nilaiInvestasi + biayaLayanan;
        }

        var persentaseImbalHasil = {{ $data->persentaseBagiHasil }} / 100;
        var totalImbalHasil = nilaiInvestasi * persentaseImbalHasil;

        document.getElementById('nilaiInvestasi').value = nilaiInvestasi.toLocaleString('id-ID');
        document.getElementById('biayaLayanan').value = biayaLayanan.toLocaleString('id-ID');
        document.getElementById('totalPembayaran').value = totalPembayaran.toLocaleString('id-ID');
        document.getElementById('totalImbalHasil').innerText = totalImbalHasil.toLocaleString('id-ID');
    }

    // Inisialisasi nilai pembayaran saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updatePembayaran();
    });
</script>
@endsection