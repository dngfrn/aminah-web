<!-- Tambahkan bagian ini untuk menampilkan tagihan -->
<div class="invoice-container"
    style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; color: #333;">Tagihan</h2>
    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <tr>
            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Deskripsi</th>
            <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Detail</th>
        </tr>

        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Bank Tujuan</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">
                {{ $pendanaan->pemodal->namaBank }}
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Nomor Rekening Tujuan</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">
                {{ $pendanaan->pemodal->noRekening }}
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Jumlah Tagihan</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Rp.
                {{ number_format($pendanaan->totalPembayaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Jatuh Tempo</td>
            <td style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">
                {{ $pendanaan->created_at->addDay()->format('d-m-Y') }}</td>
        </tr>

    </table>
</div>


<!-- Tambahkan tombol untuk input bukti transfer -->
<div class="upload-proof"
    style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <form action="{{ route('pemodal.subUploadBukti', encrypt($pendanaan->id)) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="bukti_transfer" style="display: block; margin-bottom: 5px;">Upload Bukti Transfer:</label>
            <input type="file" id="bukti_transfer" name="bukti_transfer" required
                style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <button type="submit"
            style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
    </form>
</div>
