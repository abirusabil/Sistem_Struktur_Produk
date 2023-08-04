@extends('layouts.app')

@section('title', 'List Kebutuhan Pendukung Packing')

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
                <h1>Kebutuhan Pendukung Packing</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pendukung Packing</a></div>
                    <div class="breadcrumb-item">List Kebutuhan Pendukung Packing</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card py-3">
                            <div class="card-header d-block pb-0">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-5 float-end">
                                        <form action="/Kebutuhan_Pendukung_Packing">
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded " placeholder="Search..." name="search" value="{{ request('search') }}" >
                                                <button class="btn btn-success rounded " type="submit">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                {{-- Kebutuhan Kayu --}}
                                <div class="KebutuhanPendukungPacking">
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <h5>Kebutuhan Pendukung Packing </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-5">No</th>
                                                                    <th class="px-5">Job Order</th>
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
                                                                    @if(in_array(auth()->user()->akses , [1,2,4,5]))
                                                                    <th class="px-3">Biaya Satuan</th>
                                                                    <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_pendukung_packing = 0;
                                                                  
                                                                @endphp
                                                                    @foreach($KebutuhanPendukungPacking as $KebutuhanPendukungPackingPo)
                                                                    @php
                                                                        $jumlah = $KebutuhanPendukungPackingPo->Quantity_Kebutuhan_Pendukung_Packing_Item;
                                                                        $luas = $KebutuhanPendukungPackingPo->Luas_Pendukung_Packing;
                                                                        $qty_order = $KebutuhanPendukungPackingPo->Quantity_Purchase_Order;
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
                                                                            <td class="border border-black px-3">{{ $loop->iteration }} </td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Job_Order }} </td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Nama_Item }} </td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->No_Cutting }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Pendukung_Packing_Id }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanPendukungPackingPo->Nama_Pendukung_Packing }}</td>
                                                                            <td class="border border-black px-3">-</td>
                                                                            <td class="border border-black px-3 text-center">{{ $KebutuhanPendukungPackingPo->Satuan_Pendukung_Packing }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($tebal,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{number_format($lebar,0)}}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($panjang,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($jumlah,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($qty_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ number_format($total_order,0) }}</td>
                                                                            <td class="border border-black px-3 text-center">{{ $Total_Order_M2 }}</td>
                                                                            @if(in_array(auth()->user()->akses , [1,2,4,5]))
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($harga_satuan, 2, '.') }}
                                                                                </td>
                                                                                <td class="border border-black px-3">Rp. {{  number_format($total_biaya,2,'.') }}</td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="card-footer text-right d-flex justify-content-end float-end">
                                                <nav class="d-inline-block">
                                                  {{ $KebutuhanPendukungPacking->links() }}
                                                  </ul>
                                                </nav>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                {{-- End Kebutuhan Kayu --}}
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
