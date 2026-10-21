@extends('backend.layouts.app')
@section('content')
   <div class="card">
       <div class="card-header">
           <div class="card-title">
               Laporan Perhari
           </div>
       </div>
       <div class="card-body">
           <form action="{{ route('report.hari.show') }}" method="get">
               <div class="form-group">
                   <label for="">Tanggal Awal</label>
                   <input type="date" name="awal" id="awal" class="form-control" required>
               </div>
               <div class="form-group">
                <label for="">Tanggal Akhir</label>
                <input type="date" name="akhir" id="akhir" class="form-control" required>
            </div>
       </div>
       <div class="card-footer">
           <div class="text-right">
            <button type="submit" class="btn btn-success btn-flat btn-sm">Lihat Laporan</button>
           </div>
        </form>
       </div>
   </div>
@endsection
@push('js')
    <script>
        $('#awal').on('change',function(){
            $('#akhir').attr('min',$(this).val());
        })
    </script>
@endpush