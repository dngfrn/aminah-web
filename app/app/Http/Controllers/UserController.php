<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = new User();
        $perPage = $request->perPage;
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;
        if(!$perPage){
            $perPage = 10;
        }

        if($name){
            $like = "%".$name."%";
            $query = $query->where('name',"LIKE",$like);
        }
        if($email){
            $like = "%".$email."%";
            $query = $query->where('email',"LIKE",$like);
        }
        if($role){
            $like = "%".$role."%";
            $query = $query->where('role',"LIKE",$like);
        }

        $data['datas'] = $query->paginate($perPage);
        return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.add');
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
                    'name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'string', 'max:255'],
                    'noTelp' => ['required', 'numeric', 'digits_between:11,13'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }
            User::create($request->all());
            return redirect()->back()->withSuccess('Data berhasil disimpan !');

        }catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,Request $request)
    {
        $data['datas'] = User::find($id);
        if($request->ajax()){
            return response()
            ->json(['status'=>200 ,'datas' => $data['datas'], 'errors' => null])
            ->withHeaders([
                'Content-Type'          => 'application/json',
            ]);
        }else{
            return view('user.edit',$data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validate = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                    'role' => ['required', 'string', 'max:255'],
                    'noTelp' => ['required', 'numeric', 'digits_between:11,13'],
                    'password' => ['nullable', 'string', 'min:8', 'required_with:password_confirmation','same:password_confirmation'],
                ]);
            if (!$validate->passes()) {
                return redirect()->back()->withErrors($validate->messages())->withInput();
            }
            $user = User::find($id);
            $user->name = $request->name;
            $user->last_name = $request->last_name  ;
            $user->email = $request->email;
            if($request->has('password')){
                $user->password = $request->password;
            }
            $user->role = $request->role;
            $user->noTelp = $request->noTelp;
            $user->save();
            return redirect()->back()->withSuccess('Data berhasil disimpan !');

        }catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::find($id)->delete();
            return redirect()->back()->withSuccess('Data berhasil Dihapus !');
        } catch (\Throwable $th) {
            return Response::json(['icon' => 'error' ,'message' => 'Hapus data gagal']);
        }
    }

    public function listUser(Request $request){
        $search = @$request->search;
        $role = @$request->role;
        $query = new User();
        if($role){
            $query = $query->where('role','=',$role);
        }
        if($search){
            $like = "%".$search."%";
            $query = $query->where(function($query) use($like){
                $query->where('name','like',$like)->orWhere('last_name','like',$like)->orWhere('email','like',$like);
            });
        }   
        $response = $query->paginate(10);
        return response()
        ->json(['status'=>200 ,'datas' => $response, 'errors' => null])
        ->withHeaders([
            'Content-Type'          => 'application/json',
        ])
        ->setStatusCode(200);
        
    }
}
