@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="text-right">
                    <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-sm btn-flat">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="pasien-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor RM</th>
                            <th>Lokasi RM</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
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
{{-- jQuery (pastikan sudah ada) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- DataTables JS --}}
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pasien-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pasien.getData') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'no',
                    name: 'no',
                    orderable: false,
                    searchable: false
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
                    data: 'usia',
                    name: 'usia',
                    orderable: false,
                    searchable: false
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