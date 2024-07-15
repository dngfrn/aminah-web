@extends('layouts.mainPage.layout')

@section('main-content')
    <div class="inner-banner">
        <div class="overlay">
            <div class="container clearfix">
                <h2>Pendaftaran Usaha</h2>
                <ul>
                    <li><a href="{{ route('indexPage') }}">Home</a></li>
                    <li>/</li>
                    <li>List Usaha</li>
                </ul>
            </div> <!-- /.container -->
        </div> <!-- /.overlay -->
    </div> <!-- /.inner-banner -->
     <!-- Search and Sort Form -->
     <div class="d-flex justify-content-center mb-4">
        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('listUsaha') }}" method="GET" class="w-100" style="max-width: 1200px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Bisnis" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                    <select name="sort" class="form-control ml-2" onchange="this.form.submit()">
                        <option value="namaUsaha" {{ request('sort') == 'namaUsaha' ? 'selected' : '' }}>Nama Usaha</option>
                        <option value="nilai_bisnis" {{ request('sort') == 'nilai_bisnis' ? 'selected' : '' }}>Nilai Bisnis</option>
                        <option value="total_investor" {{ request('sort') == 'total_investor' ? 'selected' : '' }}>Total Investor</option>
                    </select>
                    <button type="submit" class="btn btn-secondary ml-2">
                        <i class="fas fa-filter"></i> Sort by
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="row">
                @foreach ($pengajuan as $item)
                    <div class="col-md-12 mb-4">
                        <a href="{{ route('pemodal.subShow', encrypt($item->id)) }}" class="card-link">
                            <div class="card">
                                <div class="card-body shadow border">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('asset/gambarProduk/' . $item->gambarProduk) }}"
                                                class="img-fluid" alt="Business Image"
                                                onerror="if (this.src != '{{ asset('siteTemplate/images/blog/3.jpg') }}') this.src = '{{ asset('siteTemplate/images/blog/3.jpg') }}';">
                                        </div>
                                        <div class="col-md-10">
                                            <h5 class="card-title"><strong>{{ $item->namaUsaha }}</strong></h5>
                                            <p class="card-text">{{ $item->kategoriUsaha }}</p>
                                            <div class="progress mb-3">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $dataProgress[$item->id] }}%;"
                                                    aria-valuenow="{{ $dataProgress[$item->id] }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $dataProgress[$item->id] }}%</div>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <p class="card-text">Nilai Bisnis: Rp.
                                                    {{ number_format($item->jumlahPengajuan, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <p class="card-text">Terkumpul: Rp.
                                                    {{ number_format($dataProgress[$item->terkumpul], 0, ',', '.') }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <p class="card-text">Unit Tersedia:
                                                    {{ number_format(($item->jumlahPengajuan - $dataProgress[$item->terkumpul]) / 100000, 0, ',', '.') }}
                                                    (per unit Rp. 100.0000)
                                                </p>
                                                @if (isset($totalInvestor[$item->review->id]))
                                                    <p class="card-text">Total Investor:
                                                        {{ number_format($totalInvestor[$item->review->id]->total, 0, ',', '.') }}
                                                    </p>
                                                @else
                                                    <p class="card-text">Total Investor: 0</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
