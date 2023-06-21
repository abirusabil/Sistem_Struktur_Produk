@extends('layouts.app')

@section('title', 'Item')

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
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Item dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Item.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="excel_file">Pilih File Excel:</label>
                            <input type="file" name="excel_file" class="form-control-file" id="excel_file" accept=".xls, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Item</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Item">Item</a></div>
                    <div class="breadcrumb-item">List Item</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <div class="row">
                                        <div class="col-lg-7 mb-3">
                                            <div class="d-grid d-md-flex  ">
                                                <a href="{{ route('Item.export') }}" target="_blank" class="btn rounded btn-info me-md-2 mr-2 mb-2" type="button">
                                                    <i class="fas fa-regular fa-file-export mr-2"></i>Export Item
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <button type="button" class="btn rounded btn-success mr-2 mb-2" data-toggle="modal" data-target="#importModal">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import Item
                                                </button>
                                                <a href="{{ url('/Item/create') }}" class="btn rounded btn-primary me-md-2 mr-2 mb-2" type="button">
                                                    <i class="fa-solid fa-plus mr-2"></i>Tambah Item Baru
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="col">
                                        <form action="/Item">
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
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table table-hover"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Item</th>
                                                <th>Warna</th>
                                                <th>Collection</th>
                                                <th>Buyer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="px-2">{{ $item->id}}</td>
                                                <td class="px-2">{{ $item->Nama_Item }}</td>
                                                <td class="px-2">{{ $item->Warna_Item }}</td>
                                                <td class="px-2">{{ $item->Collection->Nama_Collection }}</td>
                                                <td class="px-2">{{ $item->Collection->Buyer->Nama_Buyer }}</td>
                                                <td class="px-2">
                                                    <div class="d-flex">
                                                        <a href="/Item/{{ $item->id }} " class="btn btn-info ml-2">Detail</a>
                                                        @if(in_array(auth()->user()->akses , [1]))
                                                        <a href="/Item/{{ $item->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                        <form action="/Item/{{ $item->id }}"  method="POST">
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
                                  {{ $items->links() }}
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
