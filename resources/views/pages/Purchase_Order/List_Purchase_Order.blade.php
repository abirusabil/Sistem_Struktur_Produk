@extends('layouts.app')

@section('title', 'Purchase Order')

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
                <h1>Purchase Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Purchase_Order">Purchase Order</a></div>
                    <div class="breadcrumb-item">List Purchase Order</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header d-block">
                                <div class="row">
                                    <div class="col-lg-8 mb-3">
                                        <div class="d-grid d-md-flex  ">
                                            @if(in_array(auth()->user()->akses , [1]))
                                            <a href="{{ url('Purchase_Order/create') }}" class="btn rounded btn-primary me-md-2" type="button">
                                                <i class="fa-solid fa-plus mr-2"></i>Purchase Order Baru
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                <div class="col-lg-4 w-100">
                                    <form action="/">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded " placeholder="Search..." name="search" value="{{ request('search') }}" >
                                            <button class="btn btn-success rounded " type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center px-3 border">
                                                    #
                                                </th>
                                                <th class="border text-center px-3">Job Order</th>
                                                <th class="border text-center px-3">Dasar Purchase Order</th>
                                                <th class="border text-center px-3">Buyer</th>
                                                <th class="border text-center px-3">Status</th>
                                                <th class="border text-center px-3">Tanggal Masuk</th>
                                                <th class="border text-center px-3">Schedule Kirim</th>
                                                <th class="border text-center px-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Purchase_Orders as $Purchase_Order)
                                            <tr>
                                                <td class="border px-3">{{ $loop->iteration }}</td>
                                                <td class="border px-3">{{ $Purchase_Order->id }}</td>
                                                <td class="border px-3">{{ $Purchase_Order->Dasar_Po }}</td>
                                                <td class="border px-3">{{ $Purchase_Order->Buyer->Nama_Buyer }}</td>
                                                <td class="border px-3"> 
                                                    @if ($Purchase_Order->Status == 0)
                                                        <div class="badge badge-warning p-2 px-3">Belum Disetujui</div>
                                                    @else
                                                        <div class="badge badge-success p-2 px-3">Telah Disetujui</div>
                                                    @endif
                                                </td>
                                                <td class="border px-3">{{ $Purchase_Order->Tanggal_Masuk }}</td>
                                                <td class="border px-3">{{ $Purchase_Order->Schedule_Kirim }}</td>
                                                <td class="border px-3">
                                                    <div class="d-flex">
                                                        <a href="/Purchase_Order/{{ $Purchase_Order->id }} " class="btn btn-info ml-2">Detail</a>
                                                        @if(in_array(auth()->user()->akses , [1,2,3]))
                                                            <a href="/Purchase_Order/{{ $Purchase_Order->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <form action="Purchase_Order/{{ $Purchase_Order->id }}"  method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-danger ml-2" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                  {{ $Purchase_Orders->links() }}
                                  </ul>
                                </nav>
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
