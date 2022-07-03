<?php

namespace App\Http\Controllers;

use App\Exports\PendataanExport;
use App\Models\Pendataan;
use App\Models\Rekapitulasi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->where('nama','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->where('nama','Like', '%' .$request->search .'%')->paginate(5);
        }
        return view('dashboard.rekapitulasi.rekapitulasi',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Rekapitulasi $rekapitulasi)
    {
        //
    }

    public function edit(Rekapitulasi $rekapitulasi)
    {
        //
    }

    public function update(Request $request, Rekapitulasi $rekapitulasi)
    {
        //
    }

    public function destroy(Rekapitulasi $rekapitulasi)
    {
        //
    }

    public function eksportrekapitulasi(Request $request){
        if($request->cetak=='pdf'){
        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        if($tanggal_awal == '1970-01-01' && $tanggal_akhir == '1970-01-01'){
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->get();
          view()->share('data', $data);
          $pdf = PDF::loadview('dashboard.rekapitulasi.pdf');

        }
        else{
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->where('waktu_pendataan', '>=', $tanggal_awal)
            ->where('waktu_pendataan', '<=', $tanggal_akhir)
            ->get();
            view()->share('data', $data);
              $pdf = PDF::loadview('dashboard.rekapitulasi.pdf');
        }
          return $pdf->download('rekapitulasi.pdf');
        return $pdf->stream();
    }else{

        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        if($tanggal_awal == '1970-01-01' && $tanggal_akhir == '1970-01-01'){
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftjoin('angkutans','pendataans.angkutan_id','angkutans.id')
            ->get();
        return Excel::download(new PendataanExport($data), 'rekapitulasi_pendataan.xlsx');

        }
        else{
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftjoin('angkutans','pendataans.angkutan_id','angkutans.id')
            ->where('waktu_pendataan', '>=', $tanggal_awal)
            ->where('waktu_pendataan', '<=', $tanggal_akhir)
            ->get();
            return Excel::download(new PendataanExport($data), 'rekapitulasi_pendataan.xlsx');
        }
        
    } 

        }  
}
