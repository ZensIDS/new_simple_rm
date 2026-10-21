<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Riwayat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function pasien()
    {
        return view('backend.report.pasien.index');
    }

    public function getPasienData(Request $request)
    {
        // Ambil parameter dari DataTables
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'] ?? '';
        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 'desc';

        // Mapping kolom untuk sorting
        $columns = ['nomor', 'nomor_rm', 'lokasi_rm', 'name', 'umur', 'gender', 'alamat', 'nomor_hp'];
        $orderColumnName = $columns[$orderColumn] ?? 'id';

        // Query dasar
        $query = Pasien::select([
            'id',
            'nomor',
            'nomor_rm',
            'lokasi_rm',
            'name',
            'umur',
            'gender',
            'alamat',
            'nomor_hp'
        ]);

        // Total records tanpa filter
        $totalRecords = Pasien::count();

        // Filter pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('nomor_rm', 'LIKE', "%{$search}%")
                    ->orWhere('nomor', 'LIKE', "%{$search}%")
                    ->orWhere('nomor_hp', 'LIKE', "%{$search}%")
                    ->orWhere('umur', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%");
            });
        }

        // Total records setelah filter
        $totalFiltered = $query->count();

        // Sorting dan pagination
        $pasiens = $query->orderBy($orderColumnName, $orderDir)
            ->skip($start)
            ->take($length)
            ->get();

        // Format data untuk DataTables
        $data = [];
        foreach ($pasiens as $pasien) {
            $data[] = [
                'nomor' => $pasien->nomor,
                'nomor_rm' => $pasien->nomor_rm,
                'lokasi_rm' => $pasien->lokasi_rm,
                'name' => $pasien->name,
                'umur' => $pasien->umur,
                'gender' => $pasien->gender,
                'alamat' => $pasien->alamat,
                'nomor_hp' => $pasien->nomor_hp,
                'aksi' => '<a href="' . route('report.pasien.show', $pasien->id) . '" class="btn btn-warning btn-sm btn-flat">Lihat Riwayat</a>'
            ];
        }

        // Return format DataTables
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        ]);
    }

    public function showPasien($id)
    {
        $data['pasien'] = Pasien::find($id);
        $meta['title'] = 'Riwayat Kunjungan Pasien ' . $data['pasien']->name;
        return view('backend.report.pasien.show', compact('data', 'meta'));
    }

    public function hari()
    {
        return view('backend.report.hari.index');
    }

    public function showHari(Request $request)
    {
        $data['riwayats'] = Riwayat::whereBetween('created_at', [$request->awal . ' 00:00:01', $request->akhir . ' 23:59:59'])->get();
        $data['awal'] = $request->awal;
        $data['akhir'] = $request->akhir;
        $meta['title'] = 'Laporan Harian Riwayat Kunjungan ' . $request->awal . ' s/d ' . $request->akhir;
        return view('backend.report.hari.show', compact('data', 'meta'));
    }
}
