@extends('layouts.admin')

@section('main-content')
    <style>
        @media (min-width: 768px) {
            .flex-md {
                display: flex;

            }
        }
    </style>
    <div class="mx-3  my-3 border border-secondary rounded-lg">
        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-lg">
            <div class="font-weight-bold ">
                Status Pengajuan : <span class="text-danger">{{ $pengajuan->review->statusPengajuan }}</span>
            </div>
            <div>
                <a href="{{ route('pemilikUsaha.listPengajuan', auth()->user()->id) }}"
                    class="text-primary mr-3"><u>Kembali</u></a>
                @if ($pengajuan->review->statusPengajuan == 'CANCELED')
                    <a href="{{ route('pemilikUsaha.profileUpdate') }}" class="btn btn-primary mr-3 "> <i
                            class="fa-solid fa-plus mr-2"></i>Buat Pengajuan Baru</a>
                @endif

            </div>

        </div>

        <div class="flex-md flex-col p-2">
            <div>
                <table class="p-2 table  text-muted mr-5">
                    <tbody>
                        <tr>
                            <td style="font-weight: 700;">User</td>
                            <td>{{ $pengajuan->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Email</td>
                            <td>{{ $pengajuan->user->email }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Nomor HP</td>
                            <td>{{ $pengajuan->user->noTelp }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">NIK</td>
                            <td>{{ $pengajuan->nik }}</td>
                        </tr>

                        <tr>
                            <td style="font-weight: 700;">Nama Usaha</td>
                            <td>{{ $pengajuan->namaUsaha }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Nama Pemilik</td>
                            <td>{{ $pengajuan->namaPemilik ?: $pengajuan->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Alamat Usaha</td>
                            <td>{{ $pengajuan->alamatUsaha }}</td>
                        </tr>

                        <tr>
                            <td style="font-weight: 700;">Kategori Usaha</td>
                            <td>{{ $pengajuan->kategoriUsaha }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Alamat Pemilik Usaha</td>
                            <td>{{ $pengajuan->alamat }}</td>
                        </tr>




                    </tbody>
                </table>
            </div>
            <div>
                <table class="p-2 table  text-muted">
                    <tbody>
                        <tr>
                            <td style="font-weight: 700;">Deskripsi Produk</td>
                            <td>{{ $pengajuan->kategoriUsaha }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Omset Perbulan</td>
                            <td>{{ $pengajuan->omsetPerBulan }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Rencana Penggunaan Dana</td>
                            <td>{{ $pengajuan->rencanaPengajuan }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Jumlah Dana Yang Dibutuhkan</td>
                            <td>{{ $pengajuan->jumlahPengajuan }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Persentase Bagi Hasil</td>
                            <td>{{ $pengajuan->persentaseBagiHasil }}%</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Periode Bagi Hasil</td>
                            <td>{{ $pengajuan->periodeBagiHasil }} Bulan</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Company Profile</td>
                            <td>[Image]</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Foto KTP Pemilik Usaha</td>
                            <td>[Image]</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Gambar Produk Usaha</td>
                            <td>[Image]</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700;">Laporan Keuangan Tiga Bulan Terakhir</td>
                            <td>[File]</td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
