@extends('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Detail Pasien
            </div>
            <div class="text-right">
                <a href="{{ route('pasien.index') }}" class="btn btn-primary btn-sm btn-flat">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: {{ $data['pasien']['name'] }}</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $data['pasien']['nomor'] }}</td>
                </tr>
                <tr>
                    <td>Nomor RM</td>
                    <td>: {{ $data['pasien']['nomor_rm'] }}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>: {{ $data['pasien']['lokasi_rm'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: {{ $data['pasien']['umur'] }}</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>: {{ $data['pasien']['usia'] }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data['pasien']['alamat'] }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $data['pasien']['gender'] }}</td>
                </tr>
                <tr>
                    <td>Nomor Handphone</td>
                    <td>: {{ $data['pasien']['nomor_hp'] }}</td>
                </tr>
                <tr>
                    <td>Total Kunjungan</td>
                    <td>: {{ $data['pasien']['Riwayat']->count() }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('backend.components.datatable-full')
                @slot('header')
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Detail Riwayat Kunjungan</h3>
                        </div>
                    </div>
                @endslot
                @slot('head')
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Riwayat</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                @endslot
                @slot('body')
                    @foreach ($data['pasien']['Riwayat'] as $riwayat)
                        <tr>
                            <td>{{ convertTanggal($riwayat['created_at']) }}</td>
                            <td>{{ $riwayat['Pasien']['name'] }}</td>
                            <td>{{ $riwayat['Dokter']['name'] }}</td>
                            <td>{{ $riwayat['riwayat_kunjungan'] }}</td>
                            <td>{{ $riwayat['keterangan'] }}</td>
                            <td>
                                @component('backend.components.button-dropdown')
                                    @slot('list')
                                        <a href="{{ route('riwayat.edit',$riwayat['id']) }}" class="dropdown-item">Edit</a>
                                        <a href="{{ route('riwayat.delete',$riwayat['id']) }}" class="dropdown-item" onclick="return confirm('Yakin Hapus Data ?')">Hapus</a>
                                    @endslot
                                @endcomponent
                            </td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection