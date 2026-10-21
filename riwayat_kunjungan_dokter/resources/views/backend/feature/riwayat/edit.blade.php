@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Edit Riwayat
        @endslot
        @slot('action')
            {{ route('riwayat.store') }}
        @endslot
        @slot('form')
            <div class="form-group">
                <label for="">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-control" required>
                    <option value="0" selected disabled>Pilih Pasien</option>
                    @foreach ($data['pasiens'] as $pasien)
                        <option value="{{ $pasien['id'] }}" {{ $pasien['id'] == $data['riwayat']['pasien_id'] ? 'selected' : '' }}>{{ $pasien['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control" required>
                    <option value="0" selected disabled>Pilih Dokter</option>
                    @foreach ($data['dokters'] as $dokter)
                        <option value="{{ $dokter['id'] }}" {{ $dokter['id'] == $data['riwayat']['dokter_id'] ? 'selected' : '' }}>{{ $dokter['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Riwayat Kunjungan</label>
                <input type="text" value="{{ $data['riwayat']['riwayat_kunjungan'] }}" name="riwayat_kunjungan" id="riwayat_kunjungan" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" value="{{ $data['riwayat']['keterangan'] }}" name="keterangan" id="keterangan" class="form-control rounded-0" required>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('riwayat.index') }}
        @endslot
    @endcomponent
@endsection
