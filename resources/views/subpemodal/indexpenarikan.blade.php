<!-- Tambahkan bagian ini untuk menampilkan tagihan -->
<div class="invoice-container" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; color: #333;">Penarikan</h2>
    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Deskripsi</th>
            <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Nilai</th>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Total Investasi</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Rp. {{ number_format($pendanaan->totalPembayaran - 100000, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Persentase Profit</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">{{$result->persentaseBagiHasil}} %</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Periode</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">{{$result->periodeBagiHasil}} Bulan</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Total Penarikan</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Rp. {{ number_format(($pendanaan->totalPembayaran - 100000) * ($result->persentaseBagiHasil / 100) + ($pendanaan->totalPembayaran - 100000) , 0, ',', '.') }}</td>
        </tr>
    </table>
    <form action="{{route('pemodal.subPenarikan',encrypt($pendanaan->id))}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 15px;">
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
        
    </form>
</div>

<!-- Tambahkan tombol untuk input bukti transfer -->
    
