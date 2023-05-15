@extends('layouts.app')

@section('title', 'Ongkos Kerja Borongan Dalam')

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
                <h1>Edit Ongkos Kerja Borongan Dalam</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Ongkos Kerja</a></div>
                    <div class="breadcrumb-item">Edit Ongkos Kerja Borongan Dalam</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Borongan_Dalam_Item/{{ $Borongan_Dalam_Item->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                        <input type="hidden" name="Item_Id" value="{{ $Borongan_Dalam_Item->Item_Id }}">
                                    <div class="form-group ml-2">
                                        <label>Bahan 1</label>
                                        <input type="text" name="Bahan_1" id="Bahan_1" class="form-control px-1 @error('Bahan_1') is-invalid @enderror" value="{{ old('Bahan_1',$Borongan_Dalam_Item->Bahan_1) }}">
                                        @error('Bahan_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Bahan 2</label>
                                        <input type="text" name="Bahan_2" id="Bahan_2" class="form-control px-1 @error('Bahan_2') is-invalid @enderror" value="{{ old('Bahan_2',$Borongan_Dalam_Item->Bahan_2) }}">
                                        @error('Bahan_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Sanding 1</label>
                                        <input type="text" name="Sanding_1" id="Sanding_1" class="form-control px-1 @error('Sanding_1') is-invalid @enderror" value="{{ old('Sanding_1',$Borongan_Dalam_Item->Sanding_1) }}">
                                        @error('Sanding_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Sanding 2</label>
                                        <input type="text" name="Sanding_2" id="Sanding_2" class="form-control px-1 @error('Sanding_2') is-invalid @enderror" value="{{ old('Sanding_2',$Borongan_Dalam_Item->Sanding_2) }}">
                                        @error('Sanding_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Proses Assembling</label>
                                        <input type="text" name="Proses_Assembling" id="Proses_Assembling" class="form-control px-1 @error('Proses_Assembling') is-invalid @enderror" value="{{ old('Proses_Assembling',$Borongan_Dalam_Item->Proses_Assembling) }}">
                                        @error('Proses_Assembling')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Finishing</label>
                                        <input type="text" name="Finishing" id="Finishing" class="form-control px-1 @error('Finishing') is-invalid @enderror" value="{{ old('Finishing',$Borongan_Dalam_Item->Finishing) }}">
                                        @error('Finishing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ml-2">
                                        <label>Packing</label>
                                        <input type="text" name="Packing" id="Packing" class="form-control px-1 @error('Packing') is-invalid @enderror" value="{{ old('Packing',$Borongan_Dalam_Item->Packing) }}">
                                        @error('Packing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
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
