@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Laporan Per Pasien
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="laporan-pasien-table">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor RM</th>
                            <th>Lokasi RM</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- DataTables CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#laporan-pasien-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('report.pasien.getData') }}", // Sesuaikan dengan route
                type: 'GET'
            },
            columns: [{
                    data: 'nomor',
                    name: 'nomor'
                },
                {
                    data: 'nomor_rm',
                    name: 'nomor_rm'
                },
                {
                    data: 'lokasi_rm',
                    name: 'lokasi_rm'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'nomor_hp',
                    name: 'nomor_hp'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'desc']
            ], // Sort by nomor_rm descending
            pageLength: 50,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            language: {
                processing: "Memproses...",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data yang cocok",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush