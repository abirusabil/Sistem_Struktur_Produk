@extends('layouts.app')

@section('title', 'Pendukung Packing')

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
                    <h5 class="modal-title" id="importModalLabel">Import Data Pendukung Packing dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Pendukung_Packing.import') }}" method="POST" enctype="multipart/form-data">
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
                <h1>Pendukung Packing</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pendukung Packing</a></div>
                    <div class="breadcrumb-item">List Pendukung Packing</div>
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
                                                <a href="{{ route('Pendukung_Packing.export') }}" target="_blank" class="btn rounded btn-info me-md-2 mr-2" type="button">
                                                    <i class="fas fa-regular fa-file-export mr-2"></i>Export Pendukung Packing
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <a href="{{ url('/Pendukung_Packing/create') }}" class="btn rounded btn-primary me-md-2 mr-2" type="button">
                                                    <i class="fa-solid fa-plus mr-2"></i>Tambah Pendukung Packing Baru
                                                </a>
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModal">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import Pendukung Packing
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    <div class="col">
                                        <form action="/Pendukung_Packing">
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
                                                <th>Pendukung Packing</th>
                                                <th>Tebal /Mm</th>
                                                <th>Panjang /Mm</th>
                                                <th>Lebar /Mm</th>
                                                <th>Luas /M</th>
                                                <th>Satuan</th>
                                                <th>Suplier</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Harga Satuan</th>
                                                    <th>Harga /M2</th>
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Pendukung_Packing as $pendukungpacking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pendukungpacking->id }}</td>
                                                <td>{{ $pendukungpacking->Nama_Pendukung_Packing }}</td>
                                                <td>{{ number_format($pendukungpacking->Tebal_Pendukung_Packing,0) }}</td>
                                                <td>{{ number_format($pendukungpacking->Panjang_Pendukung_Packing,0) }}</td>
                                                <td>{{ number_format($pendukungpacking->Lebar_Pendukung_Packing,0) }}</td>
                                                <td>{{ number_format($pendukungpacking->Panjang_Pendukung_Packing * $pendukungpacking->Lebar_Pendukung_Packing / 1000000,4) }}</td>
                                                <td>{{ $pendukungpacking->Satuan_Pendukung_Packing }}</td>
                                                <td>{{ $pendukungpacking->Suplier->nama_suplier }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>Rp. {{ number_format($pendukungpacking->Harga_Pendukung_Packing,2,',','.')  }}</td>
                                                    <td>Rp. 
                                                        @if ($pendukungpacking->Satuan_Pendukung_Packing == "Meter")
                                                        {{ number_format(
                                                            $pendukungpacking->Harga_Pendukung_Packing/($pendukungpacking->Panjang_Pendukung_Packing * $pendukungpacking->Lebar_Pendukung_Packing / 1000000),2,',','.'
                                                            )  
                                                        }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Pendukung_Packing/{{ $pendukungpacking->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <form action="/Pendukung_Packing/{{ $pendukungpacking->id }}"  method="POST">
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
                                  {{-- {{ $suplier->links() }} --}}
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
