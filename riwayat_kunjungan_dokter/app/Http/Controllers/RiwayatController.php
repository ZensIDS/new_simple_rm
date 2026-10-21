<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        return view('backend.feature.riwayat.index');
    }

    public function getData(Request $request)
    {
        // Ambil parameter dari DataTables
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'] ?? '';
        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 'desc';

        // Mapping kolom untuk sorting
        $columns = ['created_at', 'pasien_id', 'dokter_id', 'riwayat_kunjungan', 'keterangan'];
        $orderColumnName = $columns[$orderColumn] ?? 'created_at';

        // Query dasar dengan EAGER LOADING untuk menghindari N+1 problem
        $query = Riwayat::with(['Pasien:id,name', 'Dokter:id,name'])
            ->select([
                'id',
                'pasien_id',
                'dokter_id',
                'riwayat_kunjungan',
                'keterangan',
                'created_at'
            ]);

        // Total records tanpa filter
        $totalRecords = Riwayat::count();

        // Filter pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('riwayat_kunjungan', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%")
                    ->orWhereHas('Pasien', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('Dokter', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Total records setelah filter
        $totalFiltered = $query->count();

        // Sorting dan pagination
        $riwayats = $query->orderBy($orderColumnName, $orderDir)
            ->skip($start)
            ->take($length)
            ->get();

        // Format data untuk DataTables
        $data = [];
        foreach ($riwayats as $riwayat) {
            $data[] = [
                'tanggal' => convertTanggal($riwayat->created_at),
                'nama_pasien' => $riwayat->Pasien ? $riwayat->Pasien->name : '<span class="badge badge-danger">Data Terhapus</span>',
                'nama_dokter' => $riwayat->Dokter ? $riwayat->Dokter->name : '<span class="badge badge-danger">Data Terhapus</span>',
                'riwayat_kunjungan' => $riwayat->riwayat_kunjungan ?? '-',
                'keterangan' => $riwayat->keterangan ?? '-',
                'aksi' => '
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">
                        Aksi
                    </button>
                    <div class="dropdown-menu">
                        <a href="' . route('riwayat.edit', $riwayat->id) . '" class="dropdown-item">Edit</a>
                        <a href="' . route('riwayat.delete', $riwayat->id) . '" class="dropdown-item hapus-data">Hapus</a>
                    </div>
                </div>
            '
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

    public function create()
    {
        $data['pasiens'] = Pasien::all();
        $data['dokters'] = Dokter::all();
        if (isset($_GET['id'])) {
            $data['pasien'] = Pasien::find($_GET['id']);
        }
        return view('backend.feature.riwayat.create', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['created_by'] = auth()->user()->id;
        Riwayat::create($data);
        return redirect()->route('riwayat.index')->with('success', 'Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $data['riwayat'] = Riwayat::find($id);
        $data['pasiens'] = Pasien::all();
        $data['dokters'] = Dokter::all();
        return view('backend.feature.riwayat.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $data = $request->except('_token', 'nomor');
        Riwayat::where('id', $id)->update($data);
        return redirect()->route('riwayat.index')->with('success', 'Berhasil Ubah Data');
    }

    public function delete($id)
    {
        Riwayat::destroy($id);
        return redirect()->route('riwayat.index')->with('success', 'Berhasil Hapus Data');
    }
}
