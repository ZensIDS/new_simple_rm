@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('backend.components.datatable')
                @slot('header')
                    <div class="card-header">
                        <div class="text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm btn-flat">Tambah</a>
                        </div>
                    </div>
                @endslot
                @slot('head')
                    <tr>
                        <th>Nomor User</th>
                        <th>Nama</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Last Login</th>
                        <th>Aksi</th>
                    </tr>
                @endslot
                @slot('body')
                    @foreach ($data['users'] as $user)
                        <tr>
                            <td>{{ $user['nomor'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['full_name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['last_login'] }}</td>
                            <td>
                                @component('backend.components.button-dropdown')
                                    @slot('list')
                                        <a href="{{ route('user.edit',$user['id']) }}" class="dropdown-item">Edit</a>
                                        <a href="{{ route('user.delete',$user['id']) }}" class="dropdown-item" onclick="return confirm('Yakin Hapus Data ?')">Hapus</a>
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
