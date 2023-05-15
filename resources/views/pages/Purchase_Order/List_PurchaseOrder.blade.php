@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Purchase Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Purchase Order</a></div>
                    <div class="breadcrumb-item">List Purchase Order</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                
                                <div class="w-100">
                                    <h4>List Purchase Order</h4>
                                </div>
                                <div class="d-grid gap-2 d-md-flex w-100 justify-content-md-end">
                                    <a href="{{ url('/create') }}" class="btn rounded btn-primary me-md-2" type="button">
                                        <i class="fa-solid fa-plus mr-2"></i>Tambah Purchase Order Baru
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Job Order</th>
                                                <th>Dasar Purchase Order</th>
                                                <th>Buyer</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Schedule Kirim</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($User as $user) --}}
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td> --}}
                                                <td></td>
                                                <td>
                                                    <a class="btn btn-warning">Ubah</a>
                                                    <a class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index.js') }}"></script>
@endpush
