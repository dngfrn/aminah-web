<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class PemilikUsahaController extends Controller
{
    public function showProfile(){
        $data['user'] = Auth::user();
        $data['pengajuan'] = Pengajuan::where('user_id','=',Auth::user()->id)->first();

        return view('pemilikUsaha.profile',$data);
    }

    public function updateProfile(Request $request){
        $pengajuan = Pengajuan::where('user_id','=',Auth::user()->id)->first();
        $validates = [
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
        ];
        if($pengajuan){
            $validates['companyProfile']            = ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'];
            $validates['fotoKtp']                   = ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf', 'max:10000'];
            $validates['gambarProduk']              = ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg', 'max:10000'];
            $validates['omsetTigaBulanTerakhir']    = ['nullable', 'mimes:jpeg,jpg,bmp,png,gif,svg,pdf,xls,xlsx,csv', 'max:10000'];
        }   
        $validate = Validator::make(
            $request->all(),
            $validates
        );
        if (!$validate->passes()) {
            return redirect()->back()->withErrors($validate->messages())->withInput();
        }
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        if($pengajuan){
            // Validate Folder Exists
            File::ensureDirectoryExists(public_path('asset/ktp'));
            File::ensureDirectoryExists(public_path('asset/companyProfile'));
            File::ensureDirectoryExists(public_path('asset/omsetTigaBulanTerakhir'));
            File::ensureDirectoryExists(public_path('asset/gambarProduk'));

            $files = [];
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
            $checkReview = Review::where('pengajuan_id','=',$pengajuan->id)->first();
            if($checkReview){
                $checkReview->statusPengajuan = "REVIEW";
                $checkReview->save();    
            }else{
                Review::create([
                    "pengajuan_id"=>$pengajuan->id,
                    "statusPengajuan" => "REVIEW"
                ]);
            }
        }else{
            $fileKtp = $request->file('fotoKtp');
            $filenameKtp = time() . "." . $fileKtp->extension();
            sleep(1);

            $fileGambarProduk = $request->file('gambarProduk');
            $filenameGambarProduk = time() . "." . $fileGambarProduk->extension();
            sleep(1);

            $fileOmsetTigaBulan = $request->file('omsetTigaBulanTerakhir');
            $filenameOmsetTigaBulan = time() . "." . $fileOmsetTigaBulan->extension();
            usleep(10);

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

            $data['fotoKtp'] = $filenameKtp;
            $data['companyProfile'] = $filenameCompanyProfile;
            $data['omsetTigaBulanTerakhir'] = $filenameOmsetTigaBulan;
            $data['gambarProduk'] = $filenameGambarProduk;

            $datas = Pengajuan::create($data);
            Review::create([
                "pengajuan_id"=>$datas->id,
                "statusPengajuan" => "REVIEW"
            ]);
        }

        return redirect()->back()->withSuccess('Data berhasil disimpan !');


    }

    public function receivePendanaan(Request $request){
        $pengajuan = Pengajuan::where('user_id',Auth::user()->id)->first();
        if($pengajuan){
            Review::where('pengajuan_id',$pengajuan->id)->update([
                "statusPengajuan"=>"RECEIVED"
            ]);
            return Response::json(['icon' => 'success' ,'message' => 'Success']);
        }else{
            return Response::json(['icon' => 'success' ,'message' => 'Pengajuan Not Found'],422);
        }
    }

    public function sendPendanaan(Request $request){
        $pengajuan = Pengajuan::where('user_id',Auth::user()->id)->first();
        if($pengajuan){
            Review::where('pengajuan_id',$pengajuan->id)->update([
                "statusPengajuan"=>"TRANSFERED"
            ]);
            return Response::json(['icon' => 'success' ,'message' => 'Success']);
        }else{
            return Response::json(['icon' => 'success' ,'message' => 'Pengajuan Not Found'],422);
        }
    }
}
