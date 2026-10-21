@extends('backend.layouts.app')
@section('content')
    @component('backend.components.form')
        @slot('title')
            Tambah Riwayat
        @endslot
        @slot('action')
            {{ route('riwayat.store') }}
        @endslot
        @slot('form')
            <div class="form-group">
                <label for="">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-control form-control-lg select-class" required>
                  @if (isset($_GET['id']))
                  <option value="{{ $data['pasien']['id'] }}" selected>{{ $data['pasien']['name'] }}</option>    
                  @else
                  <option value="0" selected disabled></option>
                  @foreach ($data['pasiens'] as $pasien)
                      <option value="{{ $pasien['id'] }}">{{ $pasien['name'] }}</option>
                  @endforeach
                  @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control" required>
                    <option value="0" selected disabled>Pilih Dokter</option>
                    @foreach ($data['dokters'] as $dokter)
                        <option value="{{ $dokter['id'] }}">{{ $dokter['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Riwayat Kunjungan</label>
                <input type="text" name="riwayat_kunjungan" id="riwayat_kunjungan" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control rounded-0" required>
            </div>
        @endslot
        @slot('routeBack')
            {{ route('riwayat.index') }}
        @endslot
    @endcomponent
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.select-class').select2();
        });
    </script>
@endpush