<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('backend.master.user.index',compact('data'));
    }

    public function create()
    {
        $data = [];
        $last = User::latest()->first();        
        if($last != null){
            $last->nomor++;
            $data['nomor'] = sprintf("%06s", $last->nomor);
        }else{
            $data['nomor'] = '000001';
        }
        return view('backend.master.user.create',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['created_by'] = auth()->user()->id;
        user::create($data);
        return redirect()->route('user.index')->with('success','Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('backend.master.user.edit',compact('data'));
    }
    
    public function update($id,Request $request)
    {
        if($request->password == null){
            $data = $request->except('_token','nomor','password');
        }else{
            $data = $request->except('_token','nomor');
            $data['password'] = bcrypt($request->password);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user.index')->with('success','Berhasil Ubah Data');
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success','Berhasil Hapus Data');
    }
}
