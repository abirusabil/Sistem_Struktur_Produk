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
                <h1>Kebutuhan PO : {{ $Purchase_Order->Dasar_Po }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item active"><a href="/Purchase_Order/{{ $Purchase_Order->id }}">Detail Purchase order</a></div>
                    <div class="breadcrumb-item">Detail Kebutuhan Purchase Order </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body ">
                                {{-- Kebutuhan Kayu --}}
                                <div class="KebutuhanKayu py-2">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_kayu'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_kayu') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                                <h5>Kebutuhan Kayu </h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="table-1">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th class="px-3">No</th>
                                                            <th class="px-5">Nama_Item</th>
                                                            <th class="px-3">NO Cutting</th>
                                                            <th class="px-3">Kode Material</th>
                                                            <th class="px-3">Material</th>
                                                            <th class="px-3">KP</th>
                                                            <th class="px-3">Keterangan</th>
                                                            <th class="px-3">KWT</th>
                                                            <th class="px-3">Bruto TBL+5</th>
                                                            <th class="px-3">Bruto LBR+10%</th>
                                                            <th class="px-3">Bruto PNJG+5</th>
                                                            <th class="px-3">Netto Tebal</th>
                                                            <th class="px-3">Netto Lebar</th>
                                                            <th class="px-3">Netto Panjang</th>
                                                            <th class="px-3">Panjang Bruto</th>
                                                            <th class="px-3">Jumlah</th>
                                                            <th class="px-3">Qty Order</th>
                                                            <th class="px-3">Total Order</th>
                                                            <th class="px-3">Volume Bruto/M3</th>
                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                <th class="px-3">Biaya /M3</th>
                                                                <th class="px-3">Total Biaya</th>
                                                            @endif
                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                <th class="px-3">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_biaya_kayu = 0;
                                                        @endphp
                                                            @foreach($DetailKebutuhanKayuPo as $kebutuhanKayuItem)
                                                            @php
                                                                
                                                                $tebal = $kebutuhanKayuItem->Tebal_Kebutuhan_Kayu_Item;
                                                                $lebar = $kebutuhanKayuItem->Lebar_Kebutuhan_Kayu_Item;
                                                                $panjang = $kebutuhanKayuItem->Panjang_Kebutuhan_Kayu_Item;
                                                                $bruto_tebal = $tebal+5;
                                                                $bruto_lebar = $lebar+10;
                                                                $panjang_bruto = $panjang+20;
                                                                $bruto_panjang = $panjang_bruto*1.1;
                                                                $jumlah = $kebutuhanKayuItem->Quantity_Kebutuhan_Kayu_Item;
                                                                $qty_order = $kebutuhanKayuItem->Quantity_Purchase_Order;
                                                                $total_order = $jumlah * $qty_order;
                                                                $volume_bruto = $bruto_tebal * $bruto_lebar * $bruto_panjang * $total_order / 1000000000;
                                                                $biaya_m3 =$kebutuhanKayuItem->Harga_Kayu;
                                                                $total_biaya = $biaya_m3 * $volume_bruto;
                                                                $total_biaya_kayu += $total_biaya ;
                                                            @endphp
                                                                <tr>
                                                                    <td class="border border-black px-1 text-center">{{ $loop->iteration; }}</td>
                                                                    <td class="border border-black px-3">{{ $kebutuhanKayuItem->Nama_Item }}</td>
                                                                    <td class="border border-black px-3">{{ $kebutuhanKayuItem->No_Cutting }}</td>
                                                                    <td class="border border-black px-3">{{ $kebutuhanKayuItem->Kayu_Id }}</td>
                                                                    <td class="border border-black px-3">{{ $kebutuhanKayuItem->Nama_Kayu }}</td>
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
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td class="border border-black px-3">
                                                                            Rp. {{ number_format($biaya_m3, 2, '.') }}
                                                                        </td>
                                                                        <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <td class="border border-black px-3">
                                                                            <a href="/Kebutuhan_Kayu/{{ $kebutuhanKayuItem->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                        </td>
                                                                    @endif
                                                                    
                                                                </tr>
                                                        @endforeach
                                                        <tr> 
                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                <td colspan="20" class="text-center border border-black">TOTAL BIAYA KAYU : </td>
                                                                <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_kayu,2,'.') }}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Kayu_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Kayu --}}
                                {{-- Kebutuhan Plywood MDF --}}
                                <div class="KebutuhanMDF pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_plywood_mdf'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_plywood_mdf') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Plywood MDF </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-3">No</th>
                                                                    <th class="px-5">Nama_Item</th>
                                                                    <th class="px-3">NO Cutting</th>
                                                                    <th class="px-3">Kode Material</th>
                                                                    <th class="px-3">Material</th>
                                                                    <th class="px-3">KP</th>
                                                                    <th class="px-3">Keterangan</th>
                                                                    <th class="px-3">KWT</th>
                                                                    <th class="px-3">Tebal</th>
                                                                    <th class="px-3">Lebar</th>
                                                                    <th class="px-3">Panjang</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    <th class="px-3">Luas M2</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <th class="px-3">Biaya /M2</th>
                                                                        <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <th class="px-3">Action</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_mdf = 0;
                                                                @endphp
                                                                    @foreach($DetailKebutuhanPlywoodMdfPo as $kebutuhanplywoodmdfitem)
                                                                    @php
                                                                        $tebal = $kebutuhanplywoodmdfitem->Tebal_Plywood_MDF;
                                                                        $lebar = $kebutuhanplywoodmdfitem->Lebar_Kebutuhan_Plywood_MDF_Item;
                                                                        $panjang = $kebutuhanplywoodmdfitem->Panjang_Kebutuhan_Plywood_MDF_Item;
                                                                        $jumlah = $kebutuhanplywoodmdfitem->Quantity_Kebutuhan_Plywood_MDF_Item;
                                                                        $qty_order = $kebutuhanplywoodmdfitem->Quantity_Purchase_Order;
                                                                        $total_order = $jumlah * $qty_order;
                                                                        $luas = $panjang * $lebar * $total_order /1000000;
                                                                        $luas_lembar_plywood_mdf = $kebutuhanplywoodmdfitem->Luas_Plywood_MDF;
                                                                        $biaya_lembar = $kebutuhanplywoodmdfitem->Harga_Plywood_MDF  ;
                                                                        $biaya_m2 = $biaya_lembar / $luas_lembar_plywood_mdf * 1.2;
                                                                        $total_biaya = $biaya_m2 * $luas ;
                                                                        $total_biaya_mdf += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class="border border-black px-1 text-center">{{ $loop->iteration; }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->Nama_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->Plywood_MDF_Id }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->Nama_Plywood_MDF }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $kebutuhanplywoodmdfitem->KP_Kebutuhan_Plywood_MDF_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->Keterangan_Kebutuhan_Plywood_MDF_Item }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $kebutuhanplywoodmdfitem->Grade_Kebutuhan_Plywood_MDF_Item }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($tebal,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($lebar,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($panjang,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $total_order }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($luas ,4,'.') }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($biaya_m2, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border border-black px-3">
                                                                                    <a href="/Kebutuhan_Plywood_MDF/{{ $kebutuhanplywoodmdfitem->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                <tr> 
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td colspan="16" class="text-center border border-black">TOTAL BIAYA PLYWOOD MDF : </td>
                                                                        <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_mdf,2,'.') }}</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Plywood_MDF_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Plywood MDF --}}

                                {{-- Kebutuhan Accessories Hardware --}}
                                <div class="KebutuhanAccessoriesHardware pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_accessories_hardware'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_accessories_hardware') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Accessories Hardware </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-3">No</th>
                                                                    <th class="px-5">Nama_Item</th>
                                                                    <th class="px-3">NO Cutting</th>
                                                                    <th class="px-3">Kode Material</th>
                                                                    <th class="px-3">Material</th>
                                                                    <th class="px-3">Keterangan</th>
                                                                    <th class="px-3">Ukuran</th>
                                                                    <th class="px-3">Satuan</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <th class="px-3">Biaya Satuan</th>
                                                                        <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <th class="px-3">Action</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_accessories = 0;
                                                                @endphp
                                                                    @foreach($DetailKebutuhanAccessoriesHardwarePo as $KebutuhanAccessoriesHardwarePo)
                                                                    @php
                                                                        $jumlah = $KebutuhanAccessoriesHardwarePo->Quantity_Kebutuhan_Accessories_Hardware_Item;
                                                                        $qty_order = $KebutuhanAccessoriesHardwarePo->Quantity_Purchase_Order;
                                                                        $total_order = $jumlah * $qty_order;
                                                                        $harga_satuan = $KebutuhanAccessoriesHardwarePo->Harga_Accessories_Hardware;
                                                                        $total_biaya = $total_order *$harga_satuan ;
                                                                        $total_biaya_accessories += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->Nama_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->Accessories_Hardware_Id }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->Nama_Accessories_Hardware }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanAccessoriesHardwarePo->Keterangan_Kebutuhan_Accessories_Hardware_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->Ukuran_Accessories_Hardware }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanAccessoriesHardwarePo->Satuan_Accessories_Hardware }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $total_order }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($harga_satuan, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border border-black px-3">
                                                                                    <a href="/Kebutuhan_Accessories_Hardware/{{ $KebutuhanAccessoriesHardwarePo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                <tr> 
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td colspan="12" class="text-center border border-black">TOTAL BIAYA ACCESSORIES HARDWARE : </td>
                                                                        <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_accessories,2,'.') }}</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Accessories_Hardware_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Accessories Hardware --}}

                                {{-- Kebutuhan Komponen Finishing --}}
                                <div class="KebutuhanKomponenFinishing pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_komponen_finishing'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_komponen_finishing') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Komponen Finishing </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-3">No</th>
                                                                    <th class="px-5">Nama_Item</th>
                                                                    <th class="px-3">NO Cutting</th>
                                                                    <th class="px-3">Kode Material</th>
                                                                    <th class="px-3">Material</th>
                                                                    <th class="px-3">Satuan</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <th class="px-3">Biaya Satuan</th>
                                                                        <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <th class="px-3">Action</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_komponen_finishing = 0;
                                                                @endphp
                                                                    @foreach($DetailKebutuhanKomponenFinishingPo as $KebutuhanKomponenFinishingPo)
                                                                    @php
                                                                        $jumlah = $KebutuhanKomponenFinishingPo->Quantity_Kebutuhan_Komponen_Finishing_Item;
                                                                        $qty_order = $KebutuhanKomponenFinishingPo->Quantity_Purchase_Order;
                                                                        $total_order = $jumlah * $qty_order;
                                                                        $harga_satuan = $KebutuhanKomponenFinishingPo->Harga_Komponen_Finishing / $KebutuhanKomponenFinishingPo->Quantity_Komponen_Finishing;
                                                                        $total_biaya = $total_order *$harga_satuan ;
                                                                        $total_biaya_komponen_finishing += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKomponenFinishingPo->Nama_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKomponenFinishingPo->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKomponenFinishingPo->Komponen_Finishing_Id }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKomponenFinishingPo->Nama_Komponen_Finishing }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanKomponenFinishingPo->Satuan_Komponen_Finishing }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,4) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($total_order,4) }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($harga_satuan, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border border-black px-3">
                                                                                    <a href="/Kebutuhan_Komponen_Finishing/{{ $KebutuhanKomponenFinishingPo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                <tr> 
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td colspan="10" class="text-center border border-black">TOTAL BIAYA ACCESSORIES HARDWARE : </td>
                                                                        <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_komponen_finishing,2,'.') }}</td>
                                                                        
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Komponen_Finishing_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Komponen Finishing --}}

                                {{-- Kebutuhan Pendukung Packing --}}
                                <div class="KebutuhanPendukungPacking pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_pendukung_packing'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_pendukung_packing') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Pendukung Packing </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>

                                                                    <th class="px-3">No</th>
                                                                    <th class="px-5">Nama_Item</th>
                                                                    <th class="px-3">NO Cutting</th>
                                                                    <th class="px-3">Kode Material</th>
                                                                    <th class="px-3">Material</th>
                                                                    <th class="px-3">Keterangan</th>
                                                                    <th class="px-3">Satuan</th>
                                                                    <th class="px-3">Tebal</th>
                                                                    <th class="px-3">Lebar</th>
                                                                    <th class="px-3">Panjang</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    <th class="px-3">Total Order M2</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <th class="px-3">Biaya Satuan</th>
                                                                        <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <th class="px-3">Action</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_pendukung_packing = 0;
                                                                @endphp
                                                                    @foreach($DetailKebutuhanPendukungPackingPo as $KebutuhanPendukungPackingPo)
                                                                    @php
                                                                        $jumlah = $KebutuhanPendukungPackingPo->Quantity_Kebutuhan_Pendukung_Packing_Item;
                                                                        $luas = $KebutuhanPendukungPackingPo->Luas_Pendukung_Packing;
                                                                        $qty_order = $KebutuhanPendukungPackingPo->Quantity_Purchase_Order;
                                                                        $total_biaya = $total_order * $harga_satuan ;
                                                                        $tebal = $KebutuhanPendukungPackingPo->Tebal_Pendukung_Packing;
                                                                        $lebar = $KebutuhanPendukungPackingPo->Lebar_Kebutuhan_Pendukung_Packing_Item;
                                                                        $panjang = $KebutuhanPendukungPackingPo->Panjang_Kebutuhan_Pendukung_Packing_Item;
                                                                        $total_order = $jumlah * $qty_order ;
                                                                        $satuan = $KebutuhanPendukungPackingPo->Satuan_Pendukung_Packing;
                                                                        if ( $satuan == "Pcs") {
                                                                            $harga_satuan = $KebutuhanPendukungPackingPo->Harga_Pendukung_Packing;
                                                                            $Total_Order_M2 = "-";
                                                                            $total_biaya = $total_order * $harga_satuan ;
                                                                        } else {
                                                                            $harga_satuan = $KebutuhanPendukungPackingPo->Harga_Pendukung_Packing / $KebutuhanPendukungPackingPo->Luas_Pendukung_Packing;
                                                                            $Total = $total_order * $lebar * $panjang/1000000;
                                                                            $Total_Order_M2 = number_format($Total,4);
                                                                            $total_biaya = $Total * $harga_satuan ;
                                                                        }
                                                                        $total_biaya_pendukung_packing += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Nama_Item }} </td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Pendukung_Packing_Id }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Nama_Pendukung_Packing }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Keterangan_Kebutuhan_Pendukung_Packing_Item }}</td></td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanPendukungPackingPo->Satuan_Pendukung_Packing }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($tebal,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{number_format($lebar,0)}}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($panjang,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($total_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $Total_Order_M2 }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($harga_satuan, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border border-black px-3">
                                                                                    <a href="/Kebutuhan_Pendukung_Packing/{{ $KebutuhanPendukungPackingPo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                <tr> 
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td colspan="15" class="text-center border border-black">TOTAL BIAYA PENDUKUNG PACKING : </td>
                                                                        <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_pendukung_packing,2,'.') }}</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Pendukung_Packing_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Pendukung Packing --}}

                                {{-- Kebutuhan karton Box --}}
                                <div class="KebutuhanKartonBox pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_karton_box'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_karton_box') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Karton Box </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-3">No</th>
                                                                    <th class="px-5">Nama_Item</th>
                                                                    <th class="px-3">NO Cutting</th>
                                                                    <th class="px-3">Material</th>
                                                                    <th class="px-3">Keterangan</th>
                                                                    <th class="px-3">Tinggi</th>
                                                                    <th class="px-3">Lebar</th>
                                                                    <th class="px-3">Panjang</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <th class="px-3">Biaya Satuan</th>
                                                                        <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                        <th class="px-3">Action</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_karton_box = 0;
                                                                @endphp
                                                                    @foreach($DetailKebutuhanKartonBoxPo as $KebutuhanKartonBoxPo)
                                                                    @php
                                                                        $jumlah = $KebutuhanKartonBoxPo->Quantity_Kebutuhan_Karton_Box_Item;
                                                                        $qty_order = $KebutuhanKartonBoxPo->Quantity_Purchase_Order;
                                                                        $total_order = $jumlah * $qty_order;
                                                                        $harga_satuan = $KebutuhanKartonBoxPo->Harga_Kebutuhan_Karton_Box_Item;
                                                                        $total_biaya = $total_order *$harga_satuan ;
                                                                        $total_biaya_karton_box += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKartonBoxPo->Nama_Item }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKartonBoxPo->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKartonBoxPo->Jenis_Kebutuhan_Karton_Box }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanKartonBoxPo->Keterangan_Kebutuhan_Karton_Box_Item }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($KebutuhanKartonBoxPo->Tinggi_Kebutuhan_Karton_Box_Item,0)  }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($KebutuhanKartonBoxPo->Lebar_Kebutuhan_Karton_Box_Item,0)  }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($KebutuhanKartonBoxPo->Panjang_Kebutuhan_Karton_Box_Item,0)  }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($total_order,0) }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($harga_satuan, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border border-black px-3">
                                                                                    <a href="/Kebutuhan_Karton_Box/{{ $KebutuhanKartonBoxPo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                <tr> 
                                                                    @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                                                        <td colspan="12" class="text-center border border-black">TOTAL BIAYA KARTON BOX : </td>
                                                                        <td colspan="2" class="border border-black">Rp. {{ number_format($total_biaya_karton_box,2,'.') }}</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col d-flex justify-content-end p-0 mt-3">
                                                <a class="btn ml-3 mt-2 rounded px-5 btn-info" href="{{ route('Kebutuhan_Karton_Box_Po.export', ['JobOrder' => $Purchase_Order->id]) }}"><i class="fa-solid fa-print mr-2"></i>Print</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Karton Box --}}

                                {{-- Biaya Borongan Dalam --}}


                                <div class="BiayaBoronganDalam pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_borongan_dalam'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_borongan_dalam') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Biaya Borongan Dalam </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="border text-center"rowspan="2" >NO</th>
                                                                    <th class="border text-center" rowspan="2">Nama_Item</th>
                                                                    <th class="border text-center" colspan="3">BAHAN 1</th>
                                                                    <th class="border text-center" colspan="3">BAHAN 2</th>
                                                                    <th class="border text-center" colspan="3">SANDING 1</th>
                                                                    <th class="border text-center" colspan="3">SANDING 2</th>
                                                                    <th class="border text-center" colspan="3">PROSES ASSEMBLING</th>
                                                                    <th class="border text-center" colspan="3">FINISHING</th>
                                                                    <th class="border text-center" colspan="3">PACKING</th>
                                                                    <th class="border text-center" rowspan="2">Total Ongkos / Item</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                    <th class="border text-center" rowspan="2">Action</th>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    @php
                                                                        $t_ongkos_borongan_dalam = 0;
                                                                    @endphp
                                                                    @foreach($DetailBoronganDalamPo as $BoronganDalamPo)
                                                                    @php
                                                                        $qty = $BoronganDalamPo->Quantity_Purchase_Order;
                                                                        $Bahan_1 = $BoronganDalamPo->Bahan_1;
                                                                        $t_Bahan_1 =  $qty * $Bahan_1;
                                                                        $Bahan_2 = $BoronganDalamPo->Bahan_2;
                                                                        $t_Bahan_2 =  $qty * $Bahan_2;
                                                                        $Sanding_1 = $BoronganDalamPo->Sanding_1;
                                                                        $t_Sanding_1 =  $qty * $Sanding_1;
                                                                        $Sanding_2 = $BoronganDalamPo->Sanding_2;
                                                                        $t_Sanding_2 =  $qty * $Sanding_2;
                                                                        $Proses_Assembling = $BoronganDalamPo->Proses_Assembling;
                                                                        $t_Proses_Assembling =  $qty * $Proses_Assembling;
                                                                        $Finishing = $BoronganDalamPo->Finishing;
                                                                        $t_Finishing =  $qty * $Finishing;
                                                                        $Packing = $BoronganDalamPo->Packing;
                                                                        $t_Packing =  $qty * $Packing;
                                                                        $t_ongkos_item = $t_Bahan_1 + $t_Bahan_2 +  $t_Sanding_1 + $t_Sanding_2 + $t_Proses_Assembling +  $t_Finishing + $t_Packing;
                                                                        $t_ongkos_borongan_dalam += $t_ongkos_item;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class="border border-black px-3 text-center">
                                                                                {{ $loop->iteration}}</td>
                                                                            <td class="border border-black px-3">{{ $BoronganDalamPo->Nama_Item }}</td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Bahan_1,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Bahan_1,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Bahan_2,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Bahan_2,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Sanding_1,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Sanding_1,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Sanding_2,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Sanding_2,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Proses_Assembling,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Proses_Assembling,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Finishing,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Finishing,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Packing,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Packing,2,'.')}}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_ongkos_item,2,'.')}}
                                                                            </td>
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border">
                                                                                    <a href="/Borongan_Dalam_Po/{{ $BoronganDalamPo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                            
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr>
                                                                        <td class="text-center border" colspan="23"><h6>Total :</h6>  </td>
                                                                        <td colspan="2" class="border">Rp.
                                                                            {{ number_format($t_ongkos_borongan_dalam,2,'.')}}
                                                                        </td>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- End Biaya Borongan Dalam --}}

                                {{-- Biaya Borongan Luar --}}
                                <div class="BiayaBoronganluar pt-5">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_borongan_luar'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_borongan_luar') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5> Biaya Borongan Luar </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="border text-center"rowspan="2" >NO</th>
                                                                    <th class="border text-center" rowspan="2">Nama_Item</th>
                                                                    <th class="border text-center" colspan="3">Anyam</th>
                                                                    <th class="border text-center" colspan="3">Ukir</th>
                                                                    <th class="border text-center" colspan="3">Handle</th>
                                                                    <th class="border text-center" colspan="3">Bubut</th>
                                                                    <th class="border text-center" colspan="3">Pirelly_Jok</th>
                                                                    <th class="border text-center" colspan="3">Sterofoam</th>
                                                                    <th class="border text-center" rowspan="2">Total Ongkos / Item</th>
                                                                    @if(in_array(auth()->user()->akses , [1,2]))
                                                                    <th class="border text-center" rowspan="2">Action</th>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    <th class="border text-center">Biaya Satuan</th>
                                                                    <th class="border text-center">Quantity Order</th>
                                                                    <th class="border text-center">Total Biaya</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    @php
                                                                        $t_ongkos_borongan_luar = 0;
                                                                    @endphp
                                                                    @foreach($DetailBoronganLuarPo as $BoronganLuarPo)
                                                                    @php
                                                                        $qty = $BoronganLuarPo->Quantity_Purchase_Order;
                                                                        $Anyam = $BoronganLuarPo->Anyam;
                                                                        $t_Anyam =  $qty * $Anyam;
                                                                        $Ukir = $BoronganLuarPo->Ukir;
                                                                        $t_Ukir =  $qty * $Ukir;
                                                                        $Handle = $BoronganLuarPo->Handle;
                                                                        $t_Handle =  $qty * $Handle;
                                                                        $Bubut = $BoronganLuarPo->Bubut;
                                                                        $t_Bubut =  $qty * $Bubut;
                                                                        $Pirelly_Jok = $BoronganLuarPo->Pirelly_Jok;
                                                                        $t_Pirelly_Jok =  $qty * $Pirelly_Jok;
                                                                        $Sterofoam = $BoronganLuarPo->Sterofoam;
                                                                        $t_Sterofoam =  $qty * $Sterofoam;
                                                                        $t_ongkos_item = $t_Anyam + $t_Ukir +  $t_Handle + $t_Bubut + $t_Pirelly_Jok +  $t_Sterofoam + $t_Packing;
                                                                        $t_ongkos_borongan_luar += $t_ongkos_item;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class="border border-black px-3 text-center">
                                                                                {{ $loop->iteration}}</td>
                                                                            <td class="border border-black px-3">{{ $BoronganLuarPo->Nama_Item }}</td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Anyam,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Anyam,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Ukir,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Ukir,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Handle,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Handle,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Bubut,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Bubut,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Pirelly_Jok,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Pirelly_Jok,2,'.')}}
                                                                            </td>
                                                                            <td class="border">
                                                                                Rp. {{ number_format($Sterofoam,2) }}
                                                                            </td>
                                                                            <td class="border text-center">
                                                                                {{ number_format($qty,0) }}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_Sterofoam,2,'.')}}
                                                                            </td>
                                                                            <td class="border">Rp.
                                                                                {{ number_format($t_ongkos_item,2,'.')}}
                                                                            </td>
                                                                            @if(in_array(auth()->user()->akses , [1,2]))
                                                                                <td class="border">
                                                                                    <a href="/Borongan_Luar_Po/{{ $BoronganLuarPo->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr>
                                                                        <td class="text-center border" colspan="20"><h6>Total :</h6>  </td>
                                                                        <td colspan="2" class="border">Rp.
                                                                            {{ number_format($t_ongkos_borongan_luar,2,'.')}}
                                                                        </td>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Biaya Borongan Luar --}}

                                {{-- Total Biaya Keseluruhan--}}
                                @if(in_array(auth()->user()->akses , [1,2,3,4,5]))
                                <div class="TotalBiayaKeseluruhan pt-5">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Total Biaya</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="table-1">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th class="px-3 text-center">No</th>
                                                            <th class="px-3 text-center">Jenis</th>
                                                            <th class="px-3 text-center">Biaya</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="border">1</td>
                                                            <td class="border">Biaya Kayu</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_kayu,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">2</td>
                                                            <td class="border">Biaya Plywood MDF</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_mdf,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">3</td>
                                                            <td class="border">Biaya Accessories Hardware</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_accessories,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">4</td>
                                                            <td class="border">Biaya Komponen Finishing</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_komponen_finishing,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">5</td>
                                                            <td class="border">Biaya Pendukung Packing</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_pendukung_packing,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">6</td>
                                                            <td class="border">Biaya Karton Box</td>
                                                            <td class="border text-center">Rp. {{ number_format($total_biaya_karton_box,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">7</td>
                                                            <td class="border">Biaya Borongan Dalam</td>
                                                            <td class="border text-center">Rp. {{ number_format($t_ongkos_borongan_dalam,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border">8</td>
                                                            <td class="border">Biaya Borongan Luar</td>
                                                            <td class="border text-center">Rp. {{ number_format($t_ongkos_borongan_luar,2,'.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center border fw-bold" colspan="2"><h6>Total Biaya</h6></td>
                                                            <td class="text-center border"><h6>Rp. {{ number_format($total_biaya_kayu + $total_biaya_mdf + $total_biaya_accessories + $total_biaya_komponen_finishing + $total_biaya_pendukung_packing + $total_biaya_karton_box + $t_ongkos_borongan_dalam + $t_ongkos_borongan_luar,2,'.') }}</h6></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                {{-- End Total Biaya Keseluruhan--}}
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
