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
                                {{-- <div class="row">
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
                                            <a href="{{ route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Purchase_Order->id]) }}">Detail Kebutuhan</a>
                                        </div>   
                                    </div> --}}
                                {{-- <hr class="border border-black opacity-100 "> --}}
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
                                        <h5>Kebutuhan Kayu </h5>
                                        <div class="table-responsive">
                                                    <table class="table table-hover" id="table-1">
                                                        <thead class="table-secondary">
                                                            <tr>
                                                                <th class="px-5">Nama_Item</th>
                                                                <th class="px-3">NO Cutting</th>
                                                                <th class="px-3">Material</th>
                                                                <th class="px-3">KP</th>
                                                                <th class="px-3">KTR</th>
                                                                <th class="px-3">KWT</th>
                                                                <th class="px-3">Bruto TBL+5</th>
                                                                <th class="px-3">Bruto LBR+10</th>
                                                                <th class="px-3">Bruto PNJG+5</th>
                                                                <th class="px-3">Netto Tebal</th>
                                                                <th class="px-3">Netto Lebar</th>
                                                                <th class="px-3">Netto Panjang</th>
                                                                <th class="px-3">Panjang Bruto</th>
                                                                <th class="px-3">Jumlah</th>
                                                                <th class="px-3">Qty Order</th>
                                                                <th class="px-3">Total Order</th>
                                                                <th class="px-3">Volume Bruto/M3</th>
                                                                <th class="px-3">Biaya /M3</th>
                                                                <th class="px-3">Total Biaya</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $total_biaya_kayu = 0;
                                                            @endphp
                                                            @foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder)
                                                                @foreach($detailPurchaseOrder->item->KebutuhanKayuItem as $kebutuhanKayuItem)
                                                                @php
                                                                    $tebal = $kebutuhanKayuItem->Tebal_Kebutuhan_Kayu_Item;
                                                                    $lebar = $kebutuhanKayuItem->Lebar_Kebutuhan_Kayu_Item;
                                                                    $panjang = $kebutuhanKayuItem->Panjang_Kebutuhan_Kayu_Item;
                                                                    $bruto_tebal = $tebal+5;
                                                                    $bruto_lebar = $lebar+10;
                                                                    $panjang_bruto = $panjang+20;
                                                                    $bruto_panjang = $panjang_bruto*1.1;
                                                                    $jumlah = $kebutuhanKayuItem->Quantity_Kebutuhan_Kayu_Item;
                                                                    $qty_order = $detailPurchaseOrder->Quantity_Purchase_Order;
                                                                    $total_order = $jumlah * $qty_order;
                                                                    $volume_bruto = $bruto_tebal * $bruto_lebar * $bruto_panjang * $total_order / 1000000000;
                                                                    $biaya_m3 =$kebutuhanKayuItem->masterkayu->Harga_Kayu;
                                                                    $total_biaya = $biaya_m3 * $volume_bruto;
                                                                    $total_biaya_kayu += $total_biaya ;
                                                                @endphp
                                                                    <tr>
                                                                        <td class="border border-black px-3">{{ $detailPurchaseOrder->item->Nama_Item }}</td>
                                                                        <td class="border border-black px-3">{{ $kebutuhanKayuItem->id }}</td>
                                                                        <td class="border border-black px-3">{{ $kebutuhanKayuItem->masterkayu->Nama_Kayu }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ $kebutuhanKayuItem->KP_Kebutuhan_Kayu_Item }}</td>
                                                                        <td class="border border-black px-3">{{ $kebutuhanKayuItem->Keterangan_Kebutuhan_Kayu_Item }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ $kebutuhanKayuItem->Grade_Kebutuhan_Kayu_Item }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ $bruto_tebal }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ $bruto_lebar }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($bruto_panjang,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($tebal,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($lebar,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($panjang,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($panjang_bruto,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ $total_order }}</td>
                                                                        <td class="border border-black px-3 text-center">{{ number_format($volume_bruto ,4,'.') }}</td>
                                                                        <td class="border border-black px-3">Rp. {{  number_format($biaya_m3,2,'.') }}</td>
                                                                        <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="18" class="text-center border border-black">TOTAL BIAYA KAYU : </td>
                                                                <td class="border border-black">Rp. {{ number_format($total_biaya_kayu,2,'.') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-footer text-right">
                                <div class="col d-flex flex-row-reverse">
                                    <button data-target="#JumlahKolomForm" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Item Baru
                                    </button>
                                </div>
                            </div> --}}
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
