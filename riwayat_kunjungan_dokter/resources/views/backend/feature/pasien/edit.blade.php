@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Edit Pasien
        @endslot
        @slot('action')
            {{ route('pasien.update',$data['pasien']['id']) }}
        @endslot
        @slot('form')
            <!--<div class="form-group">
                <label for="">Nomor</label>
                <input type="number" readonly value="{{ $data['pasien']['nomor'] }}" name="nomor" id="nomor" class="form-control rounded-0" required>
            </div>-->
            <div class="form-group">
                <label for="">Nomor RM</label>
                <input type="text" value="{{ $data['pasien']['nomor_rm'] }}" name="nomor_rm" id="nomor_rm" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Lokasi RM</label>
                <input type="text" name="lokasi_rm" value="{{ $data['pasien']['lokasi_rm'] }}" id="lokasi_rm" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama Pasien</label>
                <input type="text" value="{{ $data['pasien']['name'] }}" name="name" id="name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Umur</label>
                <input type="date" value="{{ $data['pasien']['umur'] }}" name="umur" id="umur" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nomor Handphone</label>
                <input type="number" value="{{ $data['pasien']['nomor_hp'] }}" name="nomor_hp" id="nomor_hp" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" value="{{ $data['pasien']['alamat'] }}" name="alamat" id="alamat" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-control rounded-0" required>
                    <option value="Laki-laki" {{ $data['pasien']['gender'] == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $data['pasien']['gender'] == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('pasien.index') }}
        @endslot
    @endcomponent
@endsection
