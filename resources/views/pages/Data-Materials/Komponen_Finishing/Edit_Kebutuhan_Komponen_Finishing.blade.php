@extends('layouts.app')

@section('title', 'Edit Accessories_Hardware')

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
                <h1>Ubah Kebutuhan Accessories Hardware</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanKomponenFinishing->Job_Order }}">Detail Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanKomponenFinishing->Job_Order }}/detailkebutuhan">Detail Kebutuhan Purchase Order</a></div>
                    <div class="breadcrumb-item">Ubah Data Accessories Hardware</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kebutuhan_Komponen_Finishing/{{ $KebutuhanKomponenFinishing->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>id</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$KebutuhanKomponenFinishing->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Job Order</label>
                                        <input type="text" readonly name="Job_Order" id="Job_Order" class="form-control @error('id') is-invalid @enderror" value="{{ old('Job_Order',$KebutuhanKomponenFinishing->Job_Order ) }}">
                                        @error('Job_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Item</label>
                                        <input type="text" name="Nama_Item" id="Nama_Item" class="form-control @error('Nama_Item') is-invalid @enderror" value="{{ old('Nama_Item', $KebutuhanKomponenFinishing->Nama_Item) }}">
                                        @error('Nama_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity Purchase Order</label>
                                        <input type="text" name="Quantity_Purchase_Order" id="Quantity_Purchase_Order" class="form-control @error('Quantity_Purchase_Order') is-invalid @enderror" value="{{ old('Quantity_Purchase_Order',$KebutuhanKomponenFinishing->Quantity_Purchase_Order) }}">
                                        @error('Quantity_Purchase_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No Cutting</label>
                                        <input type="text" name="No_Cutting" id="No_Cutting" class="form-control @error('No_Cutting') is-invalid @enderror" value="{{ old('No_Cutting',$KebutuhanKomponenFinishing->No_Cutting) }}">
                                        @error('No_Cutting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Komponen Finishing Id</label>
                                        <input type="text" name="Komponen_Finishing_Id" id="Komponen_Finishing_Id" class="form-control @error('Komponen_Finishing_Id') is-invalid @enderror" value="{{ old('Komponen_Finishing_Id',$KebutuhanKomponenFinishing->Komponen_Finishing_Id) }}">
                                        @error('Komponen_Finishing_Id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Komponen Finishing</label>
                                        <input type="text" name="Nama_Komponen_Finishing" id="Nama_Komponen_Finishing" class="form-control @error('Nama_Komponen_Finishing') is-invalid @enderror" value="{{ old('Nama_Komponen_Finishing',$KebutuhanKomponenFinishing->Nama_Komponen_Finishing) }}">
                                        @error('Nama_Komponen_Finishing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity Kebutuhan Komponen Finishing Item</label>
                                        <input type="text" name="Quantity_Kebutuhan_Komponen_Finishing_Item" id="Quantity_Kebutuhan_Komponen_Finishing_Item" class="form-control @error('Quantity_Kebutuhan_Komponen_Finishing_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Komponen_Finishing_Item',$KebutuhanKomponenFinishing->Quantity_Kebutuhan_Komponen_Finishing_Item) }}">
                                        @error('Quantity_Kebutuhan_Komponen_Finishing_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Komponen Finishing</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" step="0.01" name="Harga_Komponen_Finishing" class="form-control @error('Harga_Komponen_Finishing') is-invalid @enderror"   value="{{ old('Harga_Komponen_Finishing',$KebutuhanKomponenFinishing->Harga_Komponen_Finishing) }}">
                                            @error('Harga_Komponen_Finishing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
