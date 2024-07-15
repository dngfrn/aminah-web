<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemodal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
class PemodalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pemodal::with('user');
        $perPage = $request->perPage;
        $name = $request->name;
        $pekerjaan = $request->pekerjaan;
        $noRekening = $request->noRekening;
        if(!$perPage){
            $perPage = 10;
        }

        if($name){
            $like = "%".$name."%";
            $query = $query->where('namaLengkap',"LIKE",$like);
        }
        if($pekerjaan){
            $like = "%".$pekerjaan."%";
            $query = $query->where('pekerjaan',"LIKE",$like);
        }
        if($noRekening){
            $like = "%".$noRekening."%";
            $query = $query->where('noRekening',"LIKE",$like);
        }

        $data['datas'] = $query->paginate($perPage);
        return view('pemodal.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemodal.add');
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
                    'user_id' => ['required', 'unique:pemodal,user_id','exists:users,id'],
                    'namaLengkap' => ['required', 'string', 'max:255'],
                    'jenisKelamin' => ['required', 'string', 'max:255','in:Laki - Laki,Perempuan'],
                    "alamat"    => ['required','string'],
                    "tempatLahir"    => ['required','string','max:255'],
                    "tanggalLahir"    => ['required','date'],
                    "pekerjaan"    => ['required','string','max:255'],
                    "namaBank"    => ['required','string','max:255'],
                    "noRekening"    => ['required','string','max:255'],
                    // "fotoKtp" => "required|mimes:jpeg,jpg,bmp,png,gif,svg,pdf|max:10000"
                    "fotoKtp"   => ['required','mimes:jpeg,jpg,bmp,png,gif,svg,pdf','max:10000']
                ]);
                
            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }
            $file = $request->file('fotoKtp');

            $filename = time().".".$file->extension();
            $file->move('asset/ktp', $filename);

            $data = $request->except('_token');
            $data['fotoKtp'] = $filename;
            Pemodal::create($data);

            return redirect()->back()->withSuccess('Data berhasil disimpan !');

        }catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemodal $pemodal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['datas'] = Pemodal::find($id);
        return view('pemodal.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {

            $validate = Validator::make(
                $request->all(),
                [
                    'user_id' => ['required', 'unique:pemodal,user_id,'.$id,'exists:users,id'],
                    'namaLengkap' => ['required', 'string', 'max:255'],
                    'jenisKelamin' => ['required', 'string', 'max:255','in:Laki - Laki,Perempuan'],
                    "alamat"    => ['required','string'],
                    "tempatLahir"    => ['required','string','max:255'],
                    "tanggalLahir"    => ['required','date'],
                    "pekerjaan"    => ['required','string','max:255'],
                    "namaBank"    => ['required','string','max:255'],
                    "noRekening"    => ['required','string','max:255'],
                    // "fotoKtp" => "required|mimes:jpeg,jpg,bmp,png,gif,svg,pdf|max:10000"
                    "fotoKtp"   => ['nullable','mimes:jpeg,jpg,bmp,png,gif,svg,pdf','max:10000']
                ]);
                
            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }

            $data = $request->except('_token');
            if($request->hasFile('fotoKtp')){
                $file = $request->file('fotoKtp');

                $filename = time().".".$file->extension();
                $file->move('asset/ktp', $filename);

                $data['fotoKtp'] = $filename;
            }
            
            Pemodal::find($id)->update($data);

            return redirect()->back()->withSuccess('Data berhasil diubah !');

        }catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Pemodal::find($id)->delete();
            return redirect()->back()->withSuccess('Data berhasil dihapus !');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("Hapus data gagal")->withInput();
        }
    }
}
