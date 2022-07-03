<?php

namespace App\Http\Controllers;

use App\Models\Trayek;
use Illuminate\Http\Request;
Use Alert;
use App\Exports\DataTrayekExport;
use PDF;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class TrayekController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = Trayek::where('nama_trayek','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = Trayek::paginate(5);
        }
        return view('dashboard.trayek.trayek', compact ('data'));
    }

    public function create()
    {
        $model = new Trayek;
        $q = DB::table('trayeks')->select(DB::raw('MAX(RIGHT(nama_trayek,4)) as nama_trayek'));
        $kd ="";
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->nama_trayek)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }

        return view('dashboard.trayek.create', compact ('model', 'kd'));
    }

    public function store(Request $request)
    {
        $model = new Trayek;
        $model->nama_trayek = $request->nama_trayek;
        $model->lokasi_berangkat = $request->lokasi_berangkat;
        $model->lokasi_tiba = $request->lokasi_tiba;
        $model->via = $request->via;
        $model->save();

        $validatedData = $request->validate([
            'nama_trayek' => 'required|max:20',
            'lokasi_berangkat' => 'required',
            'lokasi_tiba' => 'required',
            'via' => 'required',
        ]);

        return redirect('trayek')->withToastSuccess('Data Berhasil Di Simpan');
    }

    public function show(Trayek $trayek)
    {
        //
    }

    public function edit($id)
    {
        $model = Trayek::find($id);
        return view('dashboard.trayek.edit', compact ('model'));
    }

    public function update(Request $request, $id)
    {
        $model = Trayek::find($id);
        $model->nama_trayek = $request->nama_trayek;
        $model->lokasi_berangkat = $request->lokasi_berangkat;
        $model->lokasi_tiba = $request->lokasi_tiba;
        $model->via = $request->via;
        $model->save();

        return redirect('trayek')->withToastSuccess('Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $model = Trayek::find($id);
        $model->delete();
        return redirect('trayek')->withToastSuccess('Berhasil Menghapus Data');
    }

    public function eksporttrayek(){
        $data = Trayek::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('dashboard.trayek.pdf');
        return $pdf->download('trayek.pdf');
    }

    public function exportexcel(){
        return Excel::download(new DataTrayekExport, 'trayek.xlsx');
    }

}
