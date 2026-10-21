<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($meta['title']) ? $meta['title'] : 'Aplikasi Riwayat Kunjungan' }}</title>
    @include('backend.layouts.data.styles')

    {{-- TAMBAHKAN INI untuk CSS tambahan dari @push('styles') --}}
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('backend.layouts.data.navbar')
        @include('backend.layouts.data.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="text-capitalize">{{ request()->segment(1) ?? request()->segment(2) }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @foreach (request()->segments() as $index => $item)
                                <li class="breadcrumb-item text-capitalize">
                                    @if ($loop->last)
                                    {{ $item }}
                                    @else
                                    <a href="#">{{ $item }}</a>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses !</strong> {{ session('success') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('backend.layouts.data.footer')

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @include('backend.layouts.data.scripts')

    {{-- TAMBAHKAN INI untuk JavaScript tambahan dari @push('scripts') --}}
    @stack('scripts')
</body>

</html>