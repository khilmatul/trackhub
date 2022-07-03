<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class UnduhKartuController extends Controller
{

   public function daftar_kartu_penumpang(Request $request){

    $validatedData = $request->validate([
        // 'kode' => 'required|min:3',
        'nama_lengkap' => 'required|max:100',
        'tanggal_lahir' => 'required',
        'alamat' => 'required',
        'no_telepon' => 'required|min:11|max:12',
        'asal_sekolah' => 'required|',
        // 'qr_code' => 'required|min:8|max:50'
    ]);
    $model = new Penumpang;
    // $model->kode = $request->kode;
    $model->nama = $request->nama_lengkap;
    $model->tgl_lahir = $request->tanggal_lahir;
    $model->alamat = $request->alamat;
    $model->no_telp = $request->no_telepon;
    $model->asal_sekolah = $request->asal_sekolah;
    $model->tgl_input_penumpang = Carbon::parse(Carbon::now())->format('Y-m-d');
    $model->qrcode =$this->getRandomString();
    $model->save();
    return redirect('/')->with('message','Data Berhasil Di Simpan. Silahkan Cetak Kartu anda');;

   }
    
    //
    public function cetak_kartu_pdf(Request $request){

        //format date to dd-mm-yyyy
        // $validatedData = $request->validate([
        //     'tanggal_lahir' => 'required|date|before:tomorrow',

        // ]);
        $tgl_lahir = $request->tgl_lahir;
        $data = Penumpang::where('nama',$request->nama)
        ->where('tgl_lahir', $tgl_lahir)->first();

        if($data){

            $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($data->qrcode));

        
            $pdf = PDF::loadview('dashboard.cetakkartu.pdf', compact('qrcode','data'))->setPaper('A4','potrait');
    
            return $pdf->download('kartu_penumpang_'.$request->nama.'_'.$tgl_lahir.'_'.'.pdf');

        }else{
            return redirect('/')->with('error','Data Penumpang Tidak Ditemukan');
        }

        // return $data;
      
        
        // view()->share('data', $p);
        // $pdf = PDF::loadview('dashboard.cetakkartu.pdf');
        // return $pdf->download('karu_penumpang.pdf');

       
    }


    public function getRandomString($panjang = 10)
	{
		$karakter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$panjang_karakter = strlen($karakter);
		$randomString = '';
		for ($i = 0; $i < $panjang; $i++) {
			$randomString .= $karakter[rand(0, $panjang_karakter - 1)];
		}
		return $randomString;
	}
}
