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
                <h1>Ubah Data Plywood MDF</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Plywood_MDF">Plywood MDF</a></div>
                    <div class="breadcrumb-item">Tambah Plywood MDF Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Plywood_MDF/{{ $Plywood_MDF->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$Plywood_MDF->id) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Plywood/MDF</label>
                                        <input type="text" name="Nama_Plywood_MDF" id="Nama_Plywood_MDF" class="form-control @error('Nama_Plywood_MDF') is-invalid @enderror" value="{{ old('Nama_Plywood_MDF',$Plywood_MDF->Nama_Plywood_MDF ) }}">
                                        @error('Nama_Plywood_MDF')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tebal /MM</label>
                                        <input type="number" step="0.01" name="Tebal_Plywood_MDF" id="Tebal_Plywood_MDF" class="form-control @error('Tebal_Plywood_MDF') is-invalid @enderror" value="{{ old('Tebal_Plywood_MDF',$Plywood_MDF->Tebal_Plywood_MDF) }}">
                                        @error('Tebal_Plywood_MDF')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Panjang /Mm</label>
                                        <input type="number" step="0.01" name="Panjang_Plywood_MDF" id="Panjang_Plywood_MDF" class="form-control @error('Panjang_Plywood_MDF') is-invalid @enderror" value="{{ old('Panjang_Plywood_MDF',$Plywood_MDF->Panjang_Plywood_MDF) }}">
                                        @error('Panjang_Plywood_MDF')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lebar /Mm</label>
                                        <input type="number" step="0.01" name="Lebar_Plywood_MDF" id="Lebar_Plywood_MDF" class="form-control @error('Lebar_Plywood_MDF') is-invalid @enderror" value="{{ old('Lebar_Plywood_MDF',$Plywood_MDF->Lebar_Plywood_MDF) }}">
                                        @error('Lebar_Plywood_MDF')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" name="Satuan_Plywood_MDF" id="Satuan_Plywood_MDF" class="form-control @error('Satuan_Plywood_MDF',) is-invalid @enderror" value="{{ old('Satuan_Plywood_MDF',$Plywood_MDF->Satuan_Plywood_MDF) }}">
                                        @error('Satuan_Plywood_MDF')
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
                                            <input type="number" step="0.01" name="Harga_Plywood_MDF" id="Harga_Plywood_MDF" class="form-control @error('Harga_Plywood_MDF') is-invalid @enderror" value="{{ old('Harga_Plywood_MDF',$Plywood_MDF->Harga_Plywood_MDF) }}">
                                            @error('Harga_Plywood_MDF')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="suplier_id">Suplier:</label>
                                        <select name="Suplier_Id" id="Suplier_Id" class="form-control">
                                            <option value="">--Pilih Suplier--</option>
                                            @foreach ($supliers as $suplier)
                                            @if (old('Suplier_Id', $Plywood_MDF->Suplier_Id) == $suplier->id)
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
