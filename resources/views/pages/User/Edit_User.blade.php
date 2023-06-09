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
                <h1>Tambah User Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item">Tambah User Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/User/{{ $User->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama User</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " value="{{ old('name',$User->name)  }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email User</label>
                                        <input type="Email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$User->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Akses</label>
                                        <select class="form-control @error('akses') is-invalid @enderror" name="akses">
                                            <option value="">--Pilih Hak Akses--</option>
                                            <option value="1" {{ old('akses',$User->akses) == '1' ? 'selected' : '' }}>Super Administrator</option>
                                            <option value="2" {{ old('akses',$User->akses) == '2' ? 'selected' : '' }}>Administrator</option>
                                            <option value="3" {{ old('akses',$User->akses) == '3' ? 'selected' : '' }}>Normal User</option>
                                        </select>
                                        @error('akses')
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
