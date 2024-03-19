<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 
use App\Models\DataBox; 

class DataBoxController extends Controller
{
    //
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'code_boxes'        => 'required',  
            'nama_boxes'        => 'required',  
            'lokasi_boxes'      => 'required',  
        ], [
            'code_boxes.required'   => 'main code Name Harus di isi,',  
            'nama_boxes.required'   => 'arsip nama Name Harus di isi,',  
            'lokasi_boxes.required' => 'arsip nama Name Harus di isi,',  
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
        DataBox::create([
            'data_boxes_id'     => 'DataBox-' . strtotime(Carbon::now('Asia/Jakarta')),
            'code_boxes'        => $request->code_boxes,   
            'nama_boxes'        => $request->nama_boxes,   
            'lokasi_boxes'      => $request->lokasi_boxes,   
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
            $data = DataBox::orderBy('created_at', 'desc')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = DataBox::where('data_boxes_id', $request->post_data)->first();
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
            'code_boxes'        => 'required',  
            'nama_boxes'        => 'required',  
            'lokasi_boxes'      => 'required',  
        ], [
            'code_boxes.required'   => 'main code Name Harus di isi,',  
            'nama_boxes.required'   => 'arsip nama Name Harus di isi,',  
            'lokasi_boxes.required' => 'arsip nama Name Harus di isi,',  
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
            $data = DataBox::firstWhere('data_boxes_id', $request->id_conten);

            //update post 
            $data->update([
                'code_boxes'        => $request->code_boxes,   
                'nama_boxes'        => $request->nama_boxes,   
                'lokasi_boxes'      => $request->lokasi_boxes,  
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
        DataBox::where('data_boxes_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
