@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Tambah User
        @endslot
        @slot('action')
            {{ route('user.store') }}
        @endslot
        @slot('form')
            <div class="form-group">
                <label for="">Nomor User</label>
                <input type="number" value="{{ $data['nomor'] }}" readonly name="nomor" id="nomor" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" id="name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="email" id="email" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" id="password" class="form-control rounded-0" required>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('user.index') }}
        @endslot
    @endcomponent
@endsection
