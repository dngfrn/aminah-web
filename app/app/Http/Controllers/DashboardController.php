<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendanaan;
use App\Models\Pengajuan;
class DashboardController extends Controller
{
    public function index()
    {
        return view("mainPage.index");
    }

    public function formulirPendanaan()
    {
        return view('mainPage.pendaftaran');
    }
    public function listUsaha(Request $request)
    {
        $search = $request->input('search');
        $search = str_replace('.', '', $search); 
        $pengajuan = Pengajuan::whereHas('review', function($query) {
            $query->where('statusPengajuan', 'Accept');
        })->when($search, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('namaUsaha', 'like', "%{$search}%") 
                      ->orWhere('jumlahPengajuan', 'like', "%{$search}%"); 
            });
        })->orderBy('id', 'asc')->get();

        $totalInvestor = Pendanaan::whereHas('review', function($query) {
            $query->where('statusPengajuan', 'Accept');
        })->select('review_id', \DB::raw('COUNT(review_id) as total'))->groupBy('review_id')->get()->keyBy('review_id');

        $dataProgress = [];
        foreach ($pengajuan as $item) {
            $totalPendanaan = Pendanaan::where('review_id', $item->review->id)->whereHas('statusPendanaan',function($query){
                $query->where('statusPendanaan','<>','REJECT');
            })->sum(\DB::raw('jumlahUnit * 100000'));
            $dataProgress[$item->id] = ($totalPendanaan / $item->jumlahPengajuan) * 100;
            $dataProgress[$item->terkumpul] = $totalPendanaan;
        }

        $pengajuan = $pengajuan->reject(function ($item) use ($dataProgress) {
            return $dataProgress[$item->id] >= 100;
        });
        return view('mainPage.listUsaha', compact('pengajuan', 'totalInvestor', 'dataProgress','search',));
        
        return redirect()->back();

    }
    public function sendFormulirPendanaan(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'noTelp' => ['required', 'numeric', 'digits_between:11,13'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
        if (!$validate->passes()) {
            return redirect()->back()->withErrors($validate->messages())->withInput();
        }
        $data = $request->except("_token");
        $data['last_name'] = "";
        $data['role'] = 'pelaku_usaha';
        $user = User::create($data);
        Auth::login($user);

        return redirect()->route('home');
    }
}
