@extends('layouts.app')

@section('title', 'Kayu')

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
                    <h5 class="modal-title" id="importModalLabel">Import Data Accessories Hardware dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Accessories_Hardware.import') }}" method="POST" enctype="multipart/form-data">
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
                <h1>Accessories Hardware</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Accessories Hardware</a></div>
                    <div class="breadcrumb-item">List Accessories Hardware</div>
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
                                                
                                                <a href="{{ route('Accessories_Hardware.export') }}" target="_blank" class="btn rounded btn-info me-md-2 mr-2" type="button">
                                                    <i class="fas fa-regular fa-file-export mr-2"></i>Export Accessories Hardware
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <button type="button" class="btn rounded btn-success mr-2" data-toggle="modal" data-target="#importModal">
                                                        <i class="fas fa-regular fa-file-import mr-2"></i>Import Accessories Hardware
                                                    </button>
                                                    <a href="{{ url('/Accessories_Hardware/create') }}" class="btn rounded btn-primary me-md-2" type="button">
                                                        <i class="fa-solid fa-plus mr-2"></i>Tambah Accessories Hardware Baru
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    <div class="col">
                                        <form action="/Accessories_Hardware">
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded " placeholder="Search..." name="search" value="{{ request('search') }}" >
                                                <button class="btn btn-success rounded " type="submit">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Accessories Hardware</th>
                                                <th>Ukuran</th>
                                                <th>Satuan </th>
                                                <th>Suplier</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($AccessoriesHardware as $accessorieshardware)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $accessorieshardware->id }}</td>
                                                <td>{{ $accessorieshardware->Nama_Accessories_Hardware }}</td>
                                                <td>{{ $accessorieshardware->Ukuran_Accessories_Hardware }}</td>
                                                <td>{{ $accessorieshardware->Satuan_Accessories_Hardware }}</td>
                                                <td>{{ $accessorieshardware->Suplier->nama_suplier }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <td>Rp. {{ number_format($accessorieshardware->Harga_Accessories_Hardware,2,',','.')  }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="/Accessories_Hardware/{{ $accessorieshardware->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                        <form action="/Accessories_Hardware/{{ $accessorieshardware->id }}"  method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger ml-2" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                  {{ $AccessoriesHardware->links() }}
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
