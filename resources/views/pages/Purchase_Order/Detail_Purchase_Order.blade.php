@extends('layouts.app')

@section('title', 'Detail Purchase Order')

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

<div class="modal fade" id="JumlahKolomForm" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Item Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{ route('Detail_Purchase_Order.create') }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah item:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Purchase_Order->id }}">
                    <input type="hidden" name="buyer_id" value="{{ $Purchase_Order->Buyer_Id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
</div>


    
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Purchase Order </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Purchase Order</a></div>
                    <div class="breadcrumb-item">Detail Purchase Order </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block pb-0">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="row">
                                            <div class="col-4"><p> Job_Order</p></div>
                                            <div class="col px-0 "><h6 class="pt-1">: {{ $Purchase_Order->id }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4"><p>Dasar_Po</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Dasar_Po }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4"><p>Buyer</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Buyer->Nama_Buyer }}</h6></div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="row">
                                            <div class="col-4 px-0"><p>Tanggal_Masuk</p></div>
                                            <div class="col px-0"><h6 class="pt-1"> : {{ $Purchase_Order->Tanggal_Masuk }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 px-0"><p>Schedule_Kirim</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Schedule_Kirim }}</h6></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="/Purchase_Order/{{ $Purchase_Order->id }}/edit" class="btn ml-3 mt-2 rounded px-5 btn-warning ml-2">Edit</a>
                                        </div> 
                                        <div class="col d-flex justify-content-end mr-4">
                                            <a href="/Purchase_Order/{{ $Purchase_Order->id }}/edit" class="btn ml-3 mt-2 rounded px-5 btn-info ml-2">Detail Kebutuhan Bahan Baku</a>
                                        </div>   
                                    </div>
                                <hr class="border border-black opacity-100 ">
                            </div>
                            <div class="card-body mt-0 pt-0">
                                <div class="row">
                                    <div class="col">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                                <table class="table-striped table" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center border">
                                                                #
                                                            </th>
                                                            <th class="border">Item</th>
                                                            <th class="border">Code</th>
                                                            <th class="border">Qty</th>
                                                            <th class="border">Keterangan</th>
                                                            <th class="border">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($detailPurchaseOrders as $detailPurchaseOrder => $items) 
                                                            <tr class="border">
                                                                <td colspan="5">
                                                                    <h5>{{ $detailPurchaseOrder }}</h5>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $totalQuantity = 0;
                                                            @endphp
                                                        @foreach ($items as $item)
                                                            <tr>
                                                                <td class="border">
                                                                    <p class="text-center">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td class="border w-25">
                                                                    <p >{{ $item->Item->Nama_Item }}</p>
                                                                </td>
                                                                <td class="border">
                                                                    <p class="text-center">{{ $item->Item_Id }}</p>
                                                                </td>
                                                                <td class="border">
                                                                    <p class="text-center">{{ number_format($item->Quantity_Purchase_Order) }}</p>
                                                                </td>
                                                                <td class="border">
                                                                    <p class="mb-0">Dimension :<br>
                                                                        {{ number_format($item->Item->Tinggi_Item ) }} X 
                                                                        {{ number_format($item->Item->Lebar_Item ) }} X 
                                                                        {{ number_format($item->Item->Panjang_Item ) }} X 
                                                                    </p>
                                                                    <p>Colour : <br>
                                                                        {{ $item->Item->Warna_Item  }}
                                                                    </p>
                                                                </td>
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Detail_Purchase_Order/{{ $item->id }}/edit" class="btn btn-warning ml-2">Edit</a>
                                                                        <form action="/Detail_Purchase_Order/{{ $item->id }}" method="POST">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button class="btn btn-danger ml-2" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus?')">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </td>            
                                                            </tr>
                                                            @php
                                                                $totalQuantity += $item->Quantity_Purchase_Order;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td class="text-center border " colspan="3">
                                                                <h6>Total Item</h6>
                                                            </td>
                                                            <td class="border">
                                                                <h6 class="text-center">{{ $totalQuantity }}</h6>
                                                            </td>
                                                            <td class="border" colspan="2"></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="col d-flex flex-row-reverse">
                                    <button data-target="#JumlahKolomForm" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Item Baru
                                    </button>
                                </div>
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
