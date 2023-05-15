@extends('layouts.app')

@section('title', 'Buyer')

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
                <h1>Tambah Buyer Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item">Tambah Buyer Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Buyer" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Buyer</label>
                                        <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Buyer</label>
                                        <input type="text" name="Nama_Buyer" id="Nama_Buyer" class="form-control @error('Nama_Buyer') is-invalid @enderror" value="{{ old('Nama_Buyer') }}">
                                        @error('Nama_Buyer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Buyer</label>
                                        <textarea name="Alamat_Buyer" id="Alamat_Buyer" rows="3" class="form-control h-100 @error('Alamat_Buyer') is-invalid @enderror" value="{{ old('Alamat_Buyer') }}"></textarea>
                                        @error('Alamat_Buyer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak Buyer</label>
                                        <textarea name="Kontak_Buyer" id="Kontak_Buyer" rows="3" class="h-100 form-control @error('Kontak_Buyer') is-invalid @enderror" value="{{ old('Kontak_Buyer') }}"></textarea>
                                        @error('Kontak_Buyer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
