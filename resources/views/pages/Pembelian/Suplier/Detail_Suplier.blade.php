@extends('layouts.app')

@section('title', 'Detail Suplier')

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
                <h1>Detail Suplier</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/Suplier">Suplier</a></div>
                    <div class="breadcrumb-item active"><a href="/Suplier">List Suplier</a></div>
                    <div class="breadcrumb-item">Detail Suplier</div>
                </div>
            </div>
            <div class="Kayu">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="row">
                                            <div class="col-4">Nama Suplier</div>
                                            <div class="col-7">:{{ $Suplier->nama_suplier }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Kontak Suplier</div>
                                            <div class="col-7">:{{ $Suplier->kontak_suplier }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="row">
                                            <div class="col-4">Alamat Suplier</div>
                                            <div class="col-7">:{{ $Suplier->alamat_suplier }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kayu --}}
            <div class="Kayu">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Kayu as $kayu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kayu->id }}</td>
                                                <td>{{ $kayu->Nama_Kayu }}</td>
                                                <td>Rp.{{ number_format($kayu->Harga_Kayu,2,'.',',') }}</td>
                                                <td>{{ $kayu->Satuan }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Kayu/{{ $kayu->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <a href="/Kayu/{{ $kayu->id }} " class="btn btn-info ml-2">Detail</a>
                                                            <form action="/Kayu/{{ $kayu->id }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Kayu --}}

            {{-- Plywood_MDF --}}
            <div class="Plywood_MDF">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Plywood_MDF as $Plywood_MDF)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Plywood_MDF->id }}</td>
                                                <td>{{ $Plywood_MDF->Nama_Plywood_MDF }}</td>
                                                <td>Rp.{{ number_format($Plywood_MDF->Harga_Plywood_MDF,2,'.',',') }}</td>
                                                <td>{{ $Plywood_MDF->Satuan_Plywood_MDF }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Plywood_MDF/{{ $Plywood_MDF->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <a href="/Plywood_MDF/{{ $Plywood_MDF->id }} " class="btn btn-info ml-2">Detail</a>
                                                            <form action="/Plywood_MDF/{{ $Plywood_MDF->id }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Plywood_MDF --}}

            {{-- Accessories_Hardware --}}
            <div class="Accessories_Hardware">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Accessories_Hardware as $accessories_hardware)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $accessories_hardware->id }}</td>
                                                <td>{{ $accessories_hardware->Nama_Accessories_Hardware }}</td>
                                                <td>Rp.{{ number_format($accessories_hardware->Harga_Accessories_Hardware,2,'.',',') }}</td>
                                                <td>{{ $accessories_hardware->Satuan_Accessories_Hardware }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Accessories_Hardware/{{ $accessories_hardware->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <a href="/Accessories_Hardware/{{ $accessories_hardware->id }} " class="btn btn-info ml-2">Detail</a>
                                                            <form action="/Accessories_Hardware/{{ $accessories_hardware->id }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Accessories_Hardware --}}

            {{-- Komponen_Finishing --}}
            <div class="Komponen_Finishing">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Quantity</th>
                                                <th>Satuan</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Komponen_Finishing as $Komponen_Finishing)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Komponen_Finishing->id }}</td>
                                                <td>{{ $Komponen_Finishing->Nama_Komponen_Finishing }}</td>
                                                <td>Rp.{{ number_format($Komponen_Finishing->Harga_Komponen_Finishing,2,'.',',') }}</td>
                                                <td>{{ $Komponen_Finishing->Quantity_Komponen_Finishing }}</td>
                                                <td>{{ $Komponen_Finishing->Satuan_Komponen_Finishing }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Komponen_Finishing/{{ $Komponen_Finishing->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <a href="/Komponen_Finishing/{{ $Komponen_Finishing->id }} " class="btn btn-info ml-2">Detail</a>
                                                            <form action="/Komponen_Finishing/{{ $Komponen_Finishing->id }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Komponen_Finishing --}}

             {{-- Pendukung_Packing --}}
             <div class="Pendukung_Packing">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        </div>
                                     @endif
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Pendukung_Packing as $Pendukung_Packing)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Pendukung_Packing->id }}</td>
                                                <td>{{ $Pendukung_Packing->Nama_Pendukung_Packing }}</td>
                                                <td>Rp.{{ number_format($Pendukung_Packing->Harga_Pendukung_Packing,2,'.',',') }}</td>
                                                <td>{{ $Pendukung_Packing->Satuan_Pendukung_Packing }}</td>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/Pendukung_Packing/{{ $Pendukung_Packing->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                            <a href="/Pendukung_Packing/{{ $Pendukung_Packing->id }} " class="btn btn-info ml-2">Detail</a>
                                                            <form action="/Pendukung_Packing/{{ $Pendukung_Packing->id }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Komponen_Finishing --}}

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
