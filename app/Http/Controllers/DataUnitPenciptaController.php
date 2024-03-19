<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 
use App\Models\DataUnitPencipta ; 

class DataUnitPenciptaController extends Controller
{
    //
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_data_unit_penciptas'         => 'required',  
            'pencipta_arsips_id'        => 'required',  
        ], [
            'nama_data_unit_penciptas.required'        => 'main code Name Harus di isi,',  
            'pencipta_arsips_id.required'       => 'arsip nama Name Harus di isi,',  
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
        DataUnitPencipta::create([
            'data_unit_penciptas_id'    => 'DataUnitPencipta-' . strtotime(Carbon::now('Asia/Jakarta')),
            'nama_data_unit_penciptas'  => $request->nama_data_unit_penciptas,  
            'pencipta_arsips_id'        => $request->pencipta_arsips_id,  
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
            $data = DataUnitPencipta::where('pencipta_arsips_id', $request->post_data)->orderBy('created_at', 'desc')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = DataUnitPencipta::where('data_unit_penciptas_id', $request->post_data)->first();
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
            'nama_data_unit_penciptas'  => 'required',  
            'pencipta_arsips_id'        => 'required',  
        ], [
            'nama_data_unit_penciptas.required'     => 'nama_data_unit_penciptas Harus di isi,',  
            'pencipta_arsips_id.required'           => 'pencipta_arsips_id Harus di isi,',  
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
            $data = DataUnitPencipta::firstWhere('data_unit_penciptas_id', $request->id_conten);

            //update post 
            $data->update([ 
                'nama_data_unit_penciptas'  => $request->nama_data_unit_penciptas,  
                'pencipta_arsips_id'        => $request->pencipta_arsips_id,   
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
        DataUnitPencipta::where('data_unit_penciptas_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
