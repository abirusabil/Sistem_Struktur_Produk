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
                <h1>Edit Kebutuhan Komponen Finishing </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Edit Kebutuhan Komponen Finishing </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Kebutuhan_Finishing_Item/{{ $Kebutuhan_Komponen_Finishing_Item->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="Item_Id" value="{{ $Kebutuhan_Komponen_Finishing_Item->Item_Id }}">
                                    <div class="form-group">
                                        <label>Kode Cutting</label>
                                        <input readonly type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$Kebutuhan_Komponen_Finishing_Item->id) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Komponen_Finishing_Id">Komponen_Finishing:</label>
                                        <select name="Komponen_Finishing_Id" id="Komponen_Finishing_Id" class="form-control">
                                            <option value="">--Pilih Komponen_Finishing--</option>
                                            @foreach ($Komponen_Finishings as $Komponen_Finishing)
                                            @if ( old('Komponen_Finishing_Id',$Kebutuhan_Komponen_Finishing_Item->Komponen_Finishing_Id) == $Komponen_Finishing->id )
                                                <option value="{{ $Komponen_Finishing->id }}" selected>{{ $Komponen_Finishing->Nama_Komponen_Finishing }}</option>
                                            @else
                                                <option value="{{ $Komponen_Finishing->id }}">{{ $Komponen_Finishing->Nama_Komponen_Finishing }}</option> 
                                            @endif
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Komponen_Finishing_Item" id="Quantity_Kebutuhan_Komponen_Finishing_Item" class="form-control @error('Quantity_Kebutuhan_Komponen_Finishing_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Komponen_Finishing_Item',$Kebutuhan_Komponen_Finishing_Item->Quantity_Kebutuhan_Komponen_Finishing_Item) }}">
                                        @error('Quantity_Kebutuhan_Komponen_Finishing_Item')
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
