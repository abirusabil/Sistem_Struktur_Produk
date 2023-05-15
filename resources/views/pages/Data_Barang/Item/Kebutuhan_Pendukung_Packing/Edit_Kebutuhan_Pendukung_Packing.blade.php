@extends('layouts.app')

@section('title', 'Kebutuhan Pendukung Packing')

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
                <h1>Edit Kebutuhan Pendukung Packing</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pendukung Packing</a></div>
                    <div class="breadcrumb-item">Edit Kebutuhan Pendukung_Packing</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Kebutuhan_Packing_Item/{{ $Kebutuhan_Pendukung_Packing_Items->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                        <input type="hidden" name="Item_Id" value="{{ $Kebutuhan_Pendukung_Packing_Items->Item_Id }}">
                                    <div class="form-group ml-2">
                                        <label>Kode Cutting</label>
                                        <input readonly type="text" name="id" id="id" class="form-control px-1 @error('id') is-invalid @enderror" value="{{ old('id',$Kebutuhan_Pendukung_Packing_Items->id ) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2 ">
                                        <label for="Pendukung_Packing_Id">Jenis Pendukung_Packing</label>
                                        <select name="Pendukung_Packing_Id" id="Pendukung_Packing_Id" class="form-control px-1">
                                            <option value="">Pilih Pendukung Packing</option>
                                            @foreach ($PendukungPacking as $Pendukung_Packing)
                                            @if (old('Pendukung_Packing_Id',$Kebutuhan_Pendukung_Packing_Items->Pendukung_Packing_Id) == $Pendukung_Packing->id )
                                            <option value="{{ $Pendukung_Packing->id}}" selected>{{ $Pendukung_Packing->Nama_Pendukung_Packing }} {{ $Pendukung_Packing->Tebal_Pendukung_Packing }} MM</option>
                                            @else
                                            <option value="{{ $Pendukung_Packing->id}}">{{ $Pendukung_Packing->Nama_Pendukung_Packing }} {{ $Pendukung_Packing->Tebal_Pendukung_Packing }} MM</option>
                                            @endif
                                                
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Keterangan</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Pendukung_Packing_Item" id="Keterangan_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Keterangan_Kebutuhan_Pendukung_Packing_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Pendukung_Packing_Item',$Kebutuhan_Pendukung_Packing_Items->Keterangan_Kebutuhan_Pendukung_Packing_Item) }}">
                                        @error('Keterangan_Kebutuhan_Pendukung_Packing_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Lebar</label>
                                        <input type="text" name="Lebar_Kebutuhan_Pendukung_Packing_Item" id="Lebar_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Lebar_Kebutuhan_Pendukung_Packing_Item') is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Pendukung_Packing_Item',$Kebutuhan_Pendukung_Packing_Items->Lebar_Kebutuhan_Pendukung_Packing_Item) }}">
                                        @error('Lebar_Kebutuhan_Pendukung_Packing_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Panjang</label>
                                        <input type="text" name="Panjang_Kebutuhan_Pendukung_Packing_Item" id="Panjang_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Panjang_Kebutuhan_Pendukung_Packing_Item') is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Pendukung_Packing_Item',$Kebutuhan_Pendukung_Packing_Items->Panjang_Kebutuhan_Pendukung_Packing_Item) }}">
                                        @error('Panjang_Kebutuhan_Pendukung_Packing_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Pendukung_Packing_Item" id="Quantity_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Quantity_Kebutuhan_Pendukung_Packing_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Pendukung_Packing_Item',$Kebutuhan_Pendukung_Packing_Items->Quantity_Kebutuhan_Pendukung_Packing_Item) }}">
                                        @error('Quantity_Kebutuhan_Pendukung_Packing_Item')
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
