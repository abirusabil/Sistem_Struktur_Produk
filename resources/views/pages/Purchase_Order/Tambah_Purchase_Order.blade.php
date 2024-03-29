@extends('layouts.app')

@section('title', 'Purchase Order')

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
                <h1>Purchase Order Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item">Purchase Order Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Purchase_Order" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id">Job Order</label>
                                        <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Dasar_Po">Dasar Purchase Order</label>
                                        <input type="text" name="Dasar_Po" id="Dasar_Po" class="form-control @error('Dasar_Po') is-invalDasar_Po @enderror" value="{{ old('Dasar_Po') }}">
                                        @error('Dasar_Po')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Buyer_Id">Buyer:</label>
                                        <select name="Buyer_Id" id="Buyer_Id" class="form-control">
                                            <option value="">--Pilih Buyer--</option>
                                            @foreach ($buyers as $buyer)
                                                <option value="{{ $buyer->id }}" {{ old('Buyer_Id') == $buyer->id ? 'selected' : '' }}>{{ $buyer->Nama_Buyer }}</option>
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group">
                                        <label for="Tanggal_Masuk">Tanggal Masuk</label>
                                        <input type="date" name="Tanggal_Masuk" id="Tanggal_Masuk" class="form-control @error('Tanggal_Masuk') is-invalTanggal_Masuk @enderror" value="{{ old('Tanggal_Masuk') }}">
                                        @error('Tanggal_Masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Schedule_Kirim">Schedule Kirim</label>
                                        <input type="date" name="Schedule_Kirim" id="Schedule_Kirim" class="form-control @error('Schedule_Kirim') is-invalSchedule_Kirim @enderror" value="{{ old('Schedule_Kirim') }}">
                                        @error('Schedule_Kirim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="Status" id="Status" class="form-control @error('Status') is-invalStatus @enderror" value="0">
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
