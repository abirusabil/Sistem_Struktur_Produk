@extends('layouts.app')

@section('title', 'Kebutuhan Komponen Finishing')

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
                <h1>Kebutuhan Komponen Finishing Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Kebutuhan Komponen Finishing Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Kebutuhan_Finishing_Item" method="POST">
                                    @csrf
                                    @for ($i = 0; $i < $Item->loop_count; $i++)
                                   
                                    <div class="d-flex">
                                        <input type="hidden" name="Item_Id[]" value="{{ $Item->id }}">
                                    <div class="form-group ml-2">
                                        <label>Kode</label>
                                        <input type="text" name="id[]" id="id" class="form-control px-1 @error('id') is-invalid @enderror" value="{{ old('id'. $i) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label for="Komponen_Finishing_Id">Jenis Komponen_Finishing</label>
                                        <select name="Komponen_Finishing_Id[]" id="Komponen_Finishing_Id" class="form-control px-1">
                                            <option value="">Pilih Komponen_Finishing</option>
                                            @foreach ($KomponenFinishing as $komponenfinishing)
                                                <option value="{{ $komponenfinishing->id}}" {{ old('Komponen_Finishing_Id'.$i) == $komponenfinishing->id ? 'selected' : '' }}>{{ $komponenfinishing->Nama_Komponen_Finishing }}</option>
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Komponen_Finishing_Item[]" id="Quantity_Kebutuhan_Komponen_Finishing_Item" class="form-control px-1 @error('Quantity_Kebutuhan_Komponen_Finishing_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Komponen_Finishing_Item'.$i) }}">
                                        @error('Quantity_Kebutuhan_Komponen_Finishing_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    @endfor
                                        <button type="submit" class="btn btn-primary px-5 d-inline-block">Simpan</button>
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
