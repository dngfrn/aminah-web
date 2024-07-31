<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pendanaan;
use App\Models\Review;
use App\Models\PendanaanStatus;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showKeuanganPelakuUsaha(Request $request)
    {

        $query = Pengajuan::with('user', 'review', 'review.pendanaan', 'review.pendanaan.statusPendanaan');
        $perPage = $request->perPage;
        $namaUsaha = $request->namaUsaha;
        $status = $request->status;
        if (!$perPage) {
            $perPage = 10;
        }

        if ($namaUsaha) {
            $like = "%" . $namaUsaha . "%";
            $query = $query->where('namaUsaha', "LIKE", $like);
        }

        if ($status) {
            $params = strtoupper($status);
            $query = $query->whereHas('review', function ($query) use ($params) {
                return $query->where('statusPengajuan', $params);
            });
        }

        $query = $query->whereHas('review', function ($query) {
            return $query->whereNot('statusPengajuan', 'REJECT');
        });

        $totalPembayaran = Pendanaan::whereHas('review', function ($query) {
            $query->whereNotIn('statusPengajuan', ['REJECT', 'REVIEW', 'CANCELED']);
        })->select('review_id', \DB::raw('SUM(totalPembayaran) as total'), \DB::raw('COUNT(*) as total_investor'))->whereHas('statusPendanaan', function ($query) {
            $query->whereNotIn('statusPendanaan', ['REJECT', 'PENDING']);
        })->groupBy('review_id')->get()->keyBy('review_id');
        $data['datas'] = $query->paginate($perPage);
        $data['pembayaran'] = $totalPembayaran;

        return view('admin.keuanganPelakuUsaha', $data);
    }

    public function updateTransferedPelakuUsaha(Request $request, $id)
    {
        $data = Pengajuan::findOrFail($id);
        if ($data) {
            Review::where('pengajuan_id', $id)->update([
                "statusPengajuan" => "TRANSFER_USER"
            ]);
            return Response::json(['icon' => 'success', 'message' => 'Success']);
        } else {
            return Response::json(['icon' => 'success', 'message' => 'Pengajuan Not Found'], 422);
        }
    }
    public function updateDonePelakuUsaha(Request $request, $id)
    {
        $data = Pengajuan::findOrFail($id);
        if ($data) {
            Review::where('pengajuan_id', $id)->update([
                "statusPengajuan" => "DONE"
            ]);
            return Response::json(['icon' => 'success', 'message' => 'Success']);
        } else {
            return Response::json(['icon' => 'success', 'message' => 'Pengajuan Not Found'], 422);
        }
    }

    public function showKeuanganPemodal(Request $request)
    {
        $query = Pendanaan::with('pemodal', 'pemodal.user', 'statusPendanaan', 'review.pengajuan');
        $perPage = $request->perPage;
        $namaUsaha = $request->namaUsaha;
        $status = $request->status;
        if (!$perPage) {
            $perPage = 10;
        }

        if ($namaUsaha) {
            $like = "%" . $namaUsaha . "%";
            $query = $query->where('namaUsaha', "LIKE", $like);
        }

        if ($status) {
            $params = strtoupper($status);
            $query = $query->whereHas('review', function ($query) use ($params) {
                return $query->where('statusPengajuan', $params);
            });
        }

        $query = $query->whereHas('review', function ($query) {
            return $query->whereNot('statusPengajuan', 'REJECT');
        });
        // $totalPembayaran = Pendanaan::whereHas('review', function($query) {
        //     $query->whereNotIn('statusPengajuan',['REJECT','REVIEW','CANCELED']);
        // })->select('review_id', \DB::raw('SUM(totalPembayaran) as total'),\DB::raw('COUNT(*) as total_investor'))->whereHas('statusPendanaan',function($query){ $query->whereNotIn('statusPendanaan',['REJECT','PENDING']); })->groupBy('review_id')->get()->keyBy('review_id');
        $data['datas'] = $query->paginate($perPage);
        // $data['pembayaran'] = $totalPembayaran;
        // return $data;
        return view('admin.keuanganPemodal', $data);
    }

    public function acceptPemodalTransfer($id)
    {
        $data = Pendanaan::findOrFail($id);
        if ($data) {
            $review = Review::with('pengajuan')->where(['id' => $data->review_id])->first();
            $totalPendanaan = Pendanaan::whereHas('statusPendanaan', function ($query) {
                $query->where('statusPendanaan', 'ACCEPT');
            })->where('review_id', $review->id)->sum('totalPembayaran');
            $countPendanaan = Pendanaan::whereHas('statusPendanaan', function ($query) {
                $query->where('statusPendanaan', 'ACCEPT');
            })->where('review_id', $review->id)->count();
            $kurang = $review->pengajuan->jumlahPengajuan - ($totalPendanaan - ($countPendanaan * 100000));
            // echo $review->pengajuan->jumlahPengajuan."\n";
            // echo $totalPendanaan."\n";
            // echo $countPendanaan."\n";
            // return $kurang;
            $dibayar = $data->totalPembayaran - 100000;
            if ($kurang > $dibayar) {
                PendanaanStatus::where('pendanaan_id', $id)->update([
                    "statusPendanaan" => "ACCEPT"
                ]);
                return Response::json(['icon' => 'success', 'message' => 'Success']);
            } else {

                if ($kurang == $dibayar) {
                    $review->statusPengajuan = "FULFILL";
                    $review->save();

                    PendanaanStatus::where('pendanaan_id', $id)->update([
                        "statusPendanaan" => "ACCEPT"
                    ]);

                    $arr = Pendanaan::whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'REVIEW');
                    })->where('review_id', $review->id)->pluck('id')->toArray();

                    if (count($arr) > 0) {
                        PendanaanStatus::whereIn('pendanaan_id', $arr)->delete();
                        Pendanaan::whereIn('id', $arr)->delete();
                    }


                    return Response::json(['icon' => 'success', 'message' => 'Success']);
                } else {
                    PendanaanStatus::where('pendanaan_id', $id)->update([
                        "statusPendanaan" => "REJECT"
                    ]);
                    return Response::json(['icon' => 'success', 'message' => 'Invalid Total Pembayaran'], 422);
                }
            }
        } else {
            return Response::json(['icon' => 'success', 'message' => 'Pengajuan Not Found'], 422);
        }
    }
    public function rejectPemodalTransfer($id)
    {
        $data = Pendanaan::findOrFail($id);
        if ($data) {
            PendanaanStatus::where('pendanaan_id', $id)->update([
                "statusPendanaan" => "REJECT"
            ]);
            return Response::json(['icon' => 'success', 'message' => 'Success']);
        } else {
            return Response::json(['icon' => 'success', 'message' => 'Pengajuan Not Found'], 422);
        }
    }
    public function PemodalTransfered($id)
    {
        $data = Pendanaan::findOrFail($id);
        if ($data) {
            PendanaanStatus::where('pendanaan_id', $id)->update([
                "statusPendanaan" => "TRANSFERED"
            ]);
            return Response::json(['icon' => 'success', 'message' => 'Success']);
        } else {
            return Response::json(['icon' => 'success', 'message' => 'Pengajuan Not Found'], 422);
        }
    }
}
