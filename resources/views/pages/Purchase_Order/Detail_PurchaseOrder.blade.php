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

<div class="modal fade" id="JumlahKolomFormKartonBox" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
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
                <h1></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
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
                                            <div class="col-5"><span>Job Order</span></div>
                                            <div class="col px-0 "><h6 class="pt-1">: {{ $Purchase_Order->id }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><span>Dasar Purchase Order</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Dasar_Po }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><span>Buyer</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Buyer->Nama_Buyer }}</h6></div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="row">
                                            <div class="col-5"><span>Tanggal Masuk</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Tanggal_Masuk }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"><span>ScheduleKirim</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Purchase_Order->Schedule_Kirim }}</h6></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="/Purchase_Order/{{ $Purchase_Order->id }}/edit" class="btn mt-2 rounded px-5 btn-warning">Edit</a>
                                    </div>   
                                </div>
                                <hr class="border border-black opacity-100 ">
                            </div>
                            <div class="card-body mt-0 pt-0">
                             
                                <div class="Karton_Box">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Karton Box</h5>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_karton_box'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_karton_box') }}
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <div class="table-responsive">
                                                <table class="table table-bordered border" id="table-1">
                                                    <thead class="border">
                                                        <tr class="border">
                                                            <th class="text-center border">
                                                                #
                                                            </th>
                                                            <th class="text-center border">Item</th>
                                                            <th class="text-center border">Code</th>
                                                            <th class="text-center border">Qty</th>
                                                            <th class="text-center border">Keterangan</th>
                                                            <th class="text-center border">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex flex-row-reverse">
                                    <button data-target="#JumlahKolomFormKartonBox" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Item Baru
                                    </button>
                                </div>
                               
                            </div>
                            <div class="card-footer text-right">
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
