@extends('layouts.app')

@section('title', 'Plywood MDF')

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
                    <h5 class="modal-title" id="importModalLabel">Import Data Plywood MDF dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Plywood_MDF.import') }}" method="POST" enctype="multipart/form-data">
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
                <h1>Plywood MDF</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Plywood_MDF">Plywood MDF</a></div>
                    <div class="breadcrumb-item">List Plywood MDF</div>
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
                                                <a href="{{ route('Plywood_MDF.export') }}" target="_blank" class="btn rounded btn-info me-md-2 mr-2 mb-2" type="button">
                                                    <i class="fas fa-regular fa-file-export mr-2"></i>Export Plywood MDF
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <button type="button" class="btn rounded btn-success mr-2 mb-2" data-toggle="modal" data-target="#importModal">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import Plywood MDF
                                                </button>
                                                <a href="{{ url('/Plywood_MDF/create') }}" class="btn rounded btn-primary me-md-2 mb-2" type="button">
                                                    <i class="fa-solid fa-plus mr-2"></i>Tambah Plywood MDF Baru
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    <div class="col">
                                        <form action="/Plywood_MDF">
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
                                                <th>Plywood/MDF</th>
                                                <th>Tebal /Mm</th>
                                                <th>Panjang /Mm</th>
                                                <th>Lebar /Mm</th>
                                                <th>Luas /M</th>
                                                <th>Satuan</th>
                                                <th>Suplier</th>
                                                @if(in_array(auth()->user()->akses , [1,2,3,4,5,6]))
                                                    <th>Harga /Lembar</th>
                                                    <th>Harga /M2</th>
                                                @endif
                                                @if(in_array(auth()->user()->akses , [1,2,4,6]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($PlywoodMDF as $plywoodmdf)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $plywoodmdf->id }}</td>
                                                <td>{{ $plywoodmdf->Nama_Plywood_MDF }}</td>
                                                <td>{{ number_format($plywoodmdf->Tebal_Plywood_MDF,0) }}</td>
                                                <td>{{ number_format($plywoodmdf->Panjang_Plywood_MDF,0) }}</td>
                                                <td>{{ number_format($plywoodmdf->Lebar_Plywood_MDF,0) }}</td>
                                                <td>{{ number_format($plywoodmdf->Panjang_Plywood_MDF * $plywoodmdf->Lebar_Plywood_MDF / 1000000,4) }}</td>
                                                <td>{{ $plywoodmdf->Satuan_Plywood_MDF }}</td>
                                                <td>{{ $plywoodmdf->Suplier->nama_suplier }}</td>
                                                @if(in_array(auth()->user()->akses , [1,2,3,4,5,6]))
                                                    <td>Rp. {{ number_format($plywoodmdf->Harga_Plywood_MDF,2,',','.')  }}</td>
                                                    <td>Rp. 
                                                        {{ number_format(
                                                            $plywoodmdf->Harga_Plywood_MDF/($plywoodmdf->Panjang_Plywood_MDF * $plywoodmdf->Lebar_Plywood_MDF / 1000000)*1.2,2,',','.'
                                                            )  
                                                        }}
                                                    </td>
                                                @endif
                                                @if(in_array(auth()->user()->akses , [1,2,4,6]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Plywood_MDF/{{ $plywoodmdf->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <form action="/Plywood_MDF/{{ $plywoodmdf->id }}"  method="POST">
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
                                  {{ $PlywoodMDF->links() }}
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
