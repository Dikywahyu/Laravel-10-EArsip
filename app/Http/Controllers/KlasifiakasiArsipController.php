<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 
use App\Models\KlasifiakasiArsip ; 
use PhpOffice\PhpSpreadsheet\IOFactory;

class KlasifiakasiArsipController extends Controller
{ 
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'main_code'         => 'required',  
            'arsip_nama'        => 'required',  
        ], [
            'main_code.required'        => 'main code Name Harus di isi,',  
            'arsip_nama.required'       => 'arsip nama Name Harus di isi,',  
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
        KlasifiakasiArsip::create([
            'klasifiakasi_arsips_id'    => 'KlasifiakasiArsip-' . strtotime(Carbon::now('Asia/Jakarta')),
            'main_code'                 => $request->main_code,  
            'arsip_nama'                => $request->arsip_nama, 
            'aktiv_periode'             => $request->aktiv_periode, 
            'inaktiv_periode'           => $request->inaktiv_periode, 
            'afeter_periode'            => $request->afeter_periode, 
            'first_code'                => $request->first_code, 
            'second_code'               => $request->second_code, 
            'third_code'                => $request->third_code, 
            'fourth_code'               => $request->fourth_code, 
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
            $data = KlasifiakasiArsip::orderBy('main_code', 'ASC')->get();
            // return data
            return response()->json($data);
        } else if ($modeluser == "src") {
            // for form data
            $data = KlasifiakasiArsip::where('klasifiakasi_arsips_id', $request->post_data)->first();
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
            'main_code'         => 'required',  
            'arsip_nama'        => 'required',  
        ], [
            'main_code.required'        => 'main code Name Harus di isi,',  
            'arsip_nama.required'       => 'arsip nama Name Harus di isi,',  
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
            $data = KlasifiakasiArsip::firstWhere('klasifiakasi_arsips_id', $request->id_conten);

            //update post 
            $data->update([
                'main_code'         => $request->main_code,  
                'arsip_nama'        => $request->arsip_nama, 
                'aktiv_periode'     => $request->aktiv_periode, 
                'inaktiv_periode'   => $request->inaktiv_periode, 
                'afeter_periode'    => $request->afeter_periode, 
                'first_code'        => $request->first_code, 
                'second_code'       => $request->second_code, 
                'third_code'        => $request->third_code, 
                'fourth_code'       => $request->fourth_code, 
            ]);

            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',

            ]);
        }
    }

    public function import(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'file_klas'             => 'required|mimes:xlsx,xls',   
        ], [
            'file_klas.required'    => 'main code Name Harus di isi,',  
            'file_klas.mimes'        => 'File harus berformat Excel (xlsx atau xls)',  
        ]);

        // check if validation fails
        if ($validator->fails()) {
            $errorsText = '';
            foreach ($validator->errors()->toArray() as $error) {
                $errorsText .= implode("\n", $error) . "\n";
            }
            return response()->json([
                'success'   => false,
                'code'      => 422,
                'message'   => "Data Tidak Sesuai",
                'data'      => $errorsText,
            ]);
        }else {

            $file = $request->file('file_klas');

            // Memeriksa apakah file diunggah adalah file Excel
            if ($file->getClientOriginalExtension() != 'xlsx' && $file->getClientOriginalExtension() != 'xls') {
                return response()->json(['error' => 'File harus berformat Excel (xlsx atau xls).'], 422);
            }

           // Memuat file Excel menggunakan PHPSpreadsheet
            $reader = IOFactory::createReaderForFile($file);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file);
            
            // Mendapatkan data dari lembar kerja dan mulai dari baris kedua
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $dataArray = [];

            $dataArray = [];

            // Proses data sesuai kebutuhan aplikasi Anda
            for ($row = 2; $row <= $highestRow; ++$row) {
                // Mendapatkan data dari kolom A dan B (sesuaikan dengan kebutuhan Anda)
                // $second_code = ($worksheet->getCell('B' . $row)->getValue()) ? "" : '0'.$worksheet->getCell('B' . $row)->getValue();
                $first_code = $worksheet->getCell('A' . $row)->getValue(); 
                $second_code =  ($worksheet->getCell('B' . $row)->getValue() !="") ? '0'.$worksheet->getCell('B' . $row)->getValue() : ""; 
                $third_code =  ($worksheet->getCell('C' . $row)->getValue() !="") ? '0'.$worksheet->getCell('C' . $row)->getValue() : ""; 
                $fourth_code =  ($worksheet->getCell('D' . $row)->getValue() !="") ? '0'.$worksheet->getCell('D' . $row)->getValue() : ""; 
                $arsip_nama = $worksheet->getCell('E' . $row)->getValue(); 
                $aktiv_periode = $worksheet->getCell('F' . $row)->getValue(); 
                $inaktiv_periode = $worksheet->getCell('G' . $row)->getValue(); 
                $afeter_periode = $worksheet->getCell('H' . $row)->getValue(); 
                
                if( $first_code !="" &&
                    $second_code !="" &&
                    $third_code !="" &&
                    $fourth_code !="" )
                {
                    $main_code = $first_code.'.'.$second_code.'.'.$third_code.'.'.$fourth_code;
                }elseif ($first_code !="" &&
                $second_code !="" &&
                $third_code !="") 
                {
                    $main_code = $first_code.'.'.$second_code.'.'.$third_code;
                }elseif ($first_code !="" &&
                $second_code !=""  ) 
                {
                    $main_code = $first_code.'.'.$second_code;
                }else {
                    $main_code = $first_code;
                }

                $data = [
                    'klasifiakasi_arsips_id'    => 'KlasifiakasiArsip-' . strtotime(Carbon::now('Asia/Jakarta')).$row,
                    'main_code'                 => $main_code, 
                    'first_code'                => $first_code, 
                    'second_code'               => $second_code, 
                    'third_code'                => $third_code, 
                    'fourth_code'               => $fourth_code, 
                    'arsip_nama'                => $arsip_nama, 
                    'aktiv_periode'             => $aktiv_periode, 
                    'inaktiv_periode'           => $inaktiv_periode, 
                    'afeter_periode'            => $afeter_periode, 
                    // Tambahkan kolom lainnya sesuai kebutuhan
                ];

                $dataArray[] = $data;
            }

            // Memasukkan data ke dalam database dalam satu batch
            KlasifiakasiArsip::insert($dataArray);

            
            return response()->json([
                'success'   => true,
                'code'      => 200,
                'message'   => 'Data Berhasil Disimpan!',
                'data'      => $dataArray,
            ]);
        }
    }
 
    public function destroy(Request $request)
    {
        //
        KlasifiakasiArsip::where('klasifiakasi_arsips_id', $request->post_data)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!.',
            'dataBanner' => $request->post_data,
        ]);
    }
}
