@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Tambah Pasien
        @endslot
        @slot('action')
            {{ route('pasien.store') }}
        @endslot
        @slot('form')
            <div class="form-group" style="display: none;">
                <label for="">Nomor</label>
                <input type="number" value="{{ $data['nomor'] }}" name="nomor" id="nomor" class="form-control rounded-0" required readonly>
            </div>
            <div class="form-group">
                <label for="">Nomor RM</label>
                <input type="text" name="nomor_rm" id="nomor_rm" class="form-control rounded-0" required>
                @error('nomor_rm')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Lokasi RM</label>
                <input type="text" value="{{ old('lokasi_rm') }}" name="lokasi_rm" id="lokasi_rm" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nama Pasien</label>
                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="umur" value="{{ old('umur') }}" id="umur" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Nomor Handphone</label>
                <input type="number" name="nomor_hp" value="{{ old('nomor_hp') }}" id="nomor_hp" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" id="alamat" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-control rounded-0" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('pasien.index') }}
        @endslot
    @endcomponent
@endsection
