<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    //
    public function tracking(Request $request)
    {

        $req = $request->all();
        $track = Tracking::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'user_id'   => $request->user_id,
            'angkutan_id'   => $request->angkutan_id,
        ], [
            'latitude_tracking_awal'     => $request->latitude_tracking_awal,
            'latitude_tracking_akhir'     => $request->latitude_tracking_akhir,
            'longitude_tracking_akhir'     => $request->longitude_tracking_akhir,
            'longitude_tracking_awal'     => $request->longitude_tracking_awal,
            'waktu_tracking' => Carbon::now()
        ]);

        if ($track) {
            return response()->json([

                'pesan' => 'sukses',
                'data' => [$track]
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }

    public function stop_tracking(Request $request)
    {

    }
    
    public function get_tracking(Request $request){

        $tracking = DB::table('trackings')
        ->leftJoin('users','trackings.user_id','users.id')
        ->select('users.*','trackings.*')
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

    public function getsupir(){
        $supir=DB::table('angkutans')
        ->leftJoin('users','angkutans.user_id','users.id')
        ->select('angkutans.*','users.*')->get();
        return view('live-track',compact('supir'));
    }
}
