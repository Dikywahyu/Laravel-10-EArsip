<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CPage extends Controller
{
    //
    public function login()
    {
        return view('login', [
            'tittle'        => 'Login SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function dashboard()
    {
        return view('dashboard', [
            'tittle'        => 'Dashboard SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function datauser()
    {
        return view('datauser', [
            'tittle'        => 'Data User SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function klasifiakasiarsip()
    {
        return view('arsip/klasifiakasiarsip', [
            'tittle'        => 'Klasifiakasi Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function pencipataarsip()
    {
        return view('arsip/penciptaarsip', [
            'tittle'        => 'Pencipta Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function dataarsip()
    {
        return view('arsip/dataarsip', [
            'tittle'        => 'Data Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    //
    public function unitpencipta($param)
    {
        return view('arsip/unitpencipta', [
            'tittle'        => 'Unit Pencipta Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
            'param'         => $param,
        ]);
    }

    //
    public function sirkulasiarsip($param)
    {
        return view('arsip/sirkulasiarsip', [
            'tittle'        => 'Sirkulasi Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
            'param'         => $param,
        ]);
    }

    //
    public function dataisibox($param)
    {
        return view('arsip/dataisibox', [
            'tittle'        => 'ISI BOX SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
            'param'         => $param,
        ]);
    }

    //
    public function sirkulasiarsipall()
    {
        return view('arsip/sirkulasiarsipall', [
            'tittle'        => 'Sirkulasi Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
            'param'         => "all",
        ]);
    }

    //
    public function boxarsip()
    {
        return view('arsip/databoxe', [
            'tittle'        => 'Box Arsip SSO',
            'institusi'     => 'ITICM',
            'description'   => 'ITICM Single Sign ON',
            'img'           => 'thme-admin/assets/images/logo-icon.png',
        ]);
    }

    public function generateQRCode(Request $request)
    {

        // Generate QR Code
        $qrCode = QrCode::size(200)->generate(url('dataisibox/' . $request->url));

        // Convert to base64
        $imhgata = '<img  ' . $qrCode;
        $qrCodeBase64 = base64_encode($imhgata);

        return response()->json(['qr_code' => $imhgata]);
    }
}
