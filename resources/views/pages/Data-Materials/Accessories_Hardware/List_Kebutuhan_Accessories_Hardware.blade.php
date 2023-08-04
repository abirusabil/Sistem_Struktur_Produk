@extends('layouts.app')

@section('title', 'List Kebutuhan Accessories Hardware')

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
                <h1>Kebutuhan Accessories Hardware</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Accessories_Hardware">Accessories Hardware</a></div>
                    <div class="breadcrumb-item">List Kebutuhan Accessories Hardware</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card py-3">
                            <div class="card-header d-block pb-0">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-5 float-end">
                                        <form action="/Kebutuhan_Accessories_Hardware">
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
                                            <h5>Kebutuhan Accessories Hardware </h5>
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
                                                            <th class="px-3">Keterangan</th>
                                                            <th class="px-3">Ukuran</th>
                                                            <th class="px-3">Satuan</th>
                                                            <th class="px-3">Jumlah</th>
                                                            <th class="px-3">Qty Order</th>
                                                            <th class="px-3">Total Order</th>
                                                            @if(in_array(auth()->user()->akses , [1,2,4,5]))
                                                            <th class="px-3">Biaya Satuan</th>
                                                            <th class="px-3">Total Biaya</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_biaya_accessories = 0;
                                                        @endphp
                                                            @foreach($KebutuhanAccessoriesHardware as $KebutuhanAccessoriesHardwarePo)
                                                            @php
                                                                $jumlah = $KebutuhanAccessoriesHardwarePo->Quantity_Kebutuhan_Accessories_Hardware_Item;
                                                                $qty_order = $KebutuhanAccessoriesHardwarePo->Quantity_Purchase_Order;
                                                                $total_order = $jumlah * $qty_order;
                                                                $harga_satuan = $KebutuhanAccessoriesHardwarePo->Harga_Accessories_Hardware;
                                                                $total_biaya = $total_order *$harga_satuan ;
                                                                $total_biaya_accessories += $total_biaya ;
                                                            @endphp
                                                                <tr>
                                                                    <td class="border border-black px-3">{{ $loop->iteration }}</td>
                                                                    <td class="border border-black px-3">{{ $KebutuhanAccessoriesHardwarePo->Job_Order }}</td>
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
                                                  {{ $KebutuhanAccessoriesHardware->links() }}
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
