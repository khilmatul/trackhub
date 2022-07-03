<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrayekController;
use App\Http\Controllers\AngkutanController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\UnduhKartuController;

Route::get('/', function () {
    return view('beranda');
});
Route::post('cetak',[UnduhKartuController::class,'cetak_kartu_pdf']);
Route::post('daftar_penumpang',[UnduhKartuController::class,'daftar_kartu_penumpang']);
Route::get('/login', function () {
    
    if(auth()->check()){
      
        if(auth()->user()->profesi == 'admin'){
            return redirect('/dashboard');
        }
        return view('login.login');
        
    }else{
        return view('login.login');
    
    }

})->name('login');


// Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::GET('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'store']);






Route::group(['middleware' => ['auth','admin']], function () {
    Route::resource('penumpang', PenumpangController::class);
    // export PDF
    Route::get('eksportpenumpang', [PenumpangController::class, 'eksportpenumpang'])->name('eksportpenumpang');
    
    Route::resource('angkutan', AngkutanController::class);
    // export PDF
    Route::get('eksportangkutan', [AngkutanController::class, 'eksportangkutan'])->name('eksportangkutan');
    
    Route::resource('trayek', TrayekController::class);
    // export PDF
    Route::get('eksporttrayek', [TrayekController::class, 'eksporttrayek'])->name('eksporttrayek');
    
    Route::resource('rekapitulasi', RekapitulasiController::class);
    // export PDF
    Route::get('eksportrekapitulasi', [RekapitulasiController::class, 'eksportrekapitulasi'])->name('eksportrekapitulasi');
    
    // Route::resource('monitoring', MonitoringController::class);
    Route::get('monitoring',[ MonitoringController::class, 'tracking']);
    Route::resource('kelolaakun', KelolaUserController::class);
    Route::get('/dashboard', [MonitoringController::class, 'countdata'])->name('dashboard');
    

    Route::get('export_excel_penumpang',[PenumpangController::class,'export_excel_penumpang']);
    Route::get('export_excel_trayek',[TrayekController::class,'exportexcel']);
    Route::get('export_excel_angkutan',[AngkutanController::class,'exportexcels']);
    Route::get('export_excel_rekapitulasi',[RekapitulasiController::class,'exportexcel']);
   
    Route::get('grafikpendataan',[MonitoringController::class,'grafikpendataan']);
   
});