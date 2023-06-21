@extends('layouts.app')

@section('title', 'Kebutuhan Kayu')

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
                <h1>Edit Kebutuhan Kayu </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Item">Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item">List Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item/{{ $Kebutuhan_Kayu_Item->Item_Id  }}">Detail Item</a></div>
                    <div class="breadcrumb-item">Edit Kebutuhan Kayu </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kebutuhan_Kayu_Item/{{ $Kebutuhan_Kayu_Item->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="Item_Id" value="{{ $Kebutuhan_Kayu_Item->Item_Id }}">
                                    <div class="form-group">
                                        <label>Kode Cutting</label>
                                        <input readonly type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$Kebutuhan_Kayu_Item->id) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Kayu_Id">Kayu:</label>
                                        <select name="Kayu_Id" id="Kayu_Id" class="form-control">
                                            <option value="">--Pilih Kayu--</option>
                                            @foreach ($kayus as $kayu)
                                            @if ( old('Kayu_Id',$Kebutuhan_Kayu_Item->Kayu_Id) == $kayu->id )
                                                <option value="{{ $kayu->id }}" selected>{{ $kayu->Nama_Kayu }}</option>
                                            @else
                                                <option value="{{ $kayu->id }}">{{ $kayu->Nama_Kayu }}</option> 
                                            @endif
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group">
                                        <label>KP</label>
                                        <input type="text" name="KP_Kebutuhan_Kayu_Item" id="KP_Kebutuhan_Kayu_Item" class="form-control @error('KP_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('KP_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->KP_Kebutuhan_Kayu_Item) }}">
                                        @error('KP_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Kayu_Item" id="Keterangan_Kebutuhan_Kayu_Item" class="form-control @error('Keterangan_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Keterangan_Kebutuhan_Kayu_Item) }}">
                                        @error('Keterangan_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Grade</label>
                                        <input type="text" name="Grade_Kebutuhan_Kayu_Item" id="Grade_Kebutuhan_Kayu_Item" class="form-control @error('Grade_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Grade_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Grade_Kebutuhan_Kayu_Item) }}">
                                        @error('Grade_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tebal</label>
                                        <input type="text" name="Tebal_Kebutuhan_Kayu_Item" id="Tebal_Kebutuhan_Kayu_Item" class="form-control @error('Tebal_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Tebal_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Tebal_Kebutuhan_Kayu_Item) }}">
                                        @error('Tebal_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lebar</label>
                                        <input type="text" name="Lebar_Kebutuhan_Kayu_Item" id="Lebar_Kebutuhan_Kayu_Item" class="form-control @error('Lebar_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Lebar_Kebutuhan_Kayu_Item) }}">
                                        @error('Lebar_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Panjang</label>
                                        <input type="text" name="Panjang_Kebutuhan_Kayu_Item" id="Panjang_Kebutuhan_Kayu_Item" class="form-control @error('Panjang_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Panjang_Kebutuhan_Kayu_Item) }}">
                                        @error('Panjang_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Kayu_Item" id="Quantity_Kebutuhan_Kayu_Item" class="form-control @error('Quantity_Kebutuhan_Kayu_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Kayu_Item',$Kebutuhan_Kayu_Item->Quantity_Kebutuhan_Kayu_Item) }}">
                                        @error('Quantity_Kebutuhan_Kayu_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
