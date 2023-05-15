@extends('layouts.app')

@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Accessories Hardware Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Accessories Hardware</a></div>
                    <div class="breadcrumb-item">Tambah Accessories Hardware Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Accessories_Hardware" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Accessories Hardware</label>
                                        <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Accessories Hardware</label>
                                        <input type="text" name="Nama_Accessories_Hardware" id="Nama_Accessories_Hardware" class="form-control @error('Nama_Accessories_Hardware') is-invalid @enderror" value="{{ old('Nama_Accessories_Hardware') }}">
                                        @error('Nama_Accessories_Hardware')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Ukuran</label>
                                        <input type="text" name="Ukuran_Accessories_Hardware" id="Ukuran_Accessories_Hardware" class="form-control @error('Ukuran_Accessories_Hardware') is-invalid @enderror"   value="{{ old('Ukuran_Accessories_Hardware') }}">
                                        @error('Ukuran_Accessories_Hardware')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan </label>
                                        <input type="text" name="Satuan_Accessories_Hardware" id="Satuan_Accessories_Hardware" class="form-control @error('Satuan_Accessories_Hardware') is-invalid @enderror"   value="{{ old('Satuan_Accessories_Hardware') }}">
                                        @error('Satuan_Accessories_Hardware')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" step="0.01" name="Harga_Accessories_Hardware" class="form-control @error('Harga_Accessories_Hardware') is-invalid @enderror"   value="{{ old('Harga_Accessories_Hardware') }}">
                                            @error('Harga_Accessories_Hardware')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group mb-3">
                                        <label for="suplier_id">Suplier:</label>
                                        <select name="Suplier_Id" id="Suplier_Id" class="form-control">
                                            <option value="">--Pilih Suplier--</option>
                                            @foreach ($supliers as $suplier)
                                                <option value="{{ $suplier->id }}" {{ old('Suplier_Id') == $suplier->id ? 'selected' : '' }}>{{ $suplier->nama_suplier }}</option>
                                            @endforeach
                                        </select>     
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
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
