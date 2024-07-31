<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\File;

use App\Notifications\pengajuanAcceptNotification;
use App\Notifications\pengajuanRejectNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with('user','review','review.pendanaan','review.pendanaan.statusPendanaan');
        $perPage = $request->perPage;
        $namaUsaha = $request->namaUsaha;
        $namaPemilik = $request->namaPemilik;
        $kategoriUsaha = $request->kategoriUsaha;
        $status = $request->status;
        $nik = $request->nik;
        if (!$perPage) {
            $perPage = 10;
        }
      
        if ($nik) {
            $like = "%" . $nik . "%";
            $query = $query->where('nik', "LIKE", $like);
        }
        if ($namaPemilik) {
            $like = "%" . $namaPemilik . "%";
            $query = $query->where('namaPemilik', "LIKE", $like);
        }
        if ($namaUsaha) {
            $like = "%" . $namaUsaha . "%";
            $query = $query->where('namaUsaha', "LIKE", $like);
        }

        if ($kategoriUsaha) {
            $like = "%" . $kategoriUsaha . "%";
            $query = $query->where('kategoriUsaha', "LIKE", $like);
        }
        if($status){
            $params = strtoupper($status);
            $query = $query->whereHas('review',function($query) use($params){
                return $query->where('statusPengajuan',$params);
            });
        }
        $data['datas'] = $query->paginate($perPage);
        return view('pengajuan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengajuan.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validate = Validator::make(
                $request->all(),
                [
                    'user_id'                => ['required', 'unique:pengajuan,user_id', 'exists:users,id'],
                    'namaUsaha'              => ['required', 'string', 'max:255'],
                    'namaPemilik'            => ['required', 'string', 'max:255'],
                    "alamatUsaha"            => ['required', 'string'],
                    "nik"                    => ['required', 'numeric'],
                    'kategoriUsaha'          => ['required', 'string', 'max:255'],
                    "alamat"                 => ['required', 'string'],
                    "deskripsiUsaha"         => ['required', 'string'],
                    "omsetPerBulan"          => ['required', 'numeric'],
                    "rencanaPengajuan"       => ['required', 'string'],
                    "jumlahPengajuan"        => ['required', 'numeric'],
                    "persentaseBagiHasil"    => ['required', 'numeric'],
                    "periodeBagiHasil"       => ['required', 'numeric', 'max:100'],
                    "companyProfile"         => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'],
                    "fotoKtp"                => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'],
                    "gambarProduk"           => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg', 'max:10000'],
                    "omsetTigaBulanTerakhir" => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf,xls,xlsx,csv', 'max:10000']
                ]
            );

            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }

            $fileKtp = $request->file('fotoKtp');
            $filenameKtp = time() . "." . $fileKtp->extension();
            sleep(1);

            $fileGambarProduk = $request->file('gambarProduk');
            $filenameGambarProduk = time() . "." . $fileGambarProduk->extension();
            sleep(1);

            $fileOmsetTigaBulan = $request->file('omsetTigaBulanTerakhir');
            $filenameOmsetTigaBulan = time() . "." . $fileOmsetTigaBulan->extension();
            sleep(1);

            $fileCompanyProfile = $request->file('companyProfile');
            $filenameCompanyProfile = time() . "." . $fileCompanyProfile->extension();

            // Validate Folder Exists
            File::ensureDirectoryExists(public_path('asset/ktp'));
            File::ensureDirectoryExists(public_path('asset/companyProfile'));
            File::ensureDirectoryExists(public_path('asset/omsetTigaBulanTerakhir'));
            File::ensureDirectoryExists(public_path('asset/gambarProduk'));


            $fileKtp->move(public_path('asset/ktp'), $filenameKtp);
            $fileCompanyProfile->move(public_path('asset/companyProfile'), $filenameCompanyProfile);
            $fileOmsetTigaBulan->move(public_path('asset/omsetTigaBulanTerakhir'), $filenameOmsetTigaBulan);
            $fileGambarProduk->move(public_path('asset/gambarProduk'), $filenameGambarProduk);

            $data = $request->except('_token');
            $data['fotoKtp'] = $filenameKtp;
            $data['companyProfile'] = $filenameCompanyProfile;
            $data['omsetTigaBulanTerakhir'] = $filenameOmsetTigaBulan;
            $data['gambarProduk'] = $filenameGambarProduk;
            Pengajuan::create($data);

            return redirect()->back()->withSuccess('Data berhasil disimpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        $data['datas'] = $pengajuan;
        return view('pengajuan.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        $data['datas'] = $pengajuan;
        return view('pengajuan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        try {

            $validate = Validator::make(
                $request->all(),
                [
                    // 'user_id'                => ['required', 'unique:pengajuan,user_id', 'exists:users,id'],
                    'namaUsaha'              => ['required', 'string', 'max:255'],
                    'namaPemilik'            => ['required', 'string', 'max:255'],
                    "alamatUsaha"            => ['required', 'string'],
                    "nik"                    => ['required', 'numeric'],
                    'kategoriUsaha'          => ['required', 'string', 'max:255'],
                    "alamat"                 => ['required', 'string'],
                    "deskripsiUsaha"         => ['required', 'string'],
                    "omsetPerBulan"          => ['required', 'numeric'],
                    "rencanaPengajuan"       => ['required', 'string'],
                    "jumlahPengajuan"        => ['required', 'numeric'],
                    "persentaseBagiHasil"    => ['required', 'numeric'],
                    "periodeBagiHasil"       => ['required', 'numeric', 'max:100'],
                    "companyProfile"         => ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'],
                    "fotoKtp"                => ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'],
                    "gambarProduk"           => ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'],
                    "omsetTigaBulanTerakhir" => ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf,xls,xlsx,csv', 'max:10000']
                ]
            );

            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }
            // Validate Folder Exists
            File::ensureDirectoryExists(public_path('asset/ktp'));
            File::ensureDirectoryExists(public_path('asset/companyProfile'));
            File::ensureDirectoryExists(public_path('asset/omsetTigaBulanTerakhir'));
            File::ensureDirectoryExists(public_path('asset/gambarProduk'));

            $data = $request->except('_token');
            $files = [];
            // if($request->hasFile('fotoKtp')){
            //     $fileKtp = $request->file('fotoKtp');
            //     $filenameKtp = time() . "." . $fileKtp->extension();
            //     $fileKtp->move('asset/ktp', $filenameKtp);
            //     $data['fotoKtp'] = $filenameKtp;

            //     if(File::exists(public_path('asset/ktp/'.$pengajuan->fotoKtp))){
            //         $files[] = public_path('asset/ktp/'.$pengajuan->fotoKtp);
            //     }
            // }
            // if($request->hasFile('gambarProduk')){
            //     $fileGambarProduk = $request->file('gambarProduk');
            //     $filenameGambarProduk = time() . "." . $fileGambarProduk->extension();
            //     $fileGambarProduk->move('asset/gambarProduk', $filenameGambarProduk);
            //     $data['gambarProduk'] = $filenameGambarProduk;

            //     if(File::exists(public_path('asset/gambarProduk/'.$pengajuan->gambarProduk))){
            //         $files[] = public_path('asset/gambarProduk/'.$pengajuan->gambarProduk);
            //     }
            // }

            // if($request->hasFile('omsetTigaBulanTerakhir')){
            //     $fileOmsetTigaBulan = $request->file('omsetTigaBulanTerakhir');
            //     $filenameOmsetTigaBulan = time() . "." . $fileOmsetTigaBulan->extension();
            //     $fileOmsetTigaBulan->move('asset/omsetTigaBulanTerakhir', $filenameOmsetTigaBulan);
            //     $data['omsetTigaBulanTerakhir'] = $filenameOmsetTigaBulan;

            //     if(File::exists(public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir))){
            //         $files[] = public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir);
            //     }
            // }

            // if($request->hasFile('companyProfile')){
            //     $fileCompanyProfile = $request->file('companyProfile');
            //     $filenameCompanyProfile = time() . "." . $fileCompanyProfile->extension();
            //     $fileCompanyProfile->move('asset/companyProfile', $filenameCompanyProfile);
            //     $data['companyProfile'] = $filenameCompanyProfile;

            //     if(File::exists(public_path('asset/companyProfile/'.$pengajuan->companyProfile))){
            //         $files[] = public_path('asset/companyProfile/'.$pengajuan->companyProfile);
            //     }
            // }
            
            if($request->hasFile('fotoKtp')){
                $fileKtp = $request->file('fotoKtp');
                $filenameKtp = time() . "." . $fileKtp->extension();
                $fileKtp->move(public_path('asset/ktp'), $filenameKtp);
                $data['fotoKtp'] = $filenameKtp;

                if(File::exists(public_path('asset/ktp/'.$pengajuan->fotoKtp))){
                    $files[] = public_path('asset/ktp/'.$pengajuan->fotoKtp);
                }
            }
            if($request->hasFile('gambarProduk')){
                $fileGambarProduk = $request->file('gambarProduk');
                $filenameGambarProduk = time() . "." . $fileGambarProduk->extension();
                $fileGambarProduk->move(public_path('asset/gambarProduk'), $filenameGambarProduk);
                $data['gambarProduk'] = $filenameGambarProduk;

                if(File::exists(public_path('asset/gambarProduk/'.$pengajuan->gambarProduk))){
                    $files[] = public_path('asset/gambarProduk/'.$pengajuan->gambarProduk);
                }
            }

            if($request->hasFile('omsetTigaBulanTerakhir')){
                $fileOmsetTigaBulan = $request->file('omsetTigaBulanTerakhir');
                $filenameOmsetTigaBulan = time() . "." . $fileOmsetTigaBulan->extension();
                $fileOmsetTigaBulan->move(public_path('asset/omsetTigaBulanTerakhir'), $filenameOmsetTigaBulan);
                $data['omsetTigaBulanTerakhir'] = $filenameOmsetTigaBulan;

                if(File::exists(public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir))){
                    $files[] = public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir);
                }
            }

            if($request->hasFile('companyProfile')){
                $fileCompanyProfile = $request->file('companyProfile');
                $filenameCompanyProfile = time() . "." . $fileCompanyProfile->extension();
                $fileCompanyProfile->move(public_path('asset/companyProfile'), $filenameCompanyProfile);
                $data['companyProfile'] = $filenameCompanyProfile;

                if(File::exists(public_path('asset/companyProfile/'.$pengajuan->companyProfile))){
                    $files[] = public_path('asset/companyProfile/'.$pengajuan->companyProfile);
                }
            }
            if(count($files) > 0){
                File::delete($files);
            }

            Pengajuan::find($pengajuan->id)->update($data);
            return redirect()->back()->withSuccess('Data berhasil disimpan !');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        $files = [];
        if(File::exists(public_path('asset/gambarProduk/'.$pengajuan->gambarProduk))){
            $files[] = public_path('asset/gambarProduk/'.$pengajuan->gambarProduk);
        }
        if(File::exists(public_path('asset/companyProfile/'.$pengajuan->companyProfile))){
            $files[] = public_path('asset/companyProfile/'.$pengajuan->companyProfile);
        }
        if(File::exists(public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir))){
            $files[] = public_path('asset/omsetTigaBulanTerakhir/'.$pengajuan->omsetTigaBulanTerakhir);
        }
        if(File::exists(public_path('asset/ktp/'.$pengajuan->fotoKtp))){
            $files[] = public_path('asset/ktp/'.$pengajuan->fotoKtp);
        }
        if(count($files) > 0){
            File::delete($files);
        }

        $pengajuan->delete();
        return Response::json(['icon' => 'success' ,'message' => 'Hapus data berhasil']);

    }

    public function approvePengajuan(Request $request,$id){
        $pengajuan = Pengajuan::findOrFail($id);
        if($pengajuan){
            Review::where('pengajuan_id',$id)->update([
                "statusPengajuan"=>strtoupper($request->status)
            ]);

            if($request->status == 'accept'){
                Notification::route('mail', $pengajuan->user->email)->notify(new pengajuanAcceptNotification());
            }else{
                Notification::route('mail', $pengajuan->user->email)->notify(new pengajuanRejectNotification());
            }
        }
        return Response::json(['icon' => 'success' ,'message' => 'Success']);

    }
}
