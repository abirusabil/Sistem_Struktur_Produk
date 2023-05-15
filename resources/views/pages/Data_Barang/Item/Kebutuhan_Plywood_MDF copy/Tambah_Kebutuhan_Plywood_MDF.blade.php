@extends('layouts.app')

@section('title', 'Kebutuhan Plywood MDF')

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
                <h1>Kebutuhan Plywood MDF Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Kebutuhan Plywood_MDF Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-responsive">
                            <div class="card-body">
                                <form action="/Kebutuhan_Plywood_MDF_Item" method="POST">
                                    @csrf
                                    @for ($i = 0; $i < $Item->loop_count; $i++)
                                   
                                    <div class="d-flex">
                                        <input type="hidden" name="Item_Id[]" value="{{ $Item->id }}">
                                    <div class="form-group ml-2">
                                        <label>Kode Cutting</label>
                                        <input type="text" name="id[]" id="id" class="form-control px-1 @error('id') is-invalid @enderror" value="{{ old('id'. $i) }}">
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2 w-50">
                                        <label for="Plywood_MDF_Id">Jenis Plywood_MDF</label>
                                        <select name="Plywood_MDF_Id[]" id="Plywood_MDF_Id" class="form-control px-1">
                                            <option value="">Pilih Plywood_MDF</option>
                                            @foreach ($PlywoodMDF as $Plywood_MDF)
                                                <option value="{{ $Plywood_MDF->id}}" {{ old('Plywood_MDF_Id'.$i) == $Plywood_MDF->id ? 'selected' : '' }}>{{ $Plywood_MDF->Nama_Plywood_MDF }} {{ $Plywood_MDF->Tebal_Plywood_MDF }} MM</option>
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>KP</label>
                                        <input type="text" name="KP_Kebutuhan_Plywood_MDF_Item[]" id="KP_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('KP_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('KP_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('KP_Kebutuhan_Plywood_MDF_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2 w-25">
                                        <label>Keterangan</label>
                                        <input type="text" name="Keterangan_Kebutuhan_Plywood_MDF_Item[]" id="Keterangan_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('Keterangan_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('Keterangan_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('Keterangan_Kebutuhan_Plywood_MDF_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Grade</label>
                                        <input type="text" name="Grade_Kebutuhan_Plywood_MDF_Item[]" id="Grade_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('Grade_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('Grade_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('Grade_Kebutuhan_Plywood_MDF_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Lebar</label>
                                        <input type="text" name="Lebar_Kebutuhan_Plywood_MDF_Item[]" id="Lebar_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('Lebar_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('Lebar_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('Lebar_Kebutuhan_Plywood_MDF_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Panjang</label>
                                        <input type="text" name="Panjang_Kebutuhan_Plywood_MDF_Item[]" id="Panjang_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('Panjang_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('Panjang_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('Panjang_Kebutuhan_Plywood_MDF_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ml-2">
                                        <label>Quantity</label>
                                        <input type="text" name="Quantity_Kebutuhan_Plywood_MDF_Item[]" id="Quantity_Kebutuhan_Plywood_MDF_Item" class="form-control px-1 @error('Quantity_Kebutuhan_Plywood_MDF_Item') is-invalid @enderror" value="{{ old('Quantity_Kebutuhan_Plywood_MDF_Item'.$i) }}">
                                        @error('Quantity_Kebutuhan_Plywood_MDF_Item')
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
