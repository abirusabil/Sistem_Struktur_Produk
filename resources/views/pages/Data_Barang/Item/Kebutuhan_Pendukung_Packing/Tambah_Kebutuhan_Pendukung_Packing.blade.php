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
                <h1>Kebutuhan Pendukung Packing Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Kebutuhan Pendukung Packing Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Kebutuhan_Packing_Item" method="POST">
                                    @csrf
                                    @for ($i = 0; $i < $Item->loop_count; $i++)
                                   
                                    <div class="d-flex">
                                        <input type="hidden" name="Item_Id[]" value="{{ $Item->id }}">
                                    {{-- <div class="form-group ml-2">
                                        <label>Kode Cutting</label>
                                        <input type="text" name="id[{{ $i }}]" id="id" class="form-control px-1 @error('id.'.$i) is-invalid @enderror" value="{{ old('id.'. $i) }}">
                                        @error('id.'.$i)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group ml-2">
                                        <label>Kode Cutting</label>
                                        <input type="text" name="id[{{ $i }}]" id="id" class="form-control px-1 @error('id') is-invalid @enderror" value="{{ old('id.'. $i) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>                            
                                    <div class="form-group ml-2 w-50">
                                        <label for="Pendukung_Packing_Id">Jenis Pendukung Packing</label>
                                        <select name="Pendukung_Packing_Id[{{ $i }}]" id="Pendukung_Packing_Id" class="form-control px-1">
                                            <option value="">Pilih Pendukung Packing</option>
                                            @foreach ($PendukungPacking as $pendukungpacking)
                                                <option value="{{ $pendukungpacking->id}}" {{ old('Pendukung_Packing_Id'.$i) == $pendukungpacking->id ? 'selected' : '' }}>{{ $pendukungpacking->Nama_Pendukung_Packing }} {{ $pendukungpacking->Tebal_Pendukung_Packing }} MM</option>
                                            @endforeach
                                            @error('Keterangan_Kebutuhan_Pendukung_Packing_Item.' . $i)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </select>     
                                    </div>
                                    
                                    <div class="form-group ml-2 w-25">
                                        <label>Keterangan</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Pendukung_Packing_Item[{{ $i }}]" id="Keterangan_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Keterangan_Kebutuhan_Pendukung_Packing_Item.' . $i) is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Pendukung_Packing_Item.' . $i) }}">
                                        @error('Keterangan_Kebutuhan_Pendukung_Packing_Item.' . $i)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Lebar</label>
                                        <input type="text" name="Lebar_Kebutuhan_Pendukung_Packing_Item[{{ $i }}]" id="Lebar_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Lebar_Kebutuhan_Pendukung_Packing_Item.' . $i) is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Pendukung_Packing_Item'.$i) }}">
                                        @error('Lebar_Kebutuhan_Pendukung_Packing_Item.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Panjang</label>
                                        <input type="text" name="Panjang_Kebutuhan_Pendukung_Packing_Item[{{ $i }}]" id="Panjang_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Panjang_Kebutuhan_Pendukung_Packing_Item.' . $i) is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Pendukung_Packing_Item'.$i) }}">
                                        @error('Panjang_Kebutuhan_Pendukung_Packing_Item.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Pendukung_Packing_Item[{{ $i }}]" id="Quantity_Kebutuhan_Pendukung_Packing_Item" class="form-control px-1 @error('Quantity_Kebutuhan_Pendukung_Packing_Item.' . $i) is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Pendukung_Packing_Item'.$i) }}">
                                        @error('Quantity_Kebutuhan_Pendukung_Packing_Item.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    @endfor
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
