<div class="card">
    {{ $header ?? '' }}
    
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
            {{ $head }}
        </thead>
        <tbody>
            {{ $body }}
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  @push('css')
  <link rel="stylesheet" href="{{ asset('adminasset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('adminasset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('adminasset') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  @endpush

  @push('js')
  <script src="{{ asset('adminasset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/jszip/jszip.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{ asset('adminasset') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel","colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @endpush