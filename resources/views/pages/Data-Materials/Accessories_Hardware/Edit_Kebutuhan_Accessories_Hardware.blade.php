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
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanAccessoriesHardware->Job_Order }}">Detail Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanAccessoriesHardware->Job_Order }}/detailkebutuhan">Detail Kebutuhan Purchase Order</a></div>
                    <div class="breadcrumb-item">Ubah Data Accessories Hardware</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kebutuhan_Accessories_Hardware/{{ $KebutuhanAccessoriesHardware->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>id</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$KebutuhanAccessoriesHardware->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Job Order</label>
                                        <input type="text" readonly name="Job_Order" id="Job_Order" class="form-control @error('id') is-invalid @enderror" value="{{ old('Job_Order',$KebutuhanAccessoriesHardware->Job_Order ) }}">
                                        @error('Job_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Item</label>
                                        <input type="text" name="Nama_Item" id="Nama_Item" class="form-control @error('Nama_Item') is-invalid @enderror" value="{{ old('Nama_Item', $KebutuhanAccessoriesHardware->Nama_Item) }}">
                                        @error('Nama_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity Purchase Order</label>
                                        <input type="text" name="Quantity_Purchase_Order" id="Quantity_Purchase_Order" class="form-control @error('Quantity_Purchase_Order') is-invalid @enderror" value="{{ old('Quantity_Purchase_Order',$KebutuhanAccessoriesHardware->Quantity_Purchase_Order) }}">
                                        @error('Quantity_Purchase_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No Cutting</label>
                                        <input type="text" name="No_Cutting" id="No_Cutting" class="form-control @error('No_Cutting') is-invalid @enderror" value="{{ old('No_Cutting',$KebutuhanAccessoriesHardware->No_Cutting) }}">
                                        @error('No_Cutting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Accessories Hardware Id</label>
                                        <input type="text" name="Accessories_Hardware_Id" id="Accessories_Hardware_Id" class="form-control @error('Accessories_Hardware_Id') is-invalid @enderror" value="{{ old('Accessories_Hardware_Id',$KebutuhanAccessoriesHardware->Accessories_Hardware_Id) }}">
                                        @error('Accessories_Hardware_Id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Accessories Hardware</label>
                                        <input type="text" name="Nama_Accessories_Hardware" id="Nama_Accessories_Hardware" class="form-control @error('Nama_Accessories_Hardware') is-invalid @enderror" value="{{ old('Nama_Accessories_Hardware',$KebutuhanAccessoriesHardware->Nama_Accessories_Hardware) }}">
                                        @error('Nama_Accessories_Hardware')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan Kebutuhan Accessories Hardware</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Accessories_Hardware_Item" id="Keterangan_Kebutuhan_Accessories_Hardware_Item" class="form-control @error('Keterangan_Kebutuhan_Accessories_Hardware_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Accessories_Hardware_Item',$KebutuhanAccessoriesHardware->Keterangan_Kebutuhan_Accessories_Hardware_Item) }}">
                                        @error('Keterangan_Kebutuhan_Accessories_Hardware_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Ukuran Accessories Hardware</label>
                                        <input type="text" name="Ukuran_Accessories_Hardware" id="Ukuran_Accessories_Hardware" class="form-control @error('Ukuran_Accessories_Hardware') is-invalid @enderror" value="{{ old('Ukuran_Accessories_Hardware',$KebutuhanAccessoriesHardware->Ukuran_Accessories_Hardware) }}">
                                        @error('Ukuran_Accessories_Hardware')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity Kebutuhan Accessories Hardware Item</label>
                                        <input type="text" name="Quantity_Kebutuhan_Accessories_Hardware_Item" id="Quantity_Kebutuhan_Accessories_Hardware_Item" class="form-control @error('Quantity_Kebutuhan_Accessories_Hardware_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Accessories_Hardware_Item',$KebutuhanAccessoriesHardware->Quantity_Kebutuhan_Accessories_Hardware_Item) }}">
                                        @error('Quantity_Kebutuhan_Accessories_Hardware_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Accessories Hardware</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" step="0.01" name="Harga_Accessories_Hardware" class="form-control @error('Harga_Accessories_Hardware') is-invalid @enderror"   value="{{ old('Harga_Accessories_Hardware',$KebutuhanAccessoriesHardware->Harga_Accessories_Hardware) }}">
                                            @error('Harga_Accessories_Hardware')
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
