@extends('layouts.app')

@section('title', 'Kebutuhan Karton Box')

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
                <h1>Edit Kebutuhan Karton Box</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Item">Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item">List Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item/{{ $Kebutuhan_Karton_Box_Items->Item_Id  }}">Detail Item</a></div>
                    <div class="breadcrumb-item">Edit Kebutuhan Karton Box</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Kebutuhan_Karton_Box_Item/{{ $Kebutuhan_Karton_Box_Items->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                        <input type="hidden" name="Item_Id" value="{{ $Kebutuhan_Karton_Box_Items->Item_Id }}">
                                    <div class="form-group ml-2">
                                        <label>Kode Cutting</label>
                                        <input readonly type="text" name="id" id="id" class="form-control px-1 @error('id') is-invalid @enderror" value="{{ old('id',$Kebutuhan_Karton_Box_Items->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Jenis</label>
                                        <input type="text" name="Jenis_Kebutuhan_Karton_Box" id="Jenis_Kebutuhan_Karton_Box" class="form-control px-1 @error('Jenis_Kebutuhan_Karton_Box') is-invalid @enderror" value="{{ old('Jenis_Kebutuhan_Karton_Box',$Kebutuhan_Karton_Box_Items->Jenis_Kebutuhan_Karton_Box) }}">
                                        @error('Jenis_Kebutuhan_Karton_Box')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Keterangan</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Karton_Box_Item" id="Keterangan_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Keterangan_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Keterangan_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Keterangan_Kebutuhan_Karton_Box_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Tinggi</label>
                                        <input type="text" name="Tinggi_Kebutuhan_Karton_Box_Item" id="Tinggi_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Tinggi_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Tinggi_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Tinggi_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Tinggi_Kebutuhan_Karton_Box_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Lebar</label>
                                        <input type="text" name="Lebar_Kebutuhan_Karton_Box_Item" id="Lebar_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Lebar_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Lebar_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Lebar_Kebutuhan_Karton_Box_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Panjang</label>
                                        <input type="text" name="Panjang_Kebutuhan_Karton_Box_Item" id="Panjang_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Panjang_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Panjang_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Panjang_Kebutuhan_Karton_Box_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Karton_Box_Item" id="Quantity_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Quantity_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Quantity_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Quantity_Kebutuhan_Karton_Box_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Harga</label>
                                        <input type="text" name="Harga_Kebutuhan_Karton_Box_Item" id="Harga_Kebutuhan_Karton_Box_Item" class="form-control px-1 @error('Harga_Kebutuhan_Karton_Box_Item') is-invalid @enderror" value="{{ old('Harga_Kebutuhan_Karton_Box_Item',$Kebutuhan_Karton_Box_Items->Harga_Kebutuhan_Karton_Box_Item) }}">
                                        @error('Harga_Kebutuhan_Karton_Box_Item')
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
