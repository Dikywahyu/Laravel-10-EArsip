<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 
use App\Models\PenciptaArsip; 

class PenciptaArsipController extends Controller
{
    //
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_pencipta_arsips'         => 'required',   
        ], [
            'nama_pencipta_arsips.required'        => 'Name Harus di isi,',   
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
        PenciptaArsip::create([
            'pencipta_arsips_id'    => 'PenciptaArsip-' . strtotime(Carbon::now('Asia/Jakarta')),
            'nama_pencipta_arsips'  => $request->nama_pencipta_arsips,  
        ]);

        return response()->json([
            'success'   => true,
            'code'      => 200,
            'message'   => 'Data Berhasil Disimpan!',

        ]);
    }

    public function show(Request $request, $modeluser)
    {
        //
        if ($modeluser == "view") {
            // for data table
            $data = PenciptaArsip::orderBy('created_at', 'desc')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = PenciptaArsip::where('pencipta_arsips_id', $request->post_data)->first();
            // return data
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'data'      => $data,
            ]);
        }
    }

    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_pencipta_arsips'         => 'required',    
        ], [
            'nama_pencipta_arsips.required'        => 'Name Harus di isi,',   
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
            $data = PenciptaArsip::firstWhere('pencipta_arsips_id', $request->id_conten);

            //update post 
            $data->update([
                'nama_pencipta_arsips'  => $request->nama_pencipta_arsips,   
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',

            ]);
        }
    }
 
    public function destroy(Request $request)
    {
        //
        PenciptaArsip::where('pencipta_arsips_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
