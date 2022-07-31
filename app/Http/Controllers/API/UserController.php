<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Angkutan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function getRandomString($panjang = 30)
    {
        $karakter = '0123456789abcdefghiklmnopqrstuvwxyz';
        $panjang_karakter = strlen($karakter);
        $randomString = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomString .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $randomString;
    }
    public function login(Request $request)
    {
        $random = $this->getRandomString();

        $users = User::where('username', $request->nama)->whereIn('profesi',['supir','petugas_terminal'])->first();
 
       

        // $angkutan = Angkutan::where('user_id',$user->id)->first();

     
            // return $user;
        // return $user;
        // return $angkutan->id;
        // $user->angkutan = $angkutan->id;
        
   

        if ($users) {
            if (password_verify($request->password, $users->password)) {
               
                $users->update([
                    'api-token' => $random,
                ]);

                if($users->profesi=='supir'){

                    $user = DB::table('angkutans')
                    ->leftjoin('users', 'angkutans.user_id', 'users.id')
                    ->leftJoin('trayeks', 'angkutans.trayek_id', 'trayeks.id')
                    ->select( 'angkutans.id as angkutan_id','angkutans.*','trayeks.*','users.*')
                    ->where('users.id', $users->id)
                    ->first();
        
                }else{
                    $user = DB::table('users')
                    ->select( 'users.*')
                    ->where('users.id', $users->id)
                    ->first();
        
                }
                
                return response()->json([
                    'pesan' => 'sukses',
                    'user' => $user
                ]);
            }

            return response()->json([
                'pesan' => 'gagal, password anda salah',
                'message' => "Kata sandi salah",
            ]);
        }

        return response()->json([
            'pesan' => 'gagal. Username tidak terdaftar',
            'message' => "Nama Pengguna tidak terdaftar",
        ]);
    }

    public function ubah_password(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return response()->json([
                'pesan' => 'berhasil update password'
            ]);
        } else {

            return response()->json([
                'pesan' => 'gagal update password'
            ]);
        }
    }

    public function ubah_profil(Request $request)
    {
        $users =  User::where('id', $request->id)->first();



        if ($users) {
            $users->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'username' => $request->username
            ]);
            if($users->profesi=='supir'){

                $user = DB::table('angkutans')
                ->leftjoin('users', 'angkutans.user_id', 'users.id')
                ->leftJoin('trayeks', 'angkutans.trayek_id', 'trayeks.id')
                ->select( 'angkutans.id as angkutan_id','angkutans.*','trayeks.*','users.*')
                ->where('users.id', $users->id)
                ->first();
    
            }else{
                $user = DB::table('users')
                ->select( 'users.*')
                ->where('users.id', $users->id)
                ->first();
    
            }
            return response()->json([
                'pesan' => 'sukses',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal update profil'
            ]);
        }
    }
    public function getprofil($id){

        $users =  User::where('id', $id)->first();



        if ($users) {
         
            if($users->profesi=='supir'){

                $user = DB::table('angkutans')
                ->leftjoin('users', 'angkutans.user_id', 'users.id')
                ->leftJoin('trayeks', 'angkutans.trayek_id', 'trayeks.id')
                ->select( 'angkutans.id as angkutan_id','angkutans.*','trayeks.*','users.*')
                ->where('users.id', $users->id)
                ->first();
    
            }else{
                $user = DB::table('users')
                ->select( 'users.*')
                ->where('users.id', $users->id)
                ->first();
    
            }
            return response()->json([
                'pesan' => 'sukses',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'pesan' => 'kosong'
            ]);
        }

    }
}
