<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use App\Models\Monitoring;
use App\Models\Pendataan;
use App\Models\Penumpang;
use App\Models\Tracking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.monitoring.monitoring');
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
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }

    public function countdata(){
        $tracking = Tracking::count();
        $user= User::count();
        $penumpang =Penumpang::count();

         
    //=====================================Bulan=====================================================
    $label_bulan =[
        "Januari", 
        "Februari", 
        "Maret", 
        "April", 
        "Mei", 
        "Juni", 
        "Juli", 
        "Agustus", 
        "September", 
        "Oktober", 
        "November", 
        "Desember"
    ];

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];
  
   
    //================Penumpang========================
    foreach($bulan as $key => $value){
        $b[] = $value;
   

        $Penumpang_jumlah_bulan_januari = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 1)->count(); 
        $Penumpang_jumlah_bulan_februari = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 2)->count(); 
        $Penumpang_jumlah_bulan_maret = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 3)->count(); 
        $Penumpang_jumlah_bulan_april = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 4)->count(); 
        $Penumpang_jumlah_bulan_mei = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 5)->count(); 
        $Penumpang_jumlah_bulan_juni = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 6)->count(); 
        $Penumpang_jumlah_bulan_juli = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 7)->count(); 
        $Penumpang_jumlah_bulan_agustus = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 8)->count(); 
        $Penumpang_jumlah_bulan_september = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 9)->count(); 
        $Penumpang_jumlah_bulan_oktober = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 10)->count(); 
        $Penumpang_jumlah_bulan_november = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 11)->count(); 
        $Penumpang_jumlah_bulan_desember = Penumpang::whereYear('tgl_input_penumpang', date('Y'))->whereMonth('tgl_input_penumpang', 12)->count(); 
    }

    $data_Penumpang_bulan=[
        $Penumpang_jumlah_bulan_januari,
        $Penumpang_jumlah_bulan_februari,
        $Penumpang_jumlah_bulan_maret,
        $Penumpang_jumlah_bulan_april,
        $Penumpang_jumlah_bulan_mei,
        $Penumpang_jumlah_bulan_juni,
        $Penumpang_jumlah_bulan_juli,
        $Penumpang_jumlah_bulan_agustus,
        $Penumpang_jumlah_bulan_september,
        $Penumpang_jumlah_bulan_oktober,
        $Penumpang_jumlah_bulan_november,
        $Penumpang_jumlah_bulan_desember
            
    ];
    
  


//grafik angkutan
foreach($bulan as $key => $value){
    $b[] = $value;


    $angkutan_jumlah_bulan_januari = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 1)->count(); 
    $angkutan_jumlah_bulan_februari = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 2)->count(); 
    $angkutan_jumlah_bulan_maret = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 3)->count(); 
    $angkutan_jumlah_bulan_april = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 4)->count(); 
    $angkutan_jumlah_bulan_mei = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 5)->count(); 
    $angkutan_jumlah_bulan_juni = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 6)->count(); 
    $angkutan_jumlah_bulan_juli = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 7)->count(); 
    $angkutan_jumlah_bulan_agustus = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 8)->count(); 
    $angkutan_jumlah_bulan_september = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 9)->count(); 
    $angkutan_jumlah_bulan_oktober = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 10)->count(); 
    $angkutan_jumlah_bulan_november = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 11)->count(); 
    $angkutan_jumlah_bulan_desember = Angkutan::whereYear('tanggal', date('Y'))->whereMonth('tanggal', 12)->count(); 
}

$data_angkutan_bulan=[
    $angkutan_jumlah_bulan_januari,
    $angkutan_jumlah_bulan_februari,
    $angkutan_jumlah_bulan_maret,
    $angkutan_jumlah_bulan_april,
    $angkutan_jumlah_bulan_mei,
    $angkutan_jumlah_bulan_juni,
    $angkutan_jumlah_bulan_juli,
    $angkutan_jumlah_bulan_agustus,
    $angkutan_jumlah_bulan_september,
    $angkutan_jumlah_bulan_oktober,
    $angkutan_jumlah_bulan_november,
    $angkutan_jumlah_bulan_desember
        
];










    //===========Warna Random=================
    for ($i=0; $i<=count($label_bulan); $i++) {
        $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    }

    //===========Inisialisasi=================
    $bulan_ini = Carbon::now()->formatLocalized('%B');
  
    $hari_ini = Carbon::now()->format('d-m-Y');
    $tahun_ini = Carbon::now()->format('Y');



    $chart = new Penumpang();
    $chart->colours = $colours;
    $chart->bulan_ini = ($bulan_ini);
    $chart->tahun_ini = ($tahun_ini);


    $chart->labels_bulan = ($label_bulan);




    $chart->data_Penumpang_bulan = ($data_Penumpang_bulan);
    $chart->data_angkutan_bulan = ($data_angkutan_bulan);


        return view('dashboard.dashboard', compact('tracking','user','penumpang','chart'));
    }

    //create grafik pendataan by bulan 
    public function tracking(){

        $supir = DB::table('trackings')->leftJoin('users', 'trackings.user_id', '=', 'users.id')->get();

        return view('dashboard.monitoring.tracking', compact('supir'));
        
    
    }

    public function get_tracking(Request $request){

        $tracking = DB::table('trackings')
        ->leftJoin('users','trackings.user_id','users.id')
        ->leftJoin('angkutans','trackings.angkutan_id','angkutans.id')
        ->select('users.*','angkutans.nama_angkutan','trackings.*')
        ->where('users.id',$request->supir)
        ->get();

        if($tracking){
            return response()->json([
                'pesan'=>'sukses',
                'tracking'=>$tracking
            ]);
       
        }else{
            return response()->json([
                'pesan'=>'gagal',
                'tracking'=>[]
            ]);


        }

        return $tracking;

     
    }
}
