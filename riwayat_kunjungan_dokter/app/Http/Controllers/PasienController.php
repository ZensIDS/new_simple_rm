<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return view('backend.feature.pasien.index');
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
        $columns = ['id', 'nomor_rm', 'lokasi_rm', 'name', 'umur', 'gender', 'alamat', 'nomor_hp'];
        $orderColumnName = $columns[$orderColumn] ?? 'id';

        // Query dasar
        $query = Pasien::select([
            'id',
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
        $no = $start + 1;
        foreach ($pasiens as $pasien) {
            $data[] = [
                'no' => $no++,
                'nomor_rm' => $pasien->nomor_rm,
                'lokasi_rm' => $pasien->lokasi_rm,
                'name' => $pasien->name,
                'umur' => $pasien->umur,
                'usia' => $pasien->usia,
                'gender' => $pasien->gender,
                'alamat' => $pasien->alamat,
                'nomor_hp' => $pasien->nomor_hp,
                'aksi' => '
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a href="' . route('pasien.show', $pasien->id) . '" class="dropdown-item">Detail</a>
                            <a href="' . route('pasien.edit', $pasien->id) . '" class="dropdown-item">Edit</a>
                            <a href="' . route('riwayat.create', ['id' => $pasien->id]) . '" class="dropdown-item">Tambah Riwayat</a>
                            <a href="' . route('pasien.delete', $pasien->id) . '" class="dropdown-item hapus-data">Hapus</a>
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
        $data = [];
        $last = Pasien::latest()->first();
        if ($last != null) {
            $last->nomor++;
            $data['nomor'] = sprintf("%06s", $last->nomor);
        } else {
            $data['nomor'] = '000001';
        }
        return view('backend.feature.pasien.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rm' => 'unique:pasiens'
        ]);
        $data = $request->except('_token');
        //$data['created_by'] = auth()->user()->id;
        $pasien = Pasien::create($data);
        return redirect()->route('riwayat.create', ['id' => $pasien->id]);
    }

    public function edit($id)
    {
        $data['pasien'] = Pasien::find($id);
        return view('backend.feature.pasien.edit', compact('data'));
    }

    public function show($id)
    {
        $data['pasien'] = Pasien::find($id);
        return view('backend.feature.pasien.show', compact('data'));
    }

    public function update($id, Request $request)
    {
        $data = $request->except('_token', 'nomor');
        Pasien::where('id', $id)->update($data);
        return redirect()->route('pasien.index')->with('success', 'Berhasil Ubah Data');
    }

    public function delete($id)
    {
        Pasien::destroy($id);
        return redirect()->route('pasien.index')->with('success', 'Berhasil Hapus Data');
    }
}
