@extends('layouts.app')

@section('title', 'List Kebutuhan Kayu')

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
                <h1>Kebutuhan Kayu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Kayu">Kayu</a></div>
                    <div class="breadcrumb-item">List Kebutuhan Kayu</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card py-3">
                            <div class="card-header d-block pb-0">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-5 float-end">
                                        <form action="/Kebutuhan_Kayu">
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
                                <div class="KebutuhanKayu">
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
                                                            <th>NO</th>
                                                            <th class="px-3">Job_Order</th>
                                                            <th class="px-5">Nama_Item</th>
                                                            <th class="px-3">NO Cutting</th>
                                                            <th class="px-3">Kode Material</th>
                                                            <th class="px-3">Material</th>
                                                            <th class="px-3">KP</th>
                                                            <th class="px-3">Keterangan</th>
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
                                                            @if(auth()->user()->akses == 1)
                                                            <th class="px-3">Biaya /M3</th>
                                                            <th class="px-3">Total Biaya</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_biaya_kayu = 0;
                                                        @endphp
                                                            @foreach($KebutuhanKayu as $kebutuhanKayuItem)
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
                                                                    <td class="border border-black px-3">{{ $loop->iteration }}</td>
                                                                    <td class="border border-black px-3">{{ $kebutuhanKayuItem->Job_Order }}</td>
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
                                                                    @if(auth()->user()->akses == 1)
                                                                        <td class="border border-black px-3">
                                                                            Rp. {{ number_format($biaya_m3, 2, '.') }}
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
                                                  {{ $KebutuhanKayu->links() }}
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
