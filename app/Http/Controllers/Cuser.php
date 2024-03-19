<?php

namespace App\Http\Controllers;

use App\Models\Modeluser;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class Cuser extends Controller
{
    public function loginas(Request $request, $token)
    {
        $data = Modeluser::firstWhere('remember_token', $token);
        if ($data->status == "Aktiv") { 
            if (Auth::attempt( ['user_name' => $data->user_name, 'password' => $data->apassword ]))  {
                $request->session()->regenerate();

                LoginLog::create([
                    'id_users'    => Auth::user()->user_id,
                ]);

                return Redirect::to('/');
            } else {
                return response()->json([
                    'success' => false,
                    'code'      => 401,
                    'message' => 'Login Gagal!'
                ]);
            }
        }else {
            return Redirect::to('/login');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            LoginLog::create([
                'id_users'    => Auth::user()->user_id,
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Berhasil Ditemukan!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'code'      => 401,
                'message' => 'Login Gagal!'
            ]);
        }
    }

    public function resetpwd(Request $request)
    {
        //mencari data berdasarkan key
        $data = Modeluser::firstWhere('user_id', $request->post_data); 

        if ($data->apassword == $request->odpw) {
            $data->update([
                'apassword'     => $request->newpw,
                'password'      => Hash::make($request->newpw)
            ]);

            //return response
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',
                'data'      => $data,
            ]);
        } else {

            //return response
            return response()->json([
                'success'   => true,
                'code'      => 400,
                'message'   => 'Password Lama Tidak Sesuai!',
                'data'      => $request->post_data,
            ]);
        } 
         
    }

    public function fild(Request $request)
    {
        //mencari data berdasarkan key
        $data = Modeluser::firstWhere('user_id', $request->post_data); 

        if ($request->hasFile('file_profil')) { 
            if (File::exists(public_path($data->file_profile))) {
                File::delete(public_path($data->file_profile));
            }
            // Nama unik untuk gambar
            $imageName = time() . '.' . $request->file_profil->extension();

            $request->file_profil->move(public_path('user_profil'), $imageName);
            // // File path
            $filepath =  'user_profil/' . $imageName;

            $data->update([
                'user_name'         => $request->user_name,
                'phone'             => $request->phone,
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'file_profile'      => $filepath,
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',
                'data'      => $data,
            ]);
        } else {
            $data->update([
                'user_name'         => $request->user_name,
                'phone'             => $request->phone,
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
            ]);

            //return response
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',
                'data'      => $data,
            ]);
        }
         
    }

    public function getfild(Request $request)
    {
        // for form data
        $data = Modeluser::where('user_id', $request->post_data)->first();
        // return data
        return response()->json([
            'success'   => true,
            'code'      => 200,
            'data'      => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'user_name'     => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'password'      => 'required',
            'level'         => 'required',
            'status'        => 'required',
        ], [
            'user_name.required'    => 'User Name Harus di isi,',
            'first_name.required'   => 'First Name Harus di isi,',
            'last_name.required'    => 'Last Name Harus di isi,',
            'password.required'     => 'password Harus di isi,',
            'level.required'        => 'level Harus di isi,',
            'status.required'       => 'status Harus di isi,',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'code'      => 422,
                'message'   => "Data Tidak Sesuai",
                'data'      => $validator->errors(),
            ]);
        }

        //create post 
        Modeluser::create([
            'user_id'           => 'user-' . strtotime(Carbon::now('Asia/Jakarta')),
            'user_name'         => $request->user_name,
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'apassword'         => $request->password,
            'level'             => $request->level,
            'status'            => $request->status,
            'remember_token'    => md5(strtotime(Carbon::now('Asia/Jakarta'))),
            'password'          => Hash::make($request->password)
        ]);

        return response()->json([
            'success'   => true,
            'code'      => 200,
            'message'   => 'Data Berhasil Disimpan!',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $modeluser)
    {
        //
        if ($modeluser == "view") {
            // for data table
            $data = Modeluser::orderBy('created_at', 'desc')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = Modeluser::where('user_id', $request->post_data)->first();
            // return data
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'data'      => $data,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_conten'     => 'required',
            'user_name'     => 'required',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'password'      => 'required',
            'level'         => 'required',
            'status'        => 'required',
        ], [
            'id_conten.required'    => 'id tidak terbaca,',
            'user_name.required'    => 'User Name Harus di isi,',
            'first_name.required'   => 'First Name Harus di isi,',
            'last_name.required'    => 'Last Name Harus di isi,',
            'password.required'     => 'password Harus di isi,',
            'level.required'        => 'level Harus di isi,',
            'status.required'       => 'status Harus di isi,',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'code'      => 422,
                'message'   => "Data Tidak Sesuai",
                'data'      => $validator->errors(),
            ]);
        }else {
           
            //mencari data berdasarkan key
            $data = Modeluser::firstWhere('user_id', $request->id_conten);

            //update post 
            $data->update([
                'user_name'     => $request->user_name,
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'apassword'     => $request->password,
                'level'         => $request->level,
                'status'        => $request->status,
                'password'      => Hash::make($request->password)
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Modeluser::where('user_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
