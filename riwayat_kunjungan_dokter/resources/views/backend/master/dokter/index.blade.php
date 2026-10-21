@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('backend.components.datatable')
                @slot('header')
                    <div class="card-header">
                        <div class="text-right">
                            <a href="{{ route('dokter.create') }}" class="btn btn-primary btn-sm btn-flat">Tambah</a>
                        </div>
                    </div>
                @endslot
                @slot('head')
                    <tr>
                        <th>Nomor Dokter</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                @endslot
                @slot('body')
                    @foreach ($data['dokters'] as $dokter)
                        <tr>
                            <td>{{ $dokter['nomor'] }}</td>
                            <td>{{ $dokter['name'] }}</td>
                            <td>{{ $dokter['alamat'] }}</td>
                            <td>{{ $dokter['nomor_hp'] }}</td>
                            <td>{{ $dokter['keterangan'] }}</td>
                            <td>
                                @component('backend.components.button-dropdown')
                                    @slot('list')
                                        <a href="{{ route('dokter.edit',$dokter['id']) }}" class="dropdown-item">Edit</a>
                                        <a href="{{ route('dokter.delete',$dokter['id']) }}" class="dropdown-item" onclick="return confirm('Yakin Hapus Data ?')">Hapus</a>
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
