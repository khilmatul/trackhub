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
   
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = DB::table('penumpangs')
            ->select('penumpangs.*')
            ->orderBy('penumpangs.created_at','desc')
            ->where('tgl_input_penumpang','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = DB::table('penumpangs')
            ->select('penumpangs.*')
            ->orderBy('penumpangs.created_at','desc')
            ->where('tgl_input_penumpang','Like', '%' .$request->search .'%')->paginate(5);
        }
        return view('dashboard.penumpang.penumpang', compact ('data'));
    }

    public function create()
    {
       return view('dashboard.penumpang.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|min:11|max:12',
            
            
        ]);
        $model = new Penumpang;
        $model->nama = $request->nama_lengkap;
        $model->tgl_lahir = $request->tanggal_lahir;
        $model->alamat = $request->alamat;
        $model->no_telp = $request->no_telepon;
        $model->asal_sekolah = $request->asal_sekolah;
       
        $model->tgl_input_penumpang = Carbon::parse(Carbon::now())->format('Y-m-d');
        $model->qrcode =$this->getRandomString();
        $model->save();

        return redirect('penumpang')->withToastSuccess('Data Berhasil Di Simpan');;

    }

    public function show(Penumpang $penumpang)
    {
        //
    }

    public function edit($id)
    {
        $model = Penumpang::find($id);
        return view('dashboard.penumpang.edit', compact ('model'));
    }

    public function update(Request $request, $id)
    {
        $model = Penumpang::find($id);
        $model->nama = $request->nama_lengkap;
        $model->tgl_lahir = $request->tanggal_lahir;
        $model->alamat = $request->alamat;
        $model->no_telp = $request->no_telepon;
        $model->asal_sekolah = $request->asal_sekolah;
        $model->save();

        return redirect('penumpang')->withToastSuccess('Data Berhasil Di Ubah');
    }

    
    public function destroy($id)
    {
        $model = Penumpang::find($id);
        $model->delete();
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
