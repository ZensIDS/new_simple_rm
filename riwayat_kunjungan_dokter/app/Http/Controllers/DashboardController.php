<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        User::where('id',auth()->user()->id)->update(['last_login' => Date('Y-m-d H:i:s')]);
        $data['total_user'] = User::count();
        $data['total_pasien'] = Pasien::count();
        $data['total_dokter'] = Dokter::count();
        return view('backend.dashboard.index',compact('data'));
    }
}
