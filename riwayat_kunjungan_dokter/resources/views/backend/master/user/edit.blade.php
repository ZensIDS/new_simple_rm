@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Edit User
        @endslot
        @slot('action')
            {{ route('user.update',$data['user']['id']) }}
        @endslot
        @slot('form')
            <div class="form-group">
                <label for="">Nomor User</label>
                <input type="number" value="{{ $data['user']['nomor'] }}" readonly name="nomor" id="nomor" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" value="{{ $data['user']['name'] }}" name="name" id="name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" value="{{ $data['user']['full_name'] }}" name="full_name" id="full_name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" value="{{ $data['user']['email'] }}" name="email" id="email" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" id="password" class="form-control rounded-0">
                <small>Kosongkan untuk tidak mengubah password</small>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('user.index') }}
        @endslot
    @endcomponent
@endsection
