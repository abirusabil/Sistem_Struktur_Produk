@extends('layouts.app')

@section('title', 'Edit Item')

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
                <h1>Edit Item</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Item">Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item">List Item</a></div>
                    <div class="breadcrumb-item active"><a href="/Item/{{ $Item->id }}">Detail Item</a></div>
                    <div class="breadcrumb-item">Edit Item</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Item/{{ $Item->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Item</label>
                                        <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id',$Item->id) }}" readonly>
                                        @error('id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Item</label>
                                        <input type="text" name="Nama_Item" id="Nama_Item" class="form-control @error('Nama_Item') is-invalid @enderror" value="{{ old('Nama_Item',$Item->Nama_Item) }}">
                                        @error('Nama_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tinggi Item</label>
                                        <input type="number" name="Tinggi_Item" id="Tinggi_Item" class="form-control @error('Tinggi_Item') is-invalid @enderror" value="{{ old('Tinggi_Item',$Item->Tinggi_Item) }}">
                                        @error('Tinggi_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lebar Item</label>
                                        <input type="number" name="Lebar_Item" id="Lebar_Item" class="form-control @error('Lebar_Item') is-invalid @enderror" value="{{ old('Lebar_Item',$Item->Lebar_Item) }}">
                                        @error('Lebar_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Panjang Item</label>
                                        <input type="number" name="Panjang_Item" id="Panjang_Item" class="form-control @error('Panjang_Item') is-invalid @enderror" value="{{ old('Panjang_Item',$Item->Panjang_Item) }}">
                                        @error('Panjang_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Berat Item</label>
                                        <input type="number" name="Berat_Item" id="Berat_Item" class="form-control @error('Berat_Item') is-invalid @enderror" value="{{ old('Berat_Item',$Item->Berat_Item) }}">
                                        @error('Berat_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Warna Item</label>
                                        <input type="text" name="Warna_Item" id="Warna_Item" class="form-control @error('Warna_Item') is-invalid @enderror" value="{{ old('Warna_Item',$Item->Warna_Item) }}">
                                        @error('Warna_Item')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Collection_Id">Collection:</label>
                                        <select name="Collection_Id" id="Collection_Id" class="form-control">
                                            <option value="">--Pilih Collection--</option>
                                            @foreach ($collections as $collection)
                                            @if ( old('Collection_Id' , $Item->Collection_Id) == $collection->id)
                                                <option value="{{ $collection->id }} " selected>{{ $collection->Nama_Collection }}</option>
                                            @else
                                                <option value="{{ $collection->id }}">{{ $collection->Nama_Collection }}</option>
                                            @endif   
                                            @endforeach
                                        </select>     
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
