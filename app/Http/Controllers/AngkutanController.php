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

    public function create()
    {
        $trayek=DB::table('trayeks')->get();
        $user = User::where('profesi','supir')->get();
        return view('dashboard.angkutan.create', compact ('trayek','user'));
    }

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

    public function show(Angkutan $angkutan)
    {
        //
    }

    public function edit($id)
    {
        $trayek=DB::table('trayeks')->get();
        $user = User::where('profesi','supir')->get();
        $model = DB::table('angkutans')
        ->leftjoin('trayeks', 'angkutans.trayek_id', '=', 'trayeks.id')
        ->leftjoin('users', 'angkutans.user_id', '=', 'users.id')
        ->select('users.*','trayeks.*','angkutans.*')
        ->where('angkutans.id',$id)->first();
        return view('dashboard.angkutan.edit', compact ('model','trayek','user'));
    }

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

    public function destroy($id)
    {
        $model = Angkutan::find($id);
        $model->delete();
        return redirect('angkutan')->withToastSuccess('Berhasil Menghapus Data');
    }

    public function eksportangkutan(){
<<<<<<< HEAD
        // $data = Angkutan::all();
        $data = DB::table('angkutans')->leftJoin('trayeks','angkutans.trayek_id','trayeks.id')
      ->leftJoin('users','angkutans.user_id','users.id')->get();

=======
        $data = Angkutan::all();
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
        view()->share('data', $data);
        $pdf = PDF::loadview('dashboard.angkutan.pdf');
        return $pdf->download('angkutan.pdf');
    }
    
    public function exportexcels(){
        return Excel::download(new DataAngkutanExport, 'angkutan.xlsx');
    }

}
