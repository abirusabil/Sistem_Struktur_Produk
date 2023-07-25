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
                    <input type="number" name="loop_count" max="100" id="loop_count">
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
                <h1>Detail Purchase Order </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item">Detail Purchase Order </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block pb-0">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col"><p> Job_Order</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->id }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p>Dasar_Po</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Dasar_Po }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p>Buyer</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Buyer->Nama_Buyer }}</h6></div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col"><p>Tanggal_Masuk</p></div>
                                            <div class="col px-0"><h6 class="pt-1"> : {{ $Purchase_Order->Tanggal_Masuk }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p>Schedule_Kirim</p></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Schedule_Kirim }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p>Status</p></div>
                                            <div class="col px-0 d-blok">
                                                <h6 class="pt-1">:
                                                    @if ($Purchase_Order->Status == 0)
                                                        <div class="badge badge-warning p-2 px-4">Belum Disetujui</div>
                                                    @else
                                                        <div class="badge badge-success p-2 px-3">Telah Disetujui</div>
                                                        
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row py-2">
                                        <div class="col">
                                            <div class="d-grid d-md-flex  ">
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <form action="/Purchase_Order/{{ $Purchase_Order->id }}/edit" method="POST">
                                                    @method('GET')
                                                    @csrf
                                                    <button class="btn mr-3 mt-2 rounded px-4 btn-warning "><i class="fa-regular fa-pen-to-square mr-2"></i>Edit Purchase Order</button>
                                                </form>
                                                {{-- <a href="/Purchase_Order/{{ $Purchase_Order->id }}/edit" class="btn mr-3 mt-2 rounded px-4 btn-warning ">Edit Purchase Order</a> --}}
                                                @endif
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    @if ($Purchase_Order->Status == 0)
                                                        <button data-target="#JumlahKolomForm" data-toggle="modal" class="btn mt-2 mr-3 rounded btn-primary px-4">
                                                            <i class="fa-solid fa-plus"></i>
                                                            Tambah Item Baru
                                                        </button>
                                                    @endif
                                                @endif
                                                <form action="/Purchase_Order/{{ $Purchase_Order->id }}/detailkebutuhan" method="POST">
                                                    @method('GET')
                                                    @csrf
                                                    <button class="btn mt-2 rounded btn-info px-4 mr-3"><i class="fa-solid fa-circle-info mr-2"></i>Detail Kebutuhan</button>
                                                </form>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    @if ($Purchase_Order->Status == 0)
                                                            <form action="/Purchase_Order/{{ $Purchase_Order->id }}/Edit_Status" method="POST">
                                                                @method('GET')
                                                                @csrf
                                                                <button class="btn mt-2 mr-3 rounded btn-success px-4" onclick="return confirm('Apakah Anda Yakin Untuk Menyetujui Po Ini ?')"><i class="fa-solid fa-file-contract mr-2"></i>Setujui PO ini</button>
                                                            </form>
                                                    @endif
                                                @endif
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    @if ($Purchase_Order->Status == 1)        
                                                        <form action="/Purchase_Order/{{ $Purchase_Order->id }}/Edit_Status" method="POST">
                                                            @method('GET')
                                                            @csrf
                                                            <button class="btn mt-2 mr-3 rounded btn-danger px-3" onclick="return confirm('Apakah Anda Yakin Untuk Mengubah Status Po Ini ?')"><i class="fa-regular fa-pen-to-square mr-2"></i>Ubah Status</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
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
                                        @if (session()->has('success_status'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_status') }}
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
                                                            <th class="border text-center">Item</th>
                                                            <th class="border text-center">Code</th>
                                                            <th class="border text-center">Qty</th>
                                                            <th class="border text-center">Keterangan</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                @if ($Purchase_Order->Status == 0)
                                                                    <th class="border text-center">Action</th>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($detailPurchaseOrders as $detailPurchaseOrder => $items) 
                                                            <tr class="border">
                                                                <td colspan="5">
                                                                    <h5 class="m-0">{{ $detailPurchaseOrder }}</h5>
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
                                                                        {{ number_format($item->Item->Panjang_Item ) }}
                                                                    </p>
                                                                    <p>Colour : <br>
                                                                        {{ $item->Item->Warna_Item  }}
                                                                    </p>
                                                                </td>
                                                                @if(in_array(auth()->user()->akses , [1]))
                                                                    @if ($Purchase_Order->Status == 0)
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
                                                                    @endif
                                                                @endif          
                                                            </tr>
                                                            @php
                                                                $totalQuantity += $item->Quantity_Purchase_Order;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td class="text-center border " colspan="3">
                                                                <h6 class="m-0">Total Item</h6>
                                                            </td>
                                                            <td class="border">
                                                                <h6 class="text-center m-0">{{ $totalQuantity }}</h6>
                                                            </td>
                                                            <td class="border" colspan="2"></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="col d-flex justify-content-end p-0">
                                            <a class="btn ml-3 mt-2 rounded px-5 btn-info ml-2" href="{{ route('purchase_order.exportToPDF', ['Purchase_Order' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Cetak Detail PO</a>
                                        </div> 
                                    </div>
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
