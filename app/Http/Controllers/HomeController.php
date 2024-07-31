<?php

namespace App\Http\Controllers;

use App\Models\Pendanaan;
use App\Models\Pemodal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Pengajuan;
use App\Notifications\pengajuanAcceptNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'pelaku_usaha') {
                $check = Pengajuan::where('user_id', '=', Auth::user()->id)->first();
                if (!$check) {
                    return redirect()->route('pemilikUsaha.profile')->withErrors('Lengkapi Profile Usaha Terlebih Dahulu');
                } else {
                    $pengajuan = Pengajuan::with('review')->where('user_id', '=', Auth::user()->id)->first();
                    $data['totalPengajuan'] = $pengajuan->jumlahPengajuan;
                    $dataSummary = Pendanaan::whereHas('review', function ($query) use ($pengajuan) {
                        $query->whereNotIn('statusPengajuan', ['REJECT', 'REVIEW'])->where('pengajuan_id', $pengajuan->id);
                    })->select(\DB::raw('SUM(totalPembayaran) as total'), \DB::raw('COUNT(*) as total_investor'))->whereHas('statusPendanaan', function ($query) {
                        $query->whereNotIn('statusPendanaan', ['REJECT', 'PENDING']);
                    })->groupBy('review_id')->first();
                    $data['investorDetail'] = $dataSummary;
                    $data['status'] = $pengajuan->review->statusPengajuan;
                    // $data['totalDanaTerkumpul'] = Pendanaan::with('statusPendanaan')->where(['review_id'=>$pengajuan->review->id])->whereHas('statusPendanaan',function($query){ $query->whereNotIn('statusPendanaan',['REJECT','PENDING']); })->sum('totalPembayaran');
                    // $data['totalInvestor'] = Pendanaan::where()
                    return view('pemilikUsaha.home', $data);
                }
            }
            if (Auth::user()->role == 'pemodal') {
                $check = pemodal::where('user_id', '=', Auth::user()->id)->first();
                if (!$check) {
                    return view('subpemodal.add')->withErrors('Lengkapi Profile Terlebih Dahulu');
                } else {
                    $pendanaan = Pendanaan::where('pemodal_id', Auth::user()->id)->get();
                    $data['totalPembayaran'] = $pendanaan->sum('totalPembayaran') - ($pendanaan->count() * 100000);
                    $data['totalPembayaranAccept'] = ($totalPembayaranAccept = Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'ACCEPT');
                    })->sum('totalPembayaran')) > 100000 ? $totalPembayaranAccept - (Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'ACCEPT');
                    })->count() > 1 ? Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'ACCEPT');
                    })->count() * 100000 : 100000) : ($totalPembayaranAccept == 100000 ? $totalPembayaranAccept : $totalPembayaranAccept);
                    $data['totalPembayaranPending'] = ($totalPembayaranPending = Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'REVIEW');
                    })->sum('totalPembayaran')) > 100000 ? $totalPembayaranPending - (Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'REVIEW');
                    })->count() > 1 ? Pendanaan::where('pemodal_id', Auth::user()->id)->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'REVIEW');
                    })->count() * 100000 : 100000) : ($totalPembayaranPending == 100000 ? $totalPembayaranPending : $totalPembayaranPending);
                    $data['totalInvest'] = Pendanaan::where('pemodal_id', auth()->id())->whereHas('review', function ($query) {
                        $query->where('statusPengajuan', 'ACCEPT');
                    })->count();
                    $data['totalPendingPendanaan'] = Pendanaan::where('pemodal_id', auth()->id())->whereHas('statusPendanaan', function ($query) {
                        $query->where('statusPendanaan', 'PENDING');
                    })->count();

                    return view('subpemodal.home', $data);
                }
            }
            $users = User::count();

            $widget = [
                'users' => $users,
                //...
            ];

            return view('home', compact('widget'));
        } else {
            $query = Review::with('pengajuan')->where(['statusPengajuan' => 'ACCEPT']);
            $data['pengajuan'] = $query->paginate(10);
            return view('daftarUsaha', $data);
        }
    }

    public function sendMail()
    {
        $url = route('login');
        // return (new MailMessage)
        // ->greeting('Hello!')
        // ->line('Pengajuan Usaha Kamu Telah Disetujui!')
        // ->action('Login',$url)
        // ->line('Thank you for using our application!');
        try {
            Notification::route('mail', 'rifkialfarizshidiq.1@gmail.com')->notify(new pengajuanAcceptNotification());
        } catch (\Exception $e) {
            return "ERROR";
        }
    }
}
