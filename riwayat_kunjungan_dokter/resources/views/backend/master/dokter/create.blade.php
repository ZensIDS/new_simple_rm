@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Tambah Dokter
        @endslot
        @slot('action')
            {{ route('dokter.store') }}
        @endslot
        @slot('form')
            <div class="form-group">
                <label for="">Nomor Doktor</label>
                <input type="number" value="{{ $data['nomor'] }}" readonly name="nomor" id="nomor" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama Doktor</label>
                <input type="text" name="name" id="name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nomor Handphone</label>
                <input type="number" name="nomor_hp" id="nomor_hp" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control rounded-0" required>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('dokter.index') }}
        @endslot
    @endcomponent
@endsection
