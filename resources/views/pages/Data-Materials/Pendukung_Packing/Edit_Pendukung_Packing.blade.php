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
                <h1>Edit Data Pendukung Packing </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Pendukung_Packing">Pendukung Packing</a></div>
                    <div class="breadcrumb-item active"><a href="/Pendukung_Packing">List Pendukung Packing</a></div>
                    <div class="breadcrumb-item">Edit Data Pendukung Packing </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Pendukung_Packing/{{ $Pendukung_Packing->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Pendukung Packing</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$Pendukung_Packing->id) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Pendukung Packing</label>
                                        <input type="text" name="Nama_Pendukung_Packing" id="Nama_Pendukung_Packing" class="form-control @error('Nama_Pendukung_Packing') is-invalid @enderror" value="{{ old('Nama_Pendukung_Packing',$Pendukung_Packing->Nama_Pendukung_Packing) }}">
                                        @error('Nama_Pendukung_Packing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tebal /MM</label>
                                        <input type="number" step="0.01" name="Tebal_Pendukung_Packing" id="Tebal_Pendukung_Packing" class="form-control @error('Tebal_Pendukung_Packing') is-invalid @enderror" value="{{ old('Tebal_Pendukung_Packing',$Pendukung_Packing->Tebal_Pendukung_Packing) }}">
                                        @error('Tebal_Pendukung_Packing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Panjang /Mm</label>
                                        <input type="number" step="0.01" name="Panjang_Pendukung_Packing" id="Panjang_Pendukung_Packing" class="form-control @error('Panjang_Pendukung_Packing') is-invalid @enderror" value="{{ old('Panjang_Pendukung_Packing',$Pendukung_Packing->Panjang_Pendukung_Packing) }}">
                                        @error('Panjang_Pendukung_Packing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lebar /Mm</label>
                                        <input type="number" step="0.01" name="Lebar_Pendukung_Packing" id="Lebar_Pendukung_Packing" class="form-control @error('Lebar_Pendukung_Packing') is-invalid @enderror" value="{{ old('Lebar_Pendukung_Packing',$Pendukung_Packing->Lebar_Pendukung_Packing) }}">
                                        @error('Lebar_Pendukung_Packing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select name="Satuan_Pendukung_Packing" id="Satuan_Pendukung_Packing" class="form-control @error('Satuan_Pendukung_Packing') is-invalid @enderror">
                                            <option value="">--Pilih Satuan--</option>
                                            <option value="Meter" {{ old('Satuan_Pendukung_Packing',$Pendukung_Packing->Satuan_Pendukung_Packing) == 'Meter' ? 'selected' : '' }}>Meter</option>
                                            <option value="Pcs" {{ old('Satuan_Pendukung_Packing',$Pendukung_Packing->Satuan_Pendukung_Packing) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                        </select>
                                        @error('Satuan_Pendukung_Packing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga /Lembar</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" step="0.01" name="Harga_Pendukung_Packing" id="Harga_Pendukung_Packing" class="form-control @error('Harga_Pendukung_Packing') is-invalid @enderror" value="{{ old('Harga_Pendukung_Packing',$Pendukung_Packing->Harga_Pendukung_Packing) }}">
                                            @error('Harga_Pendukung_Packing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="suplier_id">Suplier:</label>
                                        <select name="Suplier_Id" id="Suplier_Id" class="form-control">
                                            <option value="">--Pilih Suplier--</option>
                                            @foreach ($supliers as $suplier)
                                            @if ( old('Suplier_Id',$Pendukung_Packing->Suplier_Id) == $suplier->id)
                                            <option value="{{ $suplier->id }}" selected >{{ $suplier->nama_suplier }}</option>
                                            @else
                                            <option value="{{ $suplier->id }}">{{ $suplier->nama_suplier }}</option>
                                            @endif
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
