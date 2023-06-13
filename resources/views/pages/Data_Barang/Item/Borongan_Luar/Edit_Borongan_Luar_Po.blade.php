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
                <h1>Edit Ongkos Kerja Borongan Luar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $BoronganLuarPo->Job_Order }}">Detail Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $BoronganLuarPo->Job_Order }}/detailkebutuhan">Detail Kebutuhan Purchase Order</a></div>
                    <div class="breadcrumb-item">Ubah Ongkos Kerja Borongan Luar</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Borongan_Luar_Po/{{ $BoronganLuarPo->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group ml-2">
                                        <label>Job Order</label>
                                        <input type="text" name="Job_Order" id="Job_Order" class="form-control px-1 @error('Job_Order') is-invalid @enderror" value="{{ old('Job_Order',$BoronganLuarPo->Job_Order) }}">
                                        @error('Job_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Nama Item</label>
                                        <input type="text" name="Nama_Item" id="Nama_Item" class="form-control px-1 @error('Nama_Item') is-invalid @enderror" value="{{ old('Nama_Item',$BoronganLuarPo->Nama_Item) }}">
                                        @error('Nama_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity Purchase Order</label>
                                        <input type="text" name="Quantity_Purchase_Order" id="Quantity_Purchase_Order" class="form-control px-1 @error('Quantity_Purchase_Order') is-invalid @enderror" value="{{ old('Quantity_Purchase_Order',$BoronganLuarPo->Quantity_Purchase_Order) }}">
                                        @error('Quantity_Purchase_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>No Cutting</label>
                                        <input type="text" name="No_Cutting" id="No_Cutting" class="form-control px-1 @error('No_Cutting') is-invalid @enderror" value="{{ old('No_Cutting',$BoronganLuarPo->No_Cutting) }}">
                                        @error('No_Cutting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Anyam</label>
                                        <input type="text" name="Anyam" id="Anyam" class="form-control px-1 @error('Anyam') is-invalid @enderror" value="{{ old('Anyam',$BoronganLuarPo->Anyam) }}">
                                        @error('Anyam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Ukir</label>
                                        <input type="text" name="Ukir" id="Ukir" class="form-control px-1 @error('Ukir') is-invalid @enderror" value="{{ old('Ukir',$BoronganLuarPo->Ukir) }}">
                                        @error('Ukir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Handle</label>
                                        <input type="text" name="Handle" id="Handle" class="form-control px-1 @error('Handle') is-invalid @enderror" value="{{ old('Handle',$BoronganLuarPo->Handle) }}">
                                        @error('Handle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Bubut</label>
                                        <input type="text" name="Bubut" id="Bubut" class="form-control px-1 @error('Bubut') is-invalid @enderror" value="{{ old('Bubut',$BoronganLuarPo->Bubut) }}">
                                        @error('Bubut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Pirelly Jok</label>
                                        <input type="text" name="Pirelly_Jok" id="Pirelly_Jok" class="form-control px-1 @error('Pirelly_Jok') is-invalid @enderror" value="{{ old('Pirelly_Jok',$BoronganLuarPo->Pirelly_Jok) }}">
                                        @error('Pirelly_Jok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Sterofoam</label>
                                        <input type="text" name="Sterofoam" id="Sterofoam" class="form-control px-1 @error('Sterofoam') is-invalid @enderror" value="{{ old('Sterofoam',$BoronganLuarPo->Sterofoam) }}">
                                        @error('Sterofoam')
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
