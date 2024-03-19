<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\DataArsip;
use Illuminate\Support\Facades\File;

class DataArsipController extends Controller
{
    //
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nomor_arsip'               => 'required',
            'tgl_arsip'                 => 'required',
            'pencipta_arsips_id'        => 'required',
            'data_unit_penciptas_id'    => 'required',
            'klasifiakasi_arsips_id'    => 'required',
            'data_boxes_id'             => 'required',
            'jumlah_arsip'              => 'required',
            'level'                     => 'required',
        ], [
            'nomor_arsip.required'              => 'nomor_arsip Harus di isi,',
            'tgl_arsip.required'                => 'tgl_arsip Harus di isi,',
            'pencipta_arsips_id.required'       => 'pencipta_arsips_id Harus di isi,',
            'data_unit_penciptas_id.required'   => 'data_unit_penciptas_id Harus di isi,',
            'klasifiakasi_arsips_id.required'   => 'klasifiakasi_arsips_id Harus di isi,',
            'data_boxes_id.required'            => 'data_boxes_id Harus di isi,',
            'jumlah_arsip.required'             => 'jumlah_arsip Harus di isi,',
            'level.required'                    => 'level Harus di isi,',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'code'      => 422,
                'message'   => "Data Tidak Sesuai",
                'data'      => $validator->errors(),
            ]);
        } else {

            if ($request->hasFile('file_arsip')) {
                // Nama unik untuk gambar
                $imageName = time() . '.' . $request->file_arsip->extension();

                $request->file_arsip->move(public_path('file_arsip'), $imageName);
                // // File path
                $filepath =  'file_arsip/' . $imageName;

                //create post 
                DataArsip::create([
                    'data_arsips_id'            => 'DataArsip-' . strtotime(Carbon::now('Asia/Jakarta')),
                    'nomor_arsip'               => $request->nomor_arsip,
                    'tgl_arsip'                 => $request->tgl_arsip,
                    'pencipta_arsips_id'        => $request->pencipta_arsips_id,
                    'data_unit_penciptas_id'    => $request->data_unit_penciptas_id,
                    'klasifiakasi_arsips_id'    => $request->klasifiakasi_arsips_id,
                    'data_boxes_id'             => $request->data_boxes_id,
                    'jumlah_arsip'              => $request->jumlah_arsip,
                    'stok_arsip'                => $request->jumlah_arsip,
                    'level'                     => $request->level,
                    'ket_arsip'                 => $request->ket_arsip,
                    'penerima_arsip'            => $request->penerima_arsip,
                    'lembar_arsip'              => $request->lembar_arsip,
                    'file_arsip'                => $filepath,
                ]);

                return response()->json([
                    'success'   => true,
                    'code'      => 200,
                    'message'   => 'Data Berhasil Disimpan!',

                ]);
            } else {
                //create post 
                DataArsip::create([
                    'data_arsips_id'            => 'DataArsip-' . strtotime(Carbon::now('Asia/Jakarta')),
                    'nomor_arsip'               => $request->nomor_arsip,
                    'tgl_arsip'                 => $request->tgl_arsip,
                    'pencipta_arsips_id'        => $request->pencipta_arsips_id,
                    'data_unit_penciptas_id'    => $request->data_unit_penciptas_id,
                    'klasifiakasi_arsips_id'    => $request->klasifiakasi_arsips_id,
                    'data_boxes_id'             => $request->data_boxes_id,
                    'jumlah_arsip'              => $request->jumlah_arsip,
                    'stok_arsip'                => $request->jumlah_arsip,
                    'level'                     => $request->level,
                    'ket_arsip'                 => $request->ket_arsip,
                    'penerima_arsip'            => $request->penerima_arsip,
                    'lembar_arsip'              => $request->lembar_arsip,
                ]);

                return response()->json([
                    'success'   => true,
                    'code'      => 200,
                    'message'   => 'Data Berhasil Disimpan!',

                ]);
            }
        }
    }

    public function show(Request $request, $modeluser)
    {
        //
        if ($modeluser == "view") {
            // for data table
            $data = DataArsip::join('pencipta_arsips', 'data_arsips.pencipta_arsips_id', '=', 'pencipta_arsips.pencipta_arsips_id')
                ->join('data_unit_penciptas', 'data_arsips.data_unit_penciptas_id', '=', 'data_unit_penciptas.data_unit_penciptas_id')
                ->join('klasifiakasi_arsips', 'data_arsips.klasifiakasi_arsips_id', '=', 'klasifiakasi_arsips.klasifiakasi_arsips_id')
                ->join('data_boxes', 'data_arsips.data_boxes_id', '=', 'data_boxes.data_boxes_id')
                ->orderBy('data_arsips.created_at', 'desc')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = DataArsip::where('data_arsips_id', $request->post_data)->first();
            // return data
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'data'      => $data,
            ]);
        } else if ($modeluser == "box") {
            // for data table
            $data = DataArsip::join('pencipta_arsips', 'data_arsips.pencipta_arsips_id', '=', 'pencipta_arsips.pencipta_arsips_id')
                ->join('data_unit_penciptas', 'data_arsips.data_unit_penciptas_id', '=', 'data_unit_penciptas.data_unit_penciptas_id')
                ->join('klasifiakasi_arsips', 'data_arsips.klasifiakasi_arsips_id', '=', 'klasifiakasi_arsips.klasifiakasi_arsips_id')
                ->join('data_boxes', 'data_arsips.data_boxes_id', '=', 'data_boxes.data_boxes_id')
                ->where('data_arsips.data_boxes_id', $request->post_data)
                ->orderBy('data_arsips.created_at', 'desc')->get();
            // return data
            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_conten'               => 'required',
            'nomor_arsip'               => 'required',
            'tgl_arsip'                 => 'required',
            'pencipta_arsips_id'        => 'required',
            'data_unit_penciptas_id'    => 'required',
            'klasifiakasi_arsips_id'    => 'required',
            'data_boxes_id'             => 'required',
            'jumlah_arsip'              => 'required',
            'level'                     => 'required',
        ], [
            'id_conten.required'                => 'id_conten Harus di isi,',
            'nomor_arsip.required'              => 'nomor_arsip Harus di isi,',
            'tgl_arsip.required'                => 'tgl_arsip Harus di isi,',
            'pencipta_arsips_id.required'       => 'pencipta_arsips_id Harus di isi,',
            'data_unit_penciptas_id.required'   => 'data_unit_penciptas_id Harus di isi,',
            'klasifiakasi_arsips_id.required'   => 'klasifiakasi_arsips_id Harus di isi,',
            'data_boxes_id.required'            => 'data_boxes_id Harus di isi,',
            'jumlah_arsip.required'             => 'jumlah_arsip Harus di isi,',
            'level.required'                    => 'level Harus di isi,',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'code'      => 422,
                'message'   => "Data Tidak Sesuai",
                'data'      => $validator->errors(),
            ]);
        } else {
            if ($request->hasFile('file_arsip')) {

                //mencari data berdasarkan key
                $data = DataArsip::firstWhere('data_arsips_id', $request->id_conten);

                if (File::exists(public_path($data->file_arsip))) {
                    File::delete(public_path($data->file_arsip));
                }
                // Nama unik untuk gambar
                $imageName = time() . '.' . $request->file_arsip->extension();

                $request->file_arsip->move(public_path('file_arsip'), $imageName);
                // // File path
                $filepath =  'file_arsip/' . $imageName;


                //update post 
                $data->update([
                    'nomor_arsip'               => $request->nomor_arsip,
                    'tgl_arsip'                 => $request->tgl_arsip,
                    'pencipta_arsips_id'        => $request->pencipta_arsips_id,
                    'data_unit_penciptas_id'    => $request->data_unit_penciptas_id,
                    'klasifiakasi_arsips_id'    => $request->klasifiakasi_arsips_id,
                    'data_boxes_id'             => $request->data_boxes_id,
                    'jumlah_arsip'              => $request->jumlah_arsip,
                    'level'                     => $request->level,
                    'ket_arsip'                 => $request->ket_arsip,
                    'penerima_arsip'            => $request->penerima_arsip,
                    'lembar_arsip'              => $request->lembar_arsip,
                    'file_arsip'                => $filepath,
                ]);

                return response()->json([
                    'success'   => true,
                    'code'      => 200,
                    'message'   => 'Data Berhasil Disimpan!',

                ]);
            } else {
                //mencari data berdasarkan key
                $data = DataArsip::firstWhere('data_arsips_id', $request->id_conten);

                //update post 
                $data->update([
                    'nomor_arsip'               => $request->nomor_arsip,
                    'tgl_arsip'                 => $request->tgl_arsip,
                    'pencipta_arsips_id'        => $request->pencipta_arsips_id,
                    'data_unit_penciptas_id'    => $request->data_unit_penciptas_id,
                    'klasifiakasi_arsips_id'    => $request->klasifiakasi_arsips_id,
                    'data_boxes_id'             => $request->data_boxes_id,
                    'jumlah_arsip'              => $request->jumlah_arsip,
                    'level'                     => $request->level,
                    'ket_arsip'                 => $request->ket_arsip,
                    'penerima_arsip'            => $request->penerima_arsip,
                    'lembar_arsip'              => $request->lembar_arsip,
                ]);

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
        DataArsip::where('data_arsips_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
