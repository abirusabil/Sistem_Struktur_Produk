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
                <h1>Kebutuhan Plywood MDF</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Purchase Order</a></div>
                    <div class="breadcrumb-item">Detail PO </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card py-3">
                            <div class="card-header d-block pb-0">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-5 float-end">
                                        <form action="/Kebutuhan_Plywood_MDF">
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
                                            <h5>Kebutuhan Plywood MDF </h5>
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
                                                                    <th class="px-3">Tebal</th>
                                                                    <th class="px-3">Lebar</th>
                                                                    <th class="px-3">Panjang</th>
                                                                    <th class="px-3">Jumlah</th>
                                                                    <th class="px-3">Qty Order</th>
                                                                    <th class="px-3">Total Order</th>
                                                                    <th class="px-3">Luas M2</th>
                                                                    @if(auth()->user()->akses == 1)
                                                                    <th class="px-3">Biaya /M3</th>
                                                                    <th class="px-3">Total Biaya</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $total_biaya_mdf = 0;
                                                                @endphp
                                                                    @foreach($KebutuhanPlywoodMdf as $kebutuhanplywoodmdfitem)
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
                                                                        $total_biaya = $biaya_m2 * $luas;
                                                                        $total_biaya_mdf += $total_biaya ;
                                                                    @endphp
                                                                        <tr>
                                                                            <td class="border border-black px-3">{{ $loop->iteration }}</td>
                                                                            <td class="border border-black px-3">{{ $kebutuhanplywoodmdfitem->Job_Order }}</td>
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
                                                                            @if(auth()->user()->akses == 1)
                                                                                <td class="border border-black px-3">
                                                                                    Rp. {{ number_format($biaya_m2, 2, '.') }}
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
                                                  {{ $KebutuhanPlywoodMdf->links() }}
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
