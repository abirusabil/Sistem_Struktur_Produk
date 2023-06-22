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
                <h1>Kebutuhan Karton Box</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Kebutuhan_Karton_Box">Karton Box</a></div>
                    <div class="breadcrumb-item">List Kebutuhan Karton Box</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card py-3">
                            <div class="card-header d-block pb-0">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-5 float-end">
                                        <form action="/Kebutuhan_Karton_Box">
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
                                            <h5>Kebutuhan Karton Box </h5>
                                            <div class="table-responsive">
                                                        <table class="table table-hover" id="table-1">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th class="px-5">No</th>
                                                                    <th class="px-5">Job Order</th>
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
                                                                    @if(auth()->user()->akses == 1)
                                                                    <th class="px-3">Biaya Satuan</th>
                                                                    <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_karton_box = 0;
                                                                @endphp
                                                                    @foreach($KebutuhanKartonBox as $KebutuhanKartonBoxPo)
                                                                    @php
                                                                        $jumlah = $KebutuhanKartonBoxPo->Quantity_Kebutuhan_Karton_Box_Item;
                                                                        $qty_order = $KebutuhanKartonBoxPo->Quantity_Purchase_Order;
                                                                        $total_order = $jumlah * $qty_order;
                                                                        $harga_satuan = $KebutuhanKartonBoxPo->Harga_Kebutuhan_Karton_Box_Item;
                                                                        $total_biaya = $total_order *$harga_satuan ;
                                                                        $total_biaya_karton_box += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class="border border-black px-3">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $KebutuhanKartonBoxPo->Job_Order }}</td>
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
                                                                            @if(auth()->user()->akses == 1)
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
                                                  {{ $KebutuhanKartonBox->links() }}
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
