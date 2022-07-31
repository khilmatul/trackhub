<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function authenticate(Request $request){
    $input = $request->all();

    if (User::where('username', '=', $input['username'])->first() == true) {
        if (auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            switch (Auth::user()->profesi) {
                case 'admin':
                    return redirect('/dashboard');
                    break;
                default:
                    return redirect()->back()->with('error', 'Anda Bukan Admin');
                    break;
            }
        } else {
            return redirect()->back()
                ->with('error', 'Password salah');
        }
    } else {
        return redirect()->back()
            ->with('error', 'Username tidak ada atau belum terdaftar');
    }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }

}
