@extends('layouts.app')

@section('title', 'Purchase Order')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Item Purchase Order Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $Detail_Purchase_Order->Job_Order }}">Detail Purchase Order</a></div>
                    <div class="breadcrumb-item">Ubah Item Purchase Order Baru</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/Detail_Purchase_Order/{{ $Detail_Purchase_Order->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="d-flex">
                                    <div class="form-group ">
                                        <input type="hidden" name="Job_Order" id="Job_Order" class="form-control @error('Job_Order') is-invalid @enderror" value="{{ $Detail_Purchase_Order->Job_Order }}">
                                    </div>
                                    <div class="form-group w-50 ">
                                        <label for="Item_Id">Item:</label>
                                        <select name="Item_Id" disabled="true" id="Item_Id" class="form-control">
                                            <option value="" >--Pilih Item--</option>
                                            @foreach ($Items as $Item)
                                            @if ( old('Item_Id',$Detail_Purchase_Order->Item_Id) == $Item->id )
                                                <option value="{{ $Item->id }}" selected>{{ $Item->Nama_Item }}</option>
                                            @else
                                                <option value="{{ $Item->id }}">{{ $Item->Nama_Item }}</option> 
                                            @endif
                                            @endforeach
                                        </select>     
                                    </div>
                                    <div class="form-group ml-3">
                                        <label>Quantity Purchase Order</label>
                                        <input type="number" name="Quantity_Purchase_Order" id="Quantity_Purchase_Order" class="form-control @error('Quantity_Purchase_Order') is-invalid @enderror" value="{{ old('Quantity_Purchase_Order',$Detail_Purchase_Order->Quantity_Purchase_Order) }}">
                                        @error('Quantity_Purchase_Order')
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
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index.js') }}"></script>
@endpush
