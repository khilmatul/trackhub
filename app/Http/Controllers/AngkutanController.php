<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use Illuminate\Http\Request;
Use Alert;
use App\Exports\DataAngkutanExport;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class AngkutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = DB::table('angkutans')->leftjoin('trayeks', 'angkutans.trayek_id', '=', 'trayeks.id')
            ->leftjoin('users', 'angkutans.user_id', '=', 'users.id')
            ->select('users.*','trayeks.*','angkutans.*')
            ->where('nama_angkutan','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = DB::table('angkutans')->leftjoin('trayeks', 'angkutans.trayek_id', '=', 'trayeks.id')
            ->leftjoin('users', 'angkutans.user_id', '=', 'users.id')
            ->select('users.*','trayeks.*','angkutans.*')
            ->where('nama_angkutan','Like', '%' .$request->search .'%')->paginate(5);
        }
        return view('dashboard.angkutan.angkutan', compact ('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trayek=DB::table('trayeks')->get();
        $user = User::where('profesi','supir')->get();
        return view('dashboard.angkutan.create', compact ('trayek','user'));
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
            'no_polisi' => 'required|max:10',
            'nama_angkutan' => 'required|min:3|max:7',
            'sopir' => 'required',
            'trayek_id' => 'required',
        ]);

        $model = new Angkutan;
        $model->no_polisi = $request->no_polisi;
        $model->nama_angkutan = $request->nama_angkutan;
        $model->user_id = $request->sopir;
        $model->trayek_id = $request->trayek_id;
        $model->tanggal = Carbon::parse(Carbon::now())->format('Y-m-d');
        $model->save();

        return redirect('angkutan')->withToastSuccess('Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Angkutan  $angkutan
     * @return \Illuminate\Http\Response
     */
    public function show(Angkutan $angkutan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Angkutan  $angkutan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trayek=DB::table('trayeks')->get();
        $user = User::where('profesi','supir')->get();

        $model = DB::table('angkutans')->leftjoin('trayeks', 'angkutans.trayek_id', '=', 'trayeks.id')
        ->leftjoin('users', 'angkutans.user_id', '=', 'users.id')
        ->select('users.*','trayeks.*','angkutans.*')
        ->where('angkutans.id',$id)->first();
        return view('dashboard.angkutan.edit', compact ('model','trayek','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angkutan  $angkutan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Angkutan::where('id',$id)->update([
            'no_polisi' => $request->no_polisi,
            'nama_angkutan' => $request->nama_angkutan,
            'user_id' => $request->sopir,
            'trayek_id' => $request->trayek_id,
        ]);

        return redirect('angkutan')->withToastSuccess('Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angkutan  $angkutan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Angkutan::find($id);
        $model->delete();
        return redirect('angkutan')->withToastSuccess('Berhasil Menghapus Data');
    }

    public function eksportangkutan(){
        $data = DB::table('angkutans')->leftJoin('trayeks','angkutans.trayek_id','trayeks.id')
      ->leftJoin('users','angkutans.user_id','users.id')->get();

        view()->share('data', $data);
        $pdf = PDF::loadview('dashboard.angkutan.pdf');
        return $pdf->download('angkutan.pdf');
    }
    public function exportexcels(){
        return Excel::download(new DataAngkutanExport, 'angkutan.xlsx');
    }

}
