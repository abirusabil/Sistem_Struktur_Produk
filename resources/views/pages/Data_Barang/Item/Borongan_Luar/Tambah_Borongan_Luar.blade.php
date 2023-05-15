@extends('layouts.app')

@section('title', 'Ongkos Kerja Borongan Luar')

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
                <h1>Ongkos Kerja Borongan Luar Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Ongkos Kerja Borongan Luar Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Borongan_Luar_Item" method="POST">
                                    @csrf
                                    <div class=" w-50">
                                        <input name="Item_Id" type="hidden"  value="{{ $itemId}}">
                                    <div class="form-group ml-2">
                                        <label>Anyam</label>
                                        <input type="number" name="Anyam" id="Anyam" class="form-control px-1 @error('Anyam') is-invalid @enderror" value="{{ old('Anyam') }}">
                                        @error('Anyam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Ukir</label>
                                        <input type="number" name="Ukir" id="Ukir" class="form-control px-1 @error('Ukir') is-invalid @enderror" value="{{ old('Ukir') }}">
                                        @error('Ukir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Handle</label>
                                        <input type="number" name="Handle" id="Handle" class="form-control px-1 @error('Handle') is-invalid @enderror" value="{{ old('Handle') }}">
                                        @error('Handle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Bubut</label>
                                        <input type="number" name="Bubut" id="Bubut" class="form-control px-1 @error('Bubut') is-invalid @enderror" value="{{ old('Bubut') }}">
                                        @error('Bubut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Pirelly & Jok</label>
                                        <input type="number" name="Pirelly_Jok" id="Pirelly_Jok" class="form-control px-1 @error('Pirelly_Jok') is-invalid @enderror" value="{{ old('Pirelly_Jok') }}">
                                        @error('Pirelly_Jok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Sterofoam</label>
                                        <input type="number" name="Sterofoam" id="Sterofoam" class="form-control px-1 @error('Sterofoam') is-invalid @enderror" value="{{ old('Sterofoam') }}">
                                        @error('Sterofoam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
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
