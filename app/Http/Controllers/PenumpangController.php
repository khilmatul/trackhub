<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Illuminate\Http\Request;
Use Alert;
use App\Exports\DataPenumpangExport;
use App\Exports\PenumpangExport;
use Carbon\Carbon;
use PDF;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class PenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = Penumpang::where('nama','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = Penumpang::paginate(5);
        }
        return view('dashboard.penumpang.penumpang', compact ('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $model = new Penumpang;
        // $q = DB::table('penumpangs')->select(DB::raw('MAX(RIGHT(kode,4)) as kode'));
        // $kd ="";
        // if($q->count()>0){
        //     foreach($q->get() as $k){
        //         $tmp = ((int)$k->kode)+1;
        //         $kd = sprintf("%04s", $tmp);
        //     }
        // }else{
        //     $kd = "0001";
        // }

        return view('dashboard.penumpang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            // 'kode' => 'required|min:3',
            'nama_lengkap' => 'required|max:100',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|min:11|max:12',
            
            
        ]);
        $model = new Penumpang;
        // $model->kode = $request->kode;
        $model->nama = $request->nama_lengkap;
        $model->tgl_lahir = $request->tanggal_lahir;
        // $model->tgl_lahir = date('d-m-Y', strtotime($request->tanggal_lahir));
        $model->alamat = $request->alamat;
        $model->no_telp = $request->no_telepon;
        $model->asal_sekolah = $request->asal_sekolah;
       
        $model->tgl_input_penumpang = Carbon::parse(Carbon::now())->format('Y-m-d');
        $model->qrcode =$this->getRandomString();
        $model->save();
        //format carbon to date


    

        return redirect('penumpang')->withToastSuccess('Data Berhasil Di Simpan');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function show(Penumpang $penumpang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Penumpang::find($id);
        return view('dashboard.penumpang.edit', compact ('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penumpang  $penumpang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Penumpang::find($id);
        // $model->kode = $request->kode;
        $model->nama = $request->nama_lengkap;
        $model->tgl_lahir = $request->tanggal_lahir;
        $model->alamat = $request->alamat;
        $model->no_telp = $request->no_telepon;
        $model->asal_sekolah = $request->asal_sekolah;
        // $model->qrcode = $request->qr_code;
        $model->save();

        return redirect('penumpang')->withToastSuccess('Data Berhasil Di Ubah');
    }

    
    public function destroy($id)
    {
        $model = Penumpang::find($id);
        $model->delete();
        // Alert::error();
        return redirect('penumpang')->withToastSuccess('Berhasil Menghapus Data');
    }

    public function eksportpenumpang(){
        $data = Penumpang::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('dashboard.penumpang.pdf');
        return $pdf->download('penumpang.pdf');
    }

    public function export_excel_penumpang() 
    {
        return Excel::download(new DataPenumpangExport, 'penumpang.xlsx');
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
