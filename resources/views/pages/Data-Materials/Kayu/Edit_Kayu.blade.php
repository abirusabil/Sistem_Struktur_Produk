@extends('layouts.app')

@section('title', 'Edit Kayu')

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
                <h1>Edit Data Kayu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Kayu">Kayu</a></div>
                    <div class="breadcrumb-item active"><a href="/Kayu">List Kayu</a></div>
                    <div class="breadcrumb-item">Edit Data Kayu</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kayu/{{ $kayu->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$kayu->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kayu</label>
                                        <input type="text" name="Nama_Kayu" id="Nama_Kayu" class="form-control @error('Nama_Kayu') is-invalid @enderror" value="{{ old('Nama_Kayu', $kayu->Nama_Kayu) }}">
                                        @error('Nama_Kayu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan Kayu</label>
                                        <input type="text" name="Satuan" id="Satuan" class="form-control @error('Satuan') is-invalid @enderror" value="{{ old('Satuan',$kayu->Satuan) }}">
                                        @error('Satuan')
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
                                            <input type="number" step="0.01" name="Harga_Kayu" class="form-control @error('Harga_Kayu') is-invalid @enderror"   value="{{ old('Harga_Kayu',$kayu->Harga_Kayu) }}">
                                            @error('Harga_Kayu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="suplier_id">Suplier:</label>
                                        <select name="Suplier_Id" id="Suplier_Id" class="form-control">
                                            <option value="">--Pilih Suplier--</option>
                                            @foreach ($supliers as $suplier)
                                                @if(old('Suplier_Id', $kayu->Suplier_Id) == $suplier->id)
                                                <option value="{{ $suplier->id }}" selected>{{ $suplier->nama_suplier }}</option>
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
