@extends('layouts.app')

@section('title', 'Edit Kebutuhan Kayu PO')

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
                <h1>Edit Kebutuhan Kayu PO</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanKayu->Job_Order }}">Detail Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $KebutuhanKayu->Job_Order }}/detailkebutuhan">Detail Kebutuhan Purchase Order</a></div>
                    <div class="breadcrumb-item">Edit Kebutuhan Kayu PO</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kebutuhan_Kayu/{{ $KebutuhanKayu->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>id</label>
                                        <input type="text" readonly name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$KebutuhanKayu->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Job_Order</label>
                                        <input type="text" readonly name="Job_Order" id="Job_Order" class="form-control @error('id') is-invalid @enderror" value="{{ old('Job_Order',$KebutuhanKayu->Job_Order ) }}">
                                        @error('Job_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama_Item</label>
                                        <input type="text" name="Nama_Item" id="Nama_Item" class="form-control @error('Nama_Item') is-invalid @enderror" value="{{ old('Nama_Item', $KebutuhanKayu->Nama_Item) }}">
                                        @error('Nama_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity Purchase Order</label>
                                        <input type="text" name="Quantity_Purchase_Order" id="Quantity_Purchase_Order" class="form-control @error('Quantity_Purchase_Order') is-invalid @enderror" value="{{ old('Quantity_Purchase_Order',$KebutuhanKayu->Quantity_Purchase_Order) }}">
                                        @error('Quantity_Purchase_Order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No_Cutting</label>
                                        <input type="text" name="No_Cutting" id="No_Cutting" class="form-control @error('No_Cutting') is-invalid @enderror" value="{{ old('No_Cutting',$KebutuhanKayu->No_Cutting) }}">
                                        @error('No_Cutting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kayu_Id</label>
                                        <input type="text" name="Kayu_Id" id="Kayu_Id" class="form-control @error('Kayu_Id') is-invalid @enderror" value="{{ old('Kayu_Id',$KebutuhanKayu->Kayu_Id) }}">
                                        @error('Kayu_Id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama_Kayu</label>
                                        <input type="text" name="Nama_Kayu" id="Nama_Kayu" class="form-control @error('Nama_Kayu') is-invalid @enderror" value="{{ old('Nama_Kayu',$KebutuhanKayu->Nama_Kayu) }}">
                                        @error('Nama_Kayu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>KP_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="KP_Kebutuhan_Kayu_Item" id="KP_Kebutuhan_Kayu_Item" class="form-control @error('KP_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('KP_Kebutuhan_Kayu_Item',$KebutuhanKayu->KP_Kebutuhan_Kayu_Item) }}">
                                        @error('KP_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Kayu_Item" id="Keterangan_Kebutuhan_Kayu_Item" class="form-control @error('Keterangan_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Kayu_Item',$KebutuhanKayu->Keterangan_Kebutuhan_Kayu_Item) }}">
                                        @error('Keterangan_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Grade_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Grade_Kebutuhan_Kayu_Item" id="Grade_Kebutuhan_Kayu_Item" class="form-control @error('Grade_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Grade_Kebutuhan_Kayu_Item',$KebutuhanKayu->Grade_Kebutuhan_Kayu_Item) }}">
                                        @error('Grade_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tebal_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Tebal_Kebutuhan_Kayu_Item" id="Tebal_Kebutuhan_Kayu_Item" class="form-control @error('Tebal_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Tebal_Kebutuhan_Kayu_Item',$KebutuhanKayu->Tebal_Kebutuhan_Kayu_Item) }}">
                                        @error('Tebal_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lebar_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Lebar_Kebutuhan_Kayu_Item" id="Lebar_Kebutuhan_Kayu_Item" class="form-control @error('Lebar_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Kayu_Item',$KebutuhanKayu->Lebar_Kebutuhan_Kayu_Item) }}">
                                        @error('Lebar_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Panjang_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Panjang_Kebutuhan_Kayu_Item" id="Panjang_Kebutuhan_Kayu_Item" class="form-control @error('Panjang_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Kayu_Item',$KebutuhanKayu->Panjang_Kebutuhan_Kayu_Item) }}">
                                        @error('Panjang_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity_Kebutuhan_Kayu_Item</label>
                                        <input type="text" name="Quantity_Kebutuhan_Kayu_Item" id="Quantity_Kebutuhan_Kayu_Item" class="form-control @error('Quantity_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Kayu_Item',$KebutuhanKayu->Quantity_Kebutuhan_Kayu_Item) }}">
                                        @error('Quantity_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Kayu</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" step="0.01" name="Harga_Kayu" class="form-control @error('Harga_Kayu') is-invalid @enderror"   value="{{ old('Harga_Kayu',$KebutuhanKayu->Harga_Kayu) }}">
                                            @error('Harga_Kayu')
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
