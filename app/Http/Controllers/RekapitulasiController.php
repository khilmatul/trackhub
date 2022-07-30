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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            // $data = Pendataan::where('nama_lengkap','Like', '%' .$request->search .'%')->paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftJoin('angkutans','pendataans.penumpang_id','angkutans.id')
            ->leftJoin('users','angkutans.user_id','users.id')
            ->select('users.nama as nama_petugas','penumpangs.*','angkutans.*','pendataans.*')
            ->orderBy('pendataans.created_at','desc')
            ->where('penumpangs.nama','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            // $data = Pendataan::paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftJoin('angkutans','pendataans.penumpang_id','angkutans.id')
            ->leftJoin('users','angkutans.user_id','users.id')
            ->select('users.nama as nama_petugas','penumpangs.*','angkutans.*','pendataans.*')
            ->orderBy('pendataans.created_at','desc')
            ->where('penumpangs.nama','Like', '%' .$request->search .'%')->paginate(5);
        }
        // return $data;
        return view('dashboard.rekapitulasi.rekapitulasi',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function show(Rekapitulasi $rekapitulasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekapitulasi $rekapitulasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekapitulasi $rekapitulasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekapitulasi $rekapitulasi)
    {
        //
    }

    public function eksportrekapitulasi(Request $request){
        // $data = DB::table('pendataans')
        // ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
        // ->get();

        // view()->share('data', $data);
        // $pdf = PDF::loadview('dashboard.rekapitulasi.pdf');
        // return $pdf->download('rekapitulasi.pdf');
        if($request->cetak=='pdf'){
        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        if($tanggal_awal == '1970-01-01' && $tanggal_akhir == '1970-01-01'){

           
      
            // $data = Pendataan::paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->get();
        
        // return $data;
          view()->share('data', $data);
          $pdf = PDF::loadview('dashboard.rekapitulasi.pdf');

        }
        else{
            // $data = Pendataan::paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->where('waktu_pendataan', '>=', $tanggal_awal)
            ->where('waktu_pendataan', '<=', $tanggal_akhir)
            ->get();
            // return $data;
            view()->share('data', $data);
              $pdf = PDF::loadview('dashboard.rekapitulasi.pdf');
        }
          return $pdf->download('rekapitulasi.pdf');
        return $pdf->stream();
    }else{

        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        if($tanggal_awal == '1970-01-01' && $tanggal_akhir == '1970-01-01'){

           
      
            // $data = Pendataan::paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftjoin('angkutans','pendataans.angkutan_id','angkutans.id')
            ->get();
        
        // return $data;
        return Excel::download(new PendataanExport($data), 'rekapitulasi_pendataan.xlsx');

        }
        else{
            // $data = Pendataan::paginate(5);
            $data = DB::table('pendataans')
            ->leftjoin('penumpangs', 'pendataans.penumpang_id', '=', 'penumpangs.id')
            ->leftjoin('angkutans','pendataans.angkutan_id','angkutans.id')
            ->where('waktu_pendataan', '>=', $tanggal_awal)
            ->where('waktu_pendataan', '<=', $tanggal_akhir)
            ->get();
            // return $data;
            return Excel::download(new PendataanExport($data), 'rekapitulasi_pendataan.xlsx');
        }
        
    } 

        }
    
    
    // public function exportexcel(){
    //     return Excel::download(new PendataanExport, 'rekapitulasi_pendataan.xlsx');
    // }

    
    

    
}
