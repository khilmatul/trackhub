<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = User::where('username','Like', '%' .$request->search .'%')->paginate(5);
        }
        else{
            $data = User::paginate(5);
        }
        return view('dashboard.kelolaakun.index', compact ('data'));
    }

    public function create()
    {
        return view('dashboard.kelolaakun.create');
    }

    public function store(Request $request)
    {
        $validatedData=  $request->validate( [
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'nama' => 'required',
            'profesi' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:12|max:13',
      
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->nama = $request->nama;
        $user->profesi = $request->profesi;
        $user->alamat = $request->alamat;
        $user->notelp = $request->nohp;
        $user->save();

        return redirect('kelolaakun')->withToastSuccess('Data Berhasil Di Simpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //edit user
        $user = User::find($id);
        return view('dashboard.kelolaakun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        if($request->password)
        {
             $request->validate( [
                'nama' => 'required',
                'profesi' => 'required',
                'alamat' => 'required',
                'nohp' => 'required|min:11|max:12',
            ]);
        
            $user->update([
                'nama' => $request->nama,
                'profesi' => $request->profesi,
                'alamat' => $request->alamat,
                'notelp' => $request->nohp,
                'username'=>$request->username,
                'password'=>bcrypt($request->password),

            ]);
            return redirect('kelolaakun')->withToastSuccess('Data Berhasil Di Update');
        }
        else{
            $request->validate( [
                'nama' => 'required',
                'profesi' => 'required',
                'alamat' => 'required',
                'nohp' => 'required',
            ]);
            $user->update([
                'nama' => $request->nama,
                'profesi' => $request->profesi,
                'alamat' => $request->alamat,
                'notelp' => $request->nohp,
                'username'=>$request->username,
            ]);
            return redirect('kelolaakun')->withToastSuccess('Data Berhasil Di Update');
        }
       
    }

    public function destroy($id)
    {
        //destroy
        $user = User::find($id);
        $user->delete();
        return redirect('kelolaakun')->withToastSuccess('Data Berhasil Di Hapus');
    }
}
