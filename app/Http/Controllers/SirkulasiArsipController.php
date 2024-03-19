<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 
use App\Models\SirkulasiArsip; 
use App\Models\DataArsip; 

class SirkulasiArsipController extends Controller
{
    //
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [ 
            'data_arsips_id'        => 'required',  
            'nama_peminjam'         => 'required',  
            'jabatan_peminjam'      => 'required',  
            'keperluan_peminjam'    => 'required',  
            'status_sirkulasi'      => 'required',  
            'jumlah_peminjaman'     => 'required',  
        ], [  
            'data_arsips_id.required'   => 'data arsips id Harus di isi,',     
            'nama_peminjam.required'   => 'nama peminjam Harus di isi,',     
            'jabatan_peminjam.required'   => 'jabatan peminjam Harus di isi,',     
            'keperluan_peminjam.required'   => 'keperluan peminjam Harus di isi,',     
            'status_sirkulasi.required'   => 'status sirkulasi Harus di isi,',    
            'jumlah_peminjaman.required'   => 'jumlah peminjaman Harus di isi,',     
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
        SirkulasiArsip::create([
            'sirkulasi_arsips_id'   => 'SirkulasiArsip-' . strtotime(Carbon::now('Asia/Jakarta')),
            'data_arsips_id'        => $request->data_arsips_id,   
            'nama_peminjam'         => $request->nama_peminjam,   
            'jabatan_peminjam'      => $request->jabatan_peminjam,   
            'keperluan_peminjam'    => $request->keperluan_peminjam,   
            'status_sirkulasi'      => $request->status_sirkulasi,   
            'sirkulasi_kembali'     => $request->sirkulasi_kembali,   
            'jumlah_peminjaman'     => $request->jumlah_peminjaman,   
        ]);

        
        $data = DataArsip::firstWhere('data_arsips_id', $request->data_arsips_id);
        $data->update([     
            'stok_arsip'              => (int)$data->stok_arsip - (int)$request->jumlah_peminjaman,      
        ]);

        return response()->json([
            'success'   => true,
            'code'      => 200,
            'message'   => 'Data Berhasil Disimpan!',
            'data'      => $data,

        ]);
    }

    public function show(Request $request, $modeluser)
    {
        //
        if ($modeluser == "view") {

            if ( $request->post_data =="AllData") { 
                $data = SirkulasiArsip::orderBy('created_at', 'desc')->get(); 
                return response()->json($data);
            }else { 
                $data = SirkulasiArsip::where('data_arsips_id', $request->post_data)->orderBy('created_at', 'desc')->get(); 
                return response()->json($data);
            }
            
        } else if ($modeluser == "src") {
            // for form data
            $data = SirkulasiArsip::join('data_arsips', 'data_arsips.data_arsips_id', '=', 'sirkulasi_arsips.data_arsips_id')
                                    ->where('sirkulasi_arsips_id', $request->post_data)->first();
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

        if($request->status == "Kembali"){
            $data = SirkulasiArsip::firstWhere('sirkulasi_arsips_id', $request->id_conten);

            //update post 
            $data->update([
                'sirkulasi_kembali'     => Carbon::now('Asia/Jakarta'),  
                'status_sirkulasi'      => "Kembali",  
            ]);

             
            $dataarsip = DataArsip::firstWhere('data_arsips_id', $data->data_arsips_id);
            $dataarsip->update([     
                'stok_arsip'              => (int)$data->jumlah_peminjaman + (int)$dataarsip->stok_arsip,      
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',

            ]);
            
        }elseif($request->status == "Hilang"){
            $data = SirkulasiArsip::firstWhere('sirkulasi_arsips_id', $request->id_conten);

            //update post 
            $data->update([
                'sirkulasi_kembali'     => Carbon::now('Asia/Jakarta'),  
                'status_sirkulasi'      => "Hilang",  
            ]); 

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',

            ]);
        }else{ 
            //define validation rules
            $validator = Validator::make($request->all(), [
                'id_conten'         => 'required',  
                'data_arsips_id'        => 'required',  
                'nama_peminjam'         => 'required',  
                'jabatan_peminjam'      => 'required',  
                'keperluan_peminjam'    => 'required',  
                'status_sirkulasi'      => 'required',  
                
                'jumlah_peminjaman'     => 'required',  
            ], [
                'id_conten.required'    => 'Code Name Harus di isi,',  
                'data_arsips_id.required'   => 'data arsips id Harus di isi,',     
                'nama_peminjam.required'   => 'nama peminjam Harus di isi,',     
                'jabatan_peminjam.required'   => 'jabatan peminjam Harus di isi,',     
                'keperluan_peminjam.required'   => 'keperluan peminjam Harus di isi,',     
                'status_sirkulasi.required'   => 'status sirkulasi Harus di isi,',     
                    
                'jumlah_peminjaman.required'   => 'jumlah peminjaman Harus di isi,',
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
                $data = SirkulasiArsip::firstWhere('sirkulasi_arsips_id', $request->id_conten);

                //update post 
                $data->update([
                    'data_arsips_id'        => $request->data_arsips_id,   
                    'nama_peminjam'         => $request->nama_peminjam,   
                    'jabatan_peminjam'      => $request->jabatan_peminjam,   
                    'keperluan_peminjam'    => $request->keperluan_peminjam,   
                    'status_sirkulasi'      => $request->status_sirkulasi,   
                    'sirkulasi_kembali'     => $request->sirkulasi_kembali,   
                    'jumlah_peminjaman'     => $request->jumlah_peminjaman,  
                ]);

                $rubah = (int)$request->jumlah_peminjaman_sebelum - (int)$request->jumlah_peminjaman;
                if ($rubah != 0 ) {
                    $data = DataArsip::firstWhere('data_arsips_id', $request->data_arsips_id);
                    $data->update([     
                        'stok_arsip'              => (int)$data->jumlah_arsip + (int)$rubah,      
                    ]);
                }
                

                return response()->json([
                    'success'   => true,
                    'code'      => 200,
                    'message'   => 'Data Berhasil Disimpan!',

                ]);
            }
        }
    }
 
    public function destroy(Request $request)
    {
        //
        SirkulasiArsip::where('sirkulasi_arsips_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
