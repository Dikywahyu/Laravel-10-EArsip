<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPage;
use App\Http\Controllers\Cuser;
use App\Http\Controllers\KlasifiakasiArsipController;
use App\Http\Controllers\DataBoxController;
use App\Http\Controllers\DataUnitPenciptaController;
use App\Http\Controllers\PenciptaArsipController;
use App\Http\Controllers\DataArsipController;
use App\Http\Controllers\SirkulasiArsipController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(CPage::class)->group(function () {
    Route::get('/', 'login')->name('/');
    Route::get('/login', 'login')->name('login');
    Route::get('/loginas/{params}', 'login')->name('login');
    Route::get('/dataisibox/{params}', 'dataisibox')->name('dataisibox');

    Route::get('/', 'dashboard')->name('/')->middleware('auth');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');
    Route::get('/datauser', 'datauser')->name('datauser')->middleware('auth');
    Route::get('/klasifiakasiarsip', 'klasifiakasiarsip')->name('klasifiakasiarsip')->middleware('auth');
    Route::get('/pencipataarsip', 'pencipataarsip')->name('pencipataarsip')->middleware('auth');
    Route::get('/unitpencipta/{params}', 'unitpencipta')->name('unitpencipta')->middleware('auth');
    Route::get('/sirkulasiarsipall', 'sirkulasiarsipall')->name('sirkulasiarsipall')->middleware('auth');
    Route::get('/sirkulasiarsip/{params}', 'sirkulasiarsip')->name('sirkulasiarsip')->middleware('auth');
    Route::get('/boxarsip', 'boxarsip')->name('boxarsip')->middleware('auth');
    Route::get('/dataarsip', 'dataarsip')->name('dataarsip')->middleware('auth');
    Route::get('/generateqrcode', 'generateQRCode')->name('generateQRCode')->middleware('auth');
});


Route::get('/generateqrcodeaa/{text}', function ($text) {
    $dataqr = response(QrCode::size(300)->generate($text))->header('Content-Type', 'image/png');
    return '<img  ' . $dataqr;
})->name('generateqrcodeaa');

Route::controller(Cuser::class)->group(function () {
    Route::get('/loginas/{params}', 'loginas')->name('loginas');
    Route::post('/datauser/show/{user}', 'show')->name('datauser.show');
    Route::post('/datauser/authenticate', 'authenticate')->name('datauser.authenticate');
    Route::post('/datauser/resetpwd', 'resetpwd')->name('datauser.resetpwd');
    Route::post('/datauser/fild', 'fild')->name('datauser.fild');
    Route::post('/datauser/getfild', 'getfild')->name('datauser.getfild');
    Route::post('/datauser/store', 'store')->name('datauser.store');
    Route::post('/datauser/update', 'update')->name('datauser.update');
    Route::delete('/datauser/destroy', 'destroy')->name('datauser.destroy');
});

Route::controller(KlasifiakasiArsipController::class)->group(function () {
    Route::post('/klasifiakasiarsip/store', 'store')->name('klasifiakasiarsip.store');
    Route::post('/klasifiakasiarsip/show/{user}', 'show')->name('klasifiakasiarsip.show');
    Route::post('/klasifiakasiarsip/update', 'update')->name('klasifiakasiarsip.update');
    Route::post('/klasifiakasiarsip/import', 'import')->name('klasifiakasiarsip.import');
    Route::delete('/klasifiakasiarsip/destroy', 'destroy')->name('klasifiakasiarsip.destroy');
});

Route::controller(PenciptaArsipController::class)->group(function () {
    Route::post('/pencipataarsip/store', 'store')->name('pencipataarsip.store');
    Route::post('/pencipataarsip/show/{user}', 'show')->name('pencipataarsip.show');
    Route::post('/pencipataarsip/update', 'update')->name('pencipataarsip.update');
    Route::delete('/pencipataarsip/destroy', 'destroy')->name('pencipataarsip.destroy');
});

Route::controller(DataUnitPenciptaController::class)->group(function () {
    Route::post('/unitarsip/store', 'store')->name('unitarsip.store');
    Route::post('/unitarsip/show/{user}', 'show')->name('unitarsip.show');
    Route::post('/unitarsip/update', 'update')->name('unitarsip.update');
    Route::delete('/unitarsip/destroy', 'destroy')->name('unitarsip.destroy');
});

Route::controller(SirkulasiArsipController::class)->group(function () {
    Route::post('/sirkulasiarsip/store', 'store')->name('sirkulasiarsip.store');
    Route::post('/sirkulasiarsip/show/{user}', 'show')->name('sirkulasiarsip.show');
    Route::post('/sirkulasiarsip/update', 'update')->name('sirkulasiarsip.update');
    Route::delete('/sirkulasiarsip/destroy', 'destroy')->name('sirkulasiarsip.destroy');
});

Route::controller(DataBoxController::class)->group(function () {
    Route::post('/boxarsip/store', 'store')->name('boxarsip.store');
    Route::post('/boxarsip/show/{user}', 'show')->name('boxarsip.show');
    Route::post('/boxarsip/update', 'update')->name('boxarsip.update');
    Route::delete('/boxarsip/destroy', 'destroy')->name('boxarsip.destroy');
});

Route::controller(DataArsipController::class)->group(function () {
    Route::post('/dataarsip/store', 'store')->name('dataarsip.store');
    Route::post('/dataarsip/show/{user}', 'show')->name('dataarsip.show');
    Route::post('/dataarsip/update', 'update')->name('dataarsip.update');
    Route::delete('/dataarsip/destroy', 'destroy')->name('dataarsip.destroy');
});



Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
