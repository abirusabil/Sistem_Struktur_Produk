@extends('layouts.app')

@section('title', 'Ubah Suplier')

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
                <h1>Edit Data Suplier</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Suplier">Suplier</a></div>
                    <div class="breadcrumb-item active"><a href="/Suplier">List Suplier</a></div>
                    <div class="breadcrumb-item">Edit Data Suplier</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Suplier/{{ $suplier->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Suplier</label>
                                        <input type="text" name="nama_suplier" class="form-control" value="{{ old('nama_suplier', $suplier->nama_suplier) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Suplier</label>
                                        <input type="text" name="alamat_suplier" class="form-control" value="{{ old('alamat_suplier', $suplier->alamat_suplier) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak Suplier</label>
                                        <input type="text" name="kontak_suplier" class="form-control" value="{{ old('kontak_suplier', $suplier->kontak_suplier) }}">
                                    </div>
                                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </form>
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
