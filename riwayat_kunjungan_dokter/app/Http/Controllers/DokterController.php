<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $data['dokters'] = Dokter::all();
        return view('backend.master.dokter.index',compact('data'));
    }

    public function create()
    {
        $data = [];
        $last = Dokter::latest()->first();        
        if($last != null){
            $last->nomor++;
            $data['nomor'] = sprintf("%06s", $last->nomor);
        }else{
            $data['nomor'] = '000001';
        }
        return view('backend.master.dokter.create',compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['created_by'] = auth()->user()->id;
        Dokter::create($data);
        return redirect()->route('dokter.index')->with('success','Berhasil Tambah Data');
    }

    public function edit($id,Request $request)
    {
        $data['dokter'] = Dokter::find($id);
        return view('backend.master.dokter.edit',compact('data'));
    }
    
    public function update($id,Request $request)
    {
        $data = $request->except('_token','nomor');
        Dokter::where('id',$id)->update($data);
        return redirect()->route('dokter.index')->with('success','Berhasil Ubah Data');
    }

    public function delete($id)
    {
        Dokter::destroy($id);
        return redirect()->route('dokter.index')->with('success','Berhasil Hapus Data');
    }
}
