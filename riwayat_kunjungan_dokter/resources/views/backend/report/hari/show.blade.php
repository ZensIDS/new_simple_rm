@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('backend.components.datatable-full')
                @slot('header')
                    <div class="card-header">
                        <div class="text-right">
                            <a href="{{ route('report.hari.index') }}" class="btn btn-primary btn-sm btn-flat">Kembali</a>
                        </div>
                    </div>
                @endslot
                @slot('head')
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Tanggal</th>
                        <th>Dokter</th>
                        <th>Nomor</th>
                        <th>Nomor RM</th>
                        <th>Lokasi RM</th>
                        <th>Riwayat</th>
                        <th>Keterangan</th>
                    </tr>
                @endslot
                @slot('body')
                    @foreach ($data['riwayats'] as $riwayat)
                        <tr>
                            <td>{{ $riwayat['Pasien']['name'] }}</td>
                            <td>{{ convertTanggal($riwayat['created_at']) }}</td>
                            <td>{{ $riwayat['Dokter']['name'] }}</td>
                            <td>{{ $riwayat['Pasien']['nomor'] }}</td>
                            <td>{{ $riwayat['Pasien']['nomor_rm'] }}</td>
                            <td>{{ $riwayat['Pasien']['lokasi_rm'] }}</td>
                            <td>{{ $riwayat['riwayat_kunjungan'] }}</td>
                            <td>{{ $riwayat['keterangan'] }}</td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
