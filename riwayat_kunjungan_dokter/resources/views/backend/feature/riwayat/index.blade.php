@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="text-right">
                    <a href="{{ route('riwayat.create') }}" class="btn btn-primary btn-sm btn-flat">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="riwayat-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Riwayat</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
        $('#riwayat-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('riwayat.getData') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'nama_pasien',
                    name: 'nama_pasien'
                },
                {
                    data: 'nama_dokter',
                    name: 'nama_dokter'
                },
                {
                    data: 'riwayat_kunjungan',
                    name: 'riwayat_kunjungan'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ], // Sort by tanggal descending (terbaru di atas)
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

        // Handle delete dengan konfirmasi
        $(document).on('click', '.hapus-data', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (confirm('Yakin Hapus Data?')) {
                window.location.href = url;
            }
        });
    });
</script>
@endpush