<?php

namespace App\Http\Controllers\pemodal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Pendanaan;
use App\Models\Pemodal;
use App\Models\PendanaanStatus;
use Carbon\Carbon;

class PemodalController extends Controller
{
    //
    public function index(Request $request)
    {
        $pemodal = Pemodal::where('user_id', auth()->id())->first();
        if ($pemodal) {
            $search = $request->input('search');
            $search = str_replace('.', '', $search);
            $pengajuan = Pengajuan::whereHas('review', function ($query) {
                $query->where('statusPengajuan', 'ACCEPT');
            })->orderBy('updated_at', 'desc')->get();

            $totalInvestor = Pendanaan::whereHas('review', function ($query) {
                $query->where('statusPengajuan', 'Accept');
            })->select('review_id', \DB::raw('COUNT(review_id) as total'))->groupBy('review_id')->get()->keyBy('review_id');

            $dataProgress = [];
            foreach ($pengajuan as $item) {
                $totalPendanaan = Pendanaan::where('review_id', $item->review->id)->whereHas('statusPendanaan', function ($query) {
                    $query->where('statusPendanaan', '<>', 'REJECT');
                })->sum(\DB::raw('jumlahUnit * 100000'));
                $dataProgress[$item->id] = ($totalPendanaan / $item->jumlahPengajuan) * 100;
                $dataProgress[$item->terkumpul] = $totalPendanaan;
            }

            $pengajuan = $pengajuan->reject(function ($item) use ($dataProgress) {
                return $dataProgress[$item->id] >= 100;
            });

            // dd($pengajuan);
            return view('subpemodal.index', compact('pengajuan', 'totalInvestor', 'dataProgress', 'search',));
        } else {
            return view('subpemodal.add');
        }
    }

    public function indexPendanaan()
    {
        $pendanaan = Pendanaan::where('pemodal_id', auth()->id())
            ->with(['statusPendanaan' => function ($query) {
                $query->from('status_pendanaan');
            }])->get();
        return view('subpemodal.indexpendanaan', compact('pendanaan'));
    }

    public function indexSetoran($id)
    {
        $pendanaan = Pendanaan::with('pemodal')->where('id', decrypt($id))->select('id', 'pemodal_id', 'totalPembayaran', 'created_at')->first();
        return view('subpemodal.indexsetoran', compact('pendanaan'));
    }

    public function indexPenarikan($id)
    {
        $pendanaan = Pendanaan::where('id', decrypt($id))->select('id', 'totalPembayaran', 'review_id')->first();

        $result = Pengajuan::whereHas('review', function ($query) use ($pendanaan) {
            $query->where('id', $pendanaan->review_id);
        })->first(['persentaseBagiHasil', 'periodeBagiHasil']);

        return view('subpemodal.indexpenarikan', compact('pendanaan', 'result',));
    }

    public function storePenarikan(Request $request, $id)
    {
        PendanaanStatus::where('pendanaan_id', decrypt($id))->update(['statusPendanaan' => 'DONE']);

        return redirect()->back()->withSuccess('Bukti transfer berhasil diupload!');
    }

    public function uploadBukti(Request $request, $id)
    {
        $file = $request->file('bukti_transfer');

        $filename = time() . "." . $file->extension();
        $file->move('asset/bukti_transfer', $filename);
        $data = $request->except('_token');
        $data['buktiTransfer'] = $filename;
        Pendanaan::where('id', decrypt($id))->update(['buktiTransfer' => $filename]);

        PendanaanStatus::where('pendanaan_id', decrypt($id))->update(['statusPendanaan' => 'REVIEW']);

        return redirect()->route('pemodal.subIndexPendanaan')->withSuccess('Bukti transfer berhasil dikirim, Silahkan Tunggu Dana Anda Sedang Di Prosses oleh Admin!');
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'user_id' => ['required', 'unique:pemodal,user_id', 'exists:users,id', 'in:' . auth()->id()],
                    'namaLengkap' => ['required', 'string', 'max:255'],
                    'jenisKelamin' => ['required', 'string', 'max:255', 'in:Laki - Laki,Perempuan'],
                    "alamat"    => ['required', 'string'],
                    "tempatLahir"    => ['required', 'string', 'max:255'],
                    "tanggalLahir"    => ['required', 'date'],
                    "pekerjaan"    => ['required', 'string', 'max:255'],
                    "namaBank"    => ['required', 'string', 'max:255'],
                    "noRekening"    => ['required', 'string', 'max:255'],
                    // "fotoKtp" => "required|mimes:jpeg,jpg,bmp,png,gif,svg,pdf|max:10000"
                    "fotoKtp"   => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000']
                ]
            );

            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }
            $file = $request->file('fotoKtp');

            $filename = time() . "." . $file->extension();
            $file->move('asset/ktp', $filename);

            $data = $request->except('_token');
            $data['fotoKtp'] = $filename;
            Pemodal::create($data);

            return redirect()->back()->withSuccess('Data berhasil disimpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
    public function show($id)
    {
        $data = Pengajuan::find(decrypt($id));
        $data->profitBulanan = $data->jumlahPengajuan * $data->persentaseBagiHasil / 100;

        $dataProgress = [];
        $totalInvestor = [];

        $pengajuan = Pengajuan::whereHas('review', function ($query) {
            $query->where('statusPengajuan', 'Accept');
        })->orderBy('id', 'asc')->get();

        foreach ($pengajuan as $item) {
            $totalPendanaan = Pendanaan::where('review_id', $item->review->id)->whereHas('statusPendanaan', function ($query) {
                $query->where('statusPendanaan', '<>', 'REJECT');
            })->sum(\DB::raw('jumlahUnit * 100000'));
            $dataProgress[$item->id] = ($totalPendanaan / $item->jumlahPengajuan) * 100;
            $dataProgress[$item->terkumpul] = $totalPendanaan;
            $totalInvestor[$item->review->id] = Pendanaan::where('review_id', $item->review->id)->count();
        }
        return view("subpemodal.show", compact('data', 'totalInvestor', 'dataProgress'));
    }

    public function showpembelian($id)
    {
        $decryptedId = decrypt($id);
        $data = Pengajuan::find($decryptedId);

        $pengajuan = Pengajuan::whereHas('review', function ($query) {
            $query->where('statusPengajuan', 'Accept');
        })->orderBy('id', 'asc')->get();

        $totalUnit = [];
        foreach ($pengajuan as $item) {
            $totalPendanaan = Pendanaan::where('review_id', $item->review->id)->whereHas('statusPendanaan', function ($query) {
                $query->where('statusPendanaan', '<>', 'REJECT');
            })->sum(\DB::raw('jumlahUnit * 100000'));
            $totalUnit['totalpendanaan'] = $totalPendanaan;
        }
        $total = $pengajuan->pluck('jumlahPengajuan')->first();
        $totalPendanaan = $totalUnit['totalpendanaan'];
        $sisatotal = ($total - $totalPendanaan) / 100000;
        $reviewId = $data->review->id; // Asumsi relasi review sudah terdefinisi di model Pengajuan

        return view("subpemodal.pembelian", compact('data', 'reviewId', 'sisatotal'));
    }
    public function pendanaan(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'review_id' => ['required', 'string', 'max:255'],
                'pemodal_id' => ['required', 'string', 'max:255'],
                'namaUsaha' => ['required', 'string', 'max:255'],
                "jumlahUnit" => ['required', 'string'],
                "totalPembayaran" => ['required', 'string', 'max:255'],
            ]
        );

        if (!$validate->passes()) {
            return redirect()->back()->withErrors($validate->messages())->withInput();
        }

        $data = $request->except('_token');
        $data['totalPembayaran'] = str_replace('.', '', $data['totalPembayaran']);
        $data['buktiTransfer'] = "";

        $pendanaan = Pendanaan::create($data);

        PendanaanStatus::create([
            'pendanaan_id' => $pendanaan->id,
            'statusPendanaan' => 'PENDING',
        ]);

        return redirect()->route('pemodal.subIndexPendanaan')->withSuccess('Pembelian Success !!');
    }
}
