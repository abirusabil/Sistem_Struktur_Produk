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

{{-- Kayu --}}
<div class="modal fade" id="importModalkayu" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Kayu dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Kayu_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomForm" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Komponen Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Kayu_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button  class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- End Kayu --}}

{{-- PlywoodMDF --}}
<div class="modal fade" id="importModalPlywoodMDF" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Plywood MDF dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Plywood_MDF_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomFormPlywoodMDF" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Komponen Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Plywood_MDF_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- EndPlywoodMDF --}}

{{-- Accessories Hardware --}}
<div class="modal fade" id="importModalAccessoriesHardware" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Accessories Hardware dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Accessories_Hardware_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomFormAccessoriesHardware" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Komponen Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Accessories_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- EndAccessoriesHardware --}}

{{-- Komponen Finishing --}}
<div class="modal fade" id="importModalKomponenFinishing" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Komponen Finishing dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Komponen_Finishing_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomFormKomponenFinishing" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Komponen Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Finishing_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Komponen Finishing --}}

{{-- Pendukung Packing --}}
<div class="modal fade" id="importModalPendukungPacking" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Pendukung Packing dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Pendukung_Packing_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomFormPendukungPacking" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Komponen Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Packing_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Pendukung Packing --}}

{{-- Karton Box --}}
<div class="modal fade" id="importModalKartonBox" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Kebutuhan Karton Box dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Kebutuhan_Karton_Box_Item.import', ['itemId' => $Item->id]) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="JumlahKolomFormKartonBox" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Jumlah Karton Box Yang akan Dimasukkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" action="{{route('Kebutuhan_Karton_Box_Item.create'), $Item->id }}">
                    @csrf
                    <label for="loop_count">Masukkan jumlah komponen:</label>
                    <input type="number" name="loop_count" id="loop_count">
                    <input type="hidden" name="id" value="{{ $Item->id }}">
                    <button class="btn rounded btn-success ml-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Karton Box --}}

    
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $Item->Nama_Item }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Item</a></div>
                    <div class="breadcrumb-item">Detail Item {{ $Item->Nama_Item }}</div>
                </div>
            </div>

           

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block pb-0">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-4"><span>Kode</span></div>
                                            <div class="col px-0 "><h6 class="pt-1">: {{ $Item->id }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4"><span>Item</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Item->Nama_Item }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4"><span>Warna</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Item->Warna_Item }}</h6></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Collection</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Item->Collection->Nama_Collection }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Buyer</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ $Item->Collection->Buyer->Nama_Buyer }}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Berat</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ number_format($Item->Berat_Item) }} Kg</h6></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Panjang</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ number_format($Item->Panjang_Item) }} Mm</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Lebar</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ number_format($Item->Lebar_Item) }} Mm</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 px-0"><span>Tinggi</span></div>
                                            <div class="col px-0"><h6 class="pt-1">: {{ number_format($Item->Tinggi_Item) }} Mm</h6></div>
                                        </div>
                                    </div>
                                    @if(in_array(auth()->user()->akses , [1]))
                                    <div class="row">
                                        <div class="col">
                                            <a href="/Item/{{ $Item->id }}/edit" class="btn ml-3 mt-2 rounded px-5 btn-warning ml-2">Edit</a>
                                        </div>   
                                    </div>
                                    @endif
                                        
                                    
                                </div>
                                <hr class="border border-black opacity-100 ">
                            </div>
                            <div class="card-body mt-0 pt-0">
                                {{-- Kebutuhan Kayu --}}
                                <div class="Kayu">
                                        <div class="row py-4">
                                            <div class="col">
                                                <h5>Kebutuhan Kayu</h5>
                                            </div>
                                            @if(in_array(auth()->user()->akses , [1]))
                                                <div class="col d-flex flex-row-reverse">
                                                    <button data-target="#JumlahKolomForm" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Kebutuhan Kayu baru
                                                    </button>
                                                    <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalkayu">
                                                        <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                    @if (session()->has('success_kayu'))
                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            {{ session('success_kayu') }}
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
                                                                <th class="text-center border">Kode Cutting</th>
                                                                <th class="text-center border">Kode Material</th>
                                                                <th class="text-center border">Material</th>
                                                                <th class="text-center border">Kp</th>
                                                                <th class="text-center border">Keterangan</th>
                                                                <th class="text-center border">Grade</th>
                                                                <th class="text-center border">Tebal Mm</th>
                                                                <th class="text-center border">Lebar Mm</th>
                                                                <th class="text-center border">Panjang Netto</th>
                                                                <th class="text-center border">Panjang Bruto</th>
                                                                <th class="text-center border">Jumlah</th>
                                                                <th class="text-center border">Total M3</th>
                                                                @if(in_array(auth()->user()->akses , [1]))
                                                                    <th class="text-center border">Biaya /M3</th>
                                                                    <th class="text-center border">Total Biaya</th>
                                                                    <th class="text-center border">Action</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($kebutuhan_kayus as $kebutuhan_kayu)
                                                            <tr>
                                                               
                                                                <td class="border">{{ $loop->iteration }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->id }}</td> 
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Kayu_Id }}</td> 
                                                                <td class="border">{{ $kebutuhan_kayu->MasterKayu->Nama_Kayu }}</td> 
                                                                <td class="text-center border">{{ $kebutuhan_kayu->KP_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="border">{{ $kebutuhan_kayu->Keterangan_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Grade_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Tebal_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Lebar_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Panjang_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Panjang_Kebutuhan_Kayu_Item+20 }}</td>
                                                                <td class="text-center border">{{ $kebutuhan_kayu->Quantity_Kebutuhan_Kayu_Item }}</td>
                                                                <td class="text-center border">
                                                                    {{ number_format(
                                                                        ($kebutuhan_kayu->Tebal_Kebutuhan_Kayu_Item+5)*
                                                                        (($kebutuhan_kayu->Panjang_Kebutuhan_Kayu_Item+20)*1.1)*
                                                                        ($kebutuhan_kayu->Lebar_Kebutuhan_Kayu_Item+10)/1000000000*
                                                                        $kebutuhan_kayu->Quantity_Kebutuhan_Kayu_Item
                                                                        ,4,'.') 
                                                                    }}
                                                                </td>
                                                                @if(in_array(auth()->user()->akses , [1]))
                                                                    <td class="border">
                                                                    Rp. {{ number_format(
                                                                            $kebutuhan_kayu->MasterKayu->Harga_Kayu,2,'.'
                                                                        ) }} 
                                                                    </td>
                                                                    <td class="border">
                                                                        Rp. {{ number_format(
                                                                            $kebutuhan_kayu->MasterKayu->Harga_Kayu*
                                                                            (
                                                                                ($kebutuhan_kayu->Tebal_Kebutuhan_Kayu_Item+5)*
                                                                                (($kebutuhan_kayu->Panjang_Kebutuhan_Kayu_Item+20)*1.1)*
                                                                                ($kebutuhan_kayu->Lebar_Kebutuhan_Kayu_Item+10)/1000000000*
                                                                                $kebutuhan_kayu->Quantity_Kebutuhan_Kayu_Item
                                                                            ),2,'.'
                                                                        ) }}
                                                                    </td>
                                                                    <td class="border">
                                                                        <div class="d-flex">
                                                                            <a href="/Kebutuhan_Kayu_Item/{{ $kebutuhan_kayu->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                        <form action="/Kebutuhan_Kayu_Item/{{ $kebutuhan_kayu->id }}"  method="POST">
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
                                                    <div class="flex-row-reverse d-flex mt-4">
                                                        <a href="{{ route('Kebutuhan_Kayu_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                            <i class="fa-solid fa-print mr-2"></i>Print
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                {{-- End Kebutuhan Kayu --}}

                                {{-- Kebutuhan MDF --}}
                                <div class="Plywood_MDF">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Plywood MDF</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <button data-target="#JumlahKolomFormPlywoodMDF" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                    <i class="fa-solid fa-plus"></i>
                                                    Kebutuhan Plywood MDF baru
                                                </button>
                                                
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalPlywoodMDF">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_plywood_mdf'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_plywood_mdf') }}
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
                                                            <th class="text-center border">Kode Cutting</th>
                                                            <th class="text-center border">Kode Material</th>
                                                            <th class="text-center border">Material</th>
                                                            <th class="text-center border">Kp</th>
                                                            <th class="text-center border">Keterangan</th>
                                                            <th class="text-center border">Grade</th>
                                                            <th class="text-center border">Tebal Mm</th>
                                                            <th class="text-center border">Lebar Mm</th>
                                                            <th class="text-center border">Panjang Netto</th>
                                                            <th class="text-center border">Jumlah</th>
                                                            <th class="text-center border">Total M2</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <th class="text-center border">Biaya /M2</th>
                                                                <th class="text-center border">Total Biaya</th>
                                                                <th class="text-center border">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kebutuhan_plywood_mdfs as $kebutuhan_plywood_mdf)
                                                        <tr>
                                                           
                                                            <td class="border">{{ $loop->iteration }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->id }}</td> 
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->Plywood_MDF_Id }}</td> 
                                                            <td class="border">{{ $kebutuhan_plywood_mdf->MasterPlywoodMDF->Nama_Plywood_MDF }}</td> 
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->KP_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="border">{{ $kebutuhan_plywood_mdf->Keterangan_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->Grade_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->MasterPlywoodMDF->Tebal_Plywood_MDF }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->Lebar_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->Panjang_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="text-center border">{{ $kebutuhan_plywood_mdf->Quantity_Kebutuhan_Plywood_MDF_Item }}</td>
                                                            <td class="text-center border">
                                                                {{ number_format(
                                                                    $kebutuhan_plywood_mdf->Panjang_Kebutuhan_Plywood_MDF_Item*
                                                                    $kebutuhan_plywood_mdf->Lebar_Kebutuhan_Plywood_MDF_Item/1000000*
                                                                    $kebutuhan_plywood_mdf->Quantity_Kebutuhan_Plywood_MDF_Item
                                                                    ,4,'.') 
                                                                }}
                                                            </td>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <td class="border">
                                                                Rp. {{ number_format(
                                                                        $kebutuhan_plywood_mdf->MasterPlywoodMDF->Harga_Plywood_MDF/
                                                                        (
                                                                            $kebutuhan_plywood_mdf->MasterPlywoodMDF->Panjang_Plywood_MDF
                                                                            *$kebutuhan_plywood_mdf->MasterPlywoodMDF->Lebar_Plywood_MDF/1000000
                                                                        )*1.2,2,'.'
                                                                    ) }} 
                                                                </td>
                                                                <td class="border">
                                                                    Rp. {{ number_format(
                                                                        (
                                                                            $kebutuhan_plywood_mdf->MasterPlywoodMDF->Harga_Plywood_MDF/
                                                                        (
                                                                            $kebutuhan_plywood_mdf->MasterPlywoodMDF->Panjang_Plywood_MDF
                                                                            *$kebutuhan_plywood_mdf->MasterPlywoodMDF->Lebar_Plywood_MDF/1000000
                                                                        )*1.2
                                                                        )
                                                                            *
                                                                        (
                                                                            $kebutuhan_plywood_mdf->Panjang_Kebutuhan_Plywood_MDF_Item*
                                                                            $kebutuhan_plywood_mdf->Lebar_Kebutuhan_Plywood_MDF_Item/1000000*
                                                                            $kebutuhan_plywood_mdf->Quantity_Kebutuhan_Plywood_MDF_Item                                                         
                                                                        ),2,'.'
                                                                    ) }}
                                                                </td>
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Kebutuhan_Plywood_MDF_Item/{{ $kebutuhan_plywood_mdf->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                    <form action="/Kebutuhan_Plywood_MDF_Item/{{ $kebutuhan_plywood_mdf->id }}"  method="POST">
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
                                                <div class="flex-row-reverse d-flex mt-4">
                                                    <a href="{{ route('Kebutuhan_Plywood_MDF_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                        <i class="fa-solid fa-print mr-2"></i>Print
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan MDF --}}

                                {{-- Kebutuhan Accessories Hardware --}}
                                <div class="Accessories_Hardware">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Accessories Hardware</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <button data-target="#JumlahKolomFormAccessoriesHardware" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                    <i class="fa-solid fa-plus"></i>
                                                    Kebutuhan Accessories Hardware baru
                                                </button>
                                                
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalAccessoriesHardware">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_accessories_hardware'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_accessories_hardware') }}
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
                                                            <th class="text-center border">Kode Cutting</th>
                                                            <th class="text-center border">Kode Material</th>
                                                            <th class="text-center border">Material</th>
                                                            <th class="text-center border">Ukuran</th>
                                                            <th class="text-center border">Keterangan</th>
                                                            <th class="text-center border">Jumlah</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <th class="text-center border">Biaya </th>
                                                                <th class="text-center border">Total Biaya</th>
                                                                <th class="text-center border">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kebutuhan_accessories_hardwares as $kebutuhan_accessories_hardware)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->id }}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->Accessories_Hardware_Id }}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->MasterAccessoriesHardware->Nama_Accessories_Hardware}}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->MasterAccessoriesHardware->Ukuran_Accessories_Hardware}}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->Keterangan_Kebutuhan_Accessories_Hardware_Item }}</td>
                                                            <td>{{ $kebutuhan_accessories_hardware->Quantity_Kebutuhan_Accessories_Hardware_Item }}</td>
                                                            @if(in_array(auth()->user()->akses , [1])) 
                                                                <td>Rp. 
                                                                    {{ number_format(
                                                                                        $kebutuhan_accessories_hardware->MasterAccessoriesHardware->Harga_Accessories_Hardware,2,'.'
                                                                                    )
                                                                    }}
                                                                </td>
                                                                <td>Rp.
                                                                    {{ 
                                                                        number_format(
                                                                                        $kebutuhan_accessories_hardware->Quantity_Kebutuhan_Accessories_Hardware_Item * 
                                                                                        $kebutuhan_accessories_hardware->MasterAccessoriesHardware->Harga_Accessories_Hardware
                                                                                        ,2,'.'
                                                                                    )
                                                                        
                                                                    }}
                                                                </td>
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Kebutuhan_Accessories_Item/{{ $kebutuhan_accessories_hardware->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                        <form action="/Kebutuhan_Accessories_Item/{{ $kebutuhan_accessories_hardware->id }}"  method="POST">
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
                                                <div class="flex-row-reverse d-flex mt-4">
                                                    <a href="{{ route('Kebutuhan_Accessories_Hardware_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                        <i class="fa-solid fa-print mr-2"></i>Print
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Accessories Hardware --}}

                                {{-- Kebutuhan Komponen Finishing --}}
                                <div class="Komponen_Finishing">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Komponen Finishing</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <button data-target="#JumlahKolomFormKomponenFinishing" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                    <i class="fa-solid fa-plus"></i>
                                                    Kebutuhan Komponen Finishing baru
                                                </button>
                                                
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalKomponenFinishing">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_komponen_finishing'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_komponen_finishing') }}
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
                                                            <th class="text-center border">Kode Cutting</th>
                                                            <th class="text-center border">Kode Material</th>
                                                            <th class="text-center border">Material</th>
                                                            <th class="text-center border">Jumlah</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <th class="text-center border">Biaya </th>
                                                                <th class="text-center border">Total Biaya</th>
                                                                <th class="text-center border">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kebutuhan_komponen_finishings as $kebutuhan_komponen_finishing)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $kebutuhan_komponen_finishing->id }}</td>
                                                            <td>{{ $kebutuhan_komponen_finishing->Komponen_Finishing_Id }}</td>
                                                            <td>{{ $kebutuhan_komponen_finishing->MasterKomponenFinishing->Nama_Komponen_Finishing}}</td>
                                                            <td>{{ $kebutuhan_komponen_finishing->Quantity_Kebutuhan_Komponen_Finishing_Item }}</td>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <td>Rp. 
                                                                    {{ number_format(
                                                                                        $kebutuhan_komponen_finishing->MasterKomponenFinishing->Harga_Komponen_Finishing
                                                                                        /$kebutuhan_komponen_finishing->MasterKomponenFinishing->Quantity_Komponen_Finishing,2,'.'
                                                                                    )
                                                                    }}
                                                                </td>
                                                                <td>Rp.
                                                                    {{ 
                                                                        number_format(
                                                                                        $kebutuhan_komponen_finishing->Quantity_Kebutuhan_Komponen_Finishing_Item * 
                                                                                        $kebutuhan_komponen_finishing->MasterKomponenFinishing->Harga_Komponen_Finishing
                                                                                        /$kebutuhan_komponen_finishing->MasterKomponenFinishing->Quantity_Komponen_Finishing
                                                                                        ,2,'.'
                                                                                    )
                                                                        
                                                                    }}
                                                                </td>
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Kebutuhan_Finishing_Item/{{ $kebutuhan_komponen_finishing->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                        <form action="/Kebutuhan_Finishing_Item/{{ $kebutuhan_komponen_finishing->id }}"  method="POST">
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
                                                <div class="flex-row-reverse d-flex mt-4">
                                                    <a href="{{ route('Kebutuhan_Komponen_Finishing_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                        <i class="fa-solid fa-print mr-2"></i>Print
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Komponen Finishing --}}

                                {{-- Kebutuhan Pendukung Packing --}}
                                <div class="Pendukung_Packing">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Pendukung Packing</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <button data-target="#JumlahKolomFormPendukungPacking" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                    <i class="fa-solid fa-plus"></i>
                                                    Kebutuhan Pendukung Packing baru
                                                </button>
                                                
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalPendukungPacking">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_pendukung_packing'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_pendukung_packing') }}
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
                                                            <th class="text-center border">Kode Cutting</th>
                                                            <th class="text-center border">Kode Material</th>
                                                            <th class="text-center border">Material</th>
                                                            <th class="text-center border">Keterangan</th>
                                                            <th class="text-center border">Satuan</th>
                                                            <th class="text-center border">Tebal Mm</th>
                                                            <th class="text-center border">Lebar Mm</th>
                                                            <th class="text-center border">Panjang MM</th>
                                                            <th class="text-center border">Jumlah</th>
                                                            <th class="text-center border">Total M2</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <th class="text-center border">Biaya Satuan</th>
                                                                <th class="text-center border">Total Biaya</th>
                                                                <th class="text-center border">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kebutuhan_pendukung_packings as $Kebutuhan_Pendukung_Packing)
                                                        <tr>
                                                           
                                                            <td class="border">{{ $loop->iteration }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->id }}</td> 
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->Pendukung_Packing_Id }}</td> 
                                                            <td class="border">{{ $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Nama_Pendukung_Packing }}</td> 
                                                            <td class="border">{{ $Kebutuhan_Pendukung_Packing->Keterangan_Kebutuhan_Pendukung_Packing_Item }}</td>
                                                            <td class="border">{{ $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Satuan_Pendukung_Packing }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Tebal_Pendukung_Packing }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->Lebar_Kebutuhan_Pendukung_Packing_Item }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->Panjang_Kebutuhan_Pendukung_Packing_Item }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item }}</td>
                                                            
                                                            @if ($Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Satuan_Pendukung_Packing == "Meter")
                                                                <td class="text-center border">
                                                                    {{ number_format(
                                                                        $Kebutuhan_Pendukung_Packing->Panjang_Kebutuhan_Pendukung_Packing_Item*
                                                                        $Kebutuhan_Pendukung_Packing->Lebar_Kebutuhan_Pendukung_Packing_Item/1000000*
                                                                        $Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item
                                                                        ,4,'.') 
                                                                    }}
                                                                </td>
                                                                @if(in_array(auth()->user()->akses , [1]))
                                                                <td class="border">
                                                                    Rp. {{ number_format(
                                                                         $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing/
                                                                         (
                                                                             $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Panjang_Pendukung_Packing
                                                                             *$Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Lebar_Pendukung_Packing/1000000
                                                                         ),2,'.'
                                                                     ) }} 
                                                                 </td>
                                                                 <td class="border">
                                                                    Rp. {{ number_format(
                                                                        (
                                                                            $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing/
                                                                        (
                                                                            $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Panjang_Pendukung_Packing
                                                                            *$Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Lebar_Pendukung_Packing/1000000
                                                                        )
                                                                        )
                                                                            *
                                                                        (
                                                                            $Kebutuhan_Pendukung_Packing->Panjang_Kebutuhan_Pendukung_Packing_Item*
                                                                            $Kebutuhan_Pendukung_Packing->Lebar_Kebutuhan_Pendukung_Packing_Item/1000000*
                                                                            $Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item        
                                                                        ),2,'.'
                                                                    ) }}
                                                                </td>
                                                                @endif
                                                            @else
                                                               <td>--</td> 
                                                                @if(in_array(auth()->user()->akses , [1]))
                                                                    <td>Rp.{{ number_format($Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing,2,'.') }}</td>
                                                                    <td>Rp.{{ number_format($Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing * $Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item,2,'.') }}</td>
                                                                @endif
                                                            @endif
                                                            
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Kebutuhan_Packing_Item/{{ $Kebutuhan_Pendukung_Packing->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                    <form action="/Kebutuhan_Packing_Item/{{ $Kebutuhan_Pendukung_Packing->id }}"  method="POST">
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
                                                <div class="flex-row-reverse d-flex mt-4">
                                                    <a href="{{ route('Kebutuhan_Pendukung_Packing_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                        <i class="fa-solid fa-print mr-2"></i>Print
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Pendukung Packing --}}

                                {{-- Kebutuhan Karton Box --}}
                                <div class="Karton_Box">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Kebutuhan Karton Box</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <button data-target="#JumlahKolomFormKartonBox" data-toggle="modal" class=" btn rounded px-3 btn-primary ml-2">
                                                    <i class="fa-solid fa-plus"></i>
                                                    Kebutuhan Karton Box baru
                                                </button>
                                                
                                                <button type="button" class="btn rounded btn-success ml-2" data-toggle="modal" data-target="#importModalKartonBox">
                                                    <i class="fas fa-regular fa-file-import mr-2"></i>Import
                                                </button>
                                            </div>
                                        @endif
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
                                                            <th class="text-center border">Kode Cutting</th>
                                                            <th class="text-center border">Material</th>
                                                            <th class="text-center border">Keterangan</th>
                                                            <th class="text-center border">Tinggi Mm</th>
                                                            <th class="text-center border">Lebar Mm</th>
                                                            <th class="text-center border">Panjang MM</th>
                                                            <th class="text-center border">Jumlah</th>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                            <th class="text-center border">Biaya Satuan</th>
                                                            <th class="text-center border">Total Biaya</th>
                                                            <th class="text-center border">Action</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kebutuhan_karton_boxs as $Kebutuhan_Karton_Box)
                                                        <tr>
                                                           
                                                            <td class="border">{{ $loop->iteration }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Karton_Box->id }}</td> 
                                                            <td class="border">{{ $Kebutuhan_Karton_Box->Jenis_Kebutuhan_Karton_Box }}</td> 
                                                            <td class="border">{{ $Kebutuhan_Karton_Box->Keterangan_Kebutuhan_Karton_Box_Item}}</td> 
                                                            <td class="border">{{ $Kebutuhan_Karton_Box->Tinggi_Kebutuhan_Karton_Box_Item }}</td>
                                                            <td class="border">{{ $Kebutuhan_Karton_Box->Lebar_Kebutuhan_Karton_Box_Item }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Karton_Box->Panjang_Kebutuhan_Karton_Box_Item }}</td>
                                                            <td class="text-center border">{{ $Kebutuhan_Karton_Box->Quantity_Kebutuhan_Karton_Box_Item }}</td>
                                                            @if(in_array(auth()->user()->akses , [1]))
                                                                <td class="text-center border">Rp. {{ number_format($Kebutuhan_Karton_Box->Harga_Kebutuhan_Karton_Box_Item ,2,'.'
                                                                    )}}</td>
                                                                <td class="text-center border">Rp. {{ number_format(
                                                                    $Kebutuhan_Karton_Box->Harga_Kebutuhan_Karton_Box_Item * $Kebutuhan_Karton_Box->Quantity_Kebutuhan_Karton_Box_Item ,2,'.'
                                                                )}}</td>
                                                                <td class="border">
                                                                    <div class="d-flex">
                                                                        <a href="/Kebutuhan_Karton_Box_Item/{{ $Kebutuhan_Karton_Box->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                                    <form action="/Kebutuhan_Karton_Box_Item/{{ $Kebutuhan_Karton_Box->id }}"  method="POST">
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
                                                <div class="flex-row-reverse d-flex mt-4">
                                                    <a href="{{ route('Kebutuhan_Karton_Box_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                        <i class="fa-solid fa-print mr-2"></i>Print
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Kebutuhan Karton Box --}}

                                {{-- Ongkos Kerja Borongan Dalam --}}
                                <div class="Borongan_Dalam ">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Ongkos Kerja Borongan Dalam</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_Borongan_Dalam'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_Borongan_Dalam') }}
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <div class="table-responsive">
                                                <table class="table table-bordered border" id="table-1">
                                                    <thead class="border">
                                                        <tr class="border">
                                                            <th class="text-center border">No</th>
                                                            <th class="text-center border">Jenis Pekerjaan</th>
                                                            <th class="text-center border">Ongkos Kerja</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($borongan_dalams as $borongan_dalam)
                                                            <tr>
                                                                <td class="border">1</td>
                                                                <td class="border">Bahan 1</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Bahan_1,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">2</td>
                                                                <td class="border">Bahan 2</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Bahan_2,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">3</td>
                                                                <td class="border">Sanding 1</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Sanding_1,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">4</td>
                                                                <td class="border">Sanding 2</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Sanding_2,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">5</td>
                                                                <td class="border">Proses Assembling</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Proses_Assembling,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">6</td>
                                                                <td class="border">Finishing</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Finishing,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">7</td>
                                                                <td class="border">Packing</td>
                                                                <td class="border">Rp. {{ number_format($borongan_dalam->Packing,2,'.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="flex-row-reverse d-flex mt-4">
                                                <a href="{{ route('Borongan_Dalam_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                    <i class="fa-solid fa-print mr-2"></i>Print
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <a href="{{ count($borongan_dalams) < 1 ? route('Borongan_Dalam_Item.create', ['itemId' => $Item]) : route('Borongan_Dalam_Item.edit', $borongan_dalams[0]->id) }}" class="btn rounded btn-success me-md-2 ml-2 px-5" type="button">
                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                {{-- End Ongkos Kerja Borongan Dalam --}}
                                
                                {{-- Ongkos Kerja Borongan Luar --}}
                                <div class="Borongan_Luar ">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Ongkos Kerja Borongan Luar</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_Borongan_Luar'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_Borongan_Luar') }}
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <div class="table-responsive">
                                                <table class="table table-bordered border" id="table-1">
                                                    <thead class="border">
                                                        <tr class="border">
                                                            <th class="text-center border">No</th>
                                                            <th class="text-center border">Jenis Pekerjaan</th>
                                                            <th class="text-center border">Ongkos Kerja</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Borongan_Luars as $Borongan_Luar)
                                                            <tr>
                                                                <td class="border">1</td>
                                                                <td class="border">Anyam</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Anyam,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">2</td>
                                                                <td class="border">Ukir</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Ukir,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">3</td>
                                                                <td class="border">Handle</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Handle,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">4</td>
                                                                <td class="border">Bubut</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Bubut,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">5</td>
                                                                <td class="border">Pirelly & Jok</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Pirelly_Jok,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">6</td>
                                                                <td class="border">Sterofoam</td>
                                                                <td class="border">Rp. {{ number_format($Borongan_Luar->Sterofoam,2,'.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="flex-row-reverse d-flex mt-4">
                                                <a href="{{ route('Borongan_Luar_Item.export', ['itemId' => $Item->id]) }}" target="_blank" class="btn rounded btn-info me-md-2 ml-2 px-5" type="button">
                                                    <i class="fa-solid fa-print mr-2"></i>Print
                                                </a>
                                                @if(in_array(auth()->user()->akses , [1]))
                                                <a href="{{ count($Borongan_Luars) < 1 ? route('Borongan_Luar_Item.create', ['itemId' => $Item]) : route('Borongan_Luar_Item.edit', $Borongan_Luars[0]->id) }}" class="btn rounded btn-success me-md-2 ml-2 px-5" type="button">
                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                {{-- End Ongkos Kerja Borongan Luar --}}

                                {{-- Total Biaya --}}
                                @if(in_array(auth()->user()->akses , [1]))
                                <div class="Total_Biaya ">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Total Biaya</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table table-bordered border" id="table-1">
                                                    <thead class="border">
                                                        <tr class="border">
                                                            <th class="text-center border">No</th>
                                                            <th class="text-center border">Jenis</th>
                                                            <th class="text-center border">Biaya</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                            <tr>
                                                                <td class="border">1</td>
                                                                <td class="border">Kayu</td>
                                                                    @php
                                                                        $total_harga_kayu = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($kebutuhan_plywood_mdfs as $kebutuhan_plywood_mdf)
                                                                        @php
                                                                            $total_harga_kayu += 
                                                                                $kebutuhan_kayu->MasterKayu->Harga_Kayu*
                                                                                (
                                                                                    ($kebutuhan_kayu->Tebal_Kebutuhan_Kayu_Item+5)*
                                                                                    (($kebutuhan_kayu->Panjang_Kebutuhan_Kayu_Item+20)*1.1)*
                                                                                    ($kebutuhan_kayu->Lebar_Kebutuhan_Kayu_Item+10)/1000000000*
                                                                                    $kebutuhan_kayu->Quantity_Kebutuhan_Kayu_Item
                                                                                )
                                                                            ;
                                                                        @endphp
                                                                    @endforeach
                                                                <td class="border">
                                                                   Rp. {{ number_format($total_harga_kayu,2,'.') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">2</td>
                                                                <td class="border">Plywood MDF</td>
                                                                    @php
                                                                        $total_harga_plywood_mdf = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($kebutuhan_plywood_mdfs as $kebutuhan_plywood_mdf)
                                                                        @php
                                                                            $total_harga_plywood_mdf += (
                                                                        $kebutuhan_plywood_mdf->MasterPlywoodMDF->Harga_Plywood_MDF/
                                                                    (
                                                                        $kebutuhan_plywood_mdf->MasterPlywoodMDF->Panjang_Plywood_MDF
                                                                        *$kebutuhan_plywood_mdf->MasterPlywoodMDF->Lebar_Plywood_MDF/1000000
                                                                    )*1.2
                                                                    )
                                                                        *
                                                                    (
                                                                        $kebutuhan_plywood_mdf->Panjang_Kebutuhan_Plywood_MDF_Item*
                                                                        $kebutuhan_plywood_mdf->Lebar_Kebutuhan_Plywood_MDF_Item/1000000*
                                                                        $kebutuhan_plywood_mdf->Quantity_Kebutuhan_Plywood_MDF_Item                                                         
                                                                    );
                                                                        @endphp
                                                                    @endforeach
                                                                <td class="border">
                                                                   Rp. {{ number_format($total_harga_plywood_mdf,2,'.') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">3</td>
                                                                <td class="border">Hardware Accessories</td>
                                                                    @php
                                                                        $total_harga_hardware_accessories = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($kebutuhan_accessories_hardwares as $kebutuhan_accessories_hardware)
                                                                        @php
                                                                            $total_harga_hardware_accessories += $kebutuhan_accessories_hardware->Quantity_Kebutuhan_Accessories_Hardware_Item * $kebutuhan_accessories_hardware->MasterAccessoriesHardware->Harga_Accessories_Hardware;
                                                                        @endphp
                                                                    @endforeach
                                                                    <td class="border">Rp. {{ number_format($total_harga_hardware_accessories,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">4</td>
                                                                <td class="border">Komponen Finishing</td>
                                                                    @php
                                                                        $total_harga_komponen_finishing = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($kebutuhan_komponen_finishings as $kebutuhan_komponen_finishing)
                                                                        @php
                                                                            $total_harga_komponen_finishing += $kebutuhan_komponen_finishing->Quantity_Kebutuhan_Komponen_Finishing_Item * 
                                                                            $kebutuhan_komponen_finishing->MasterKomponenFinishing->Harga_Komponen_Finishing
                                                                            /$kebutuhan_komponen_finishing->MasterKomponenFinishing->Quantity_Komponen_Finishing
                                                                                    ;
                                                                        @endphp
                                                                    @endforeach
                                                                    <td class="border">Rp. {{ number_format($total_harga_komponen_finishing,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">5</td>
                                                                <td class="border">Pendukung Packing</td>
                                                                    @php
                                                                        $total_harga_pendukung_packing = 0;
                                                                    @endphp
                                                                    @foreach ($kebutuhan_pendukung_packings as $Kebutuhan_Pendukung_Packing)
                                                                        
                                                                            <!-- kode lainnya -->
                                                                            @if ($Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Satuan_Pendukung_Packing == "Meter")
                                                                                <!-- kode lainnya -->
                                                                                    @php
                                                                                        $subtotal = $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing/
                                                                                        ($Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Panjang_Pendukung_Packing*$Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Lebar_Pendukung_Packing/1000000)
                                                                                        *($Kebutuhan_Pendukung_Packing->Panjang_Kebutuhan_Pendukung_Packing_Item*$Kebutuhan_Pendukung_Packing->Lebar_Kebutuhan_Pendukung_Packing_Item/1000000*$Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item);
                                                                                        $total_harga_pendukung_packing += $subtotal;
                                                                                    @endphp
                                                                            @else
                                                                                <!-- kode lainnya -->
                                                                                    @php
                                                                                        $subtotal = $Kebutuhan_Pendukung_Packing->MasterPendukungPacking->Harga_Pendukung_Packing*$Kebutuhan_Pendukung_Packing->Quantity_Kebutuhan_Pendukung_Packing_Item;
                                                                                        $total_harga_pendukung_packing += $subtotal;
                                                                                    @endphp
                                                                            @endif
                                                                            <!-- kode lainnya -->
                                                                    @endforeach 
                                                                        <td class="border">Rp.{{ number_format($total_harga_pendukung_packing,2,'.') }}</td> 
                                                            </tr>
                                                            <tr>
                                                                <td class="border">6</td>
                                                                <td class="border">Karton Box</td>
                                                                    @php
                                                                        $total_harga_karton_box = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($kebutuhan_karton_boxs as $Kebutuhan_Karton_Box)
                                                                        @php
                                                                            $total_harga_karton_box += 
                                                                            $Kebutuhan_Karton_Box->Harga_Kebutuhan_Karton_Box_Item * $Kebutuhan_Karton_Box->Quantity_Kebutuhan_Karton_Box_Item
                                                                            ;
                                                                        @endphp
                                                                    @endforeach
                                                                <td class="border">Rp. {{ number_format($total_harga_karton_box,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">7</td>
                                                                <td class="border">Borongan Dalam</td>
                                                                    @php
                                                                        $total_borongan_dalam = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($borongan_dalams as $borongan_dalam)
                                                                        @php
                                                                            $total_borongan_dalam += 
                                                                            $borongan_dalam->Bahan_1 + $borongan_dalam->Bahan_2 +
                                                                            $borongan_dalam->Sanding_1 + $borongan_dalam->Sanding_2 +
                                                                            $borongan_dalam->Proses_Assembling + $borongan_dalam->Finishing +
                                                                            $borongan_dalam->Packing 
                                                                            ;
                                                                        @endphp
                                                                    @endforeach
                                                                <td class="border">Rp. {{ number_format($total_borongan_dalam,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border">8</td>
                                                                <td class="border">Borongan Luar</td>
                                                                @php
                                                                        $total_borongan_luar = 0; // nilai awal total harga
                                                                    @endphp
                                                                    @foreach ($Borongan_Luars as $borongan_luar)
                                                                        @php
                                                                            $total_borongan_luar += 
                                                                            $borongan_luar->Anyam + $borongan_luar->Ukir +
                                                                            $borongan_luar->Handle + $borongan_luar->Bubut +
                                                                            $borongan_luar->Pirelly_Jok + $borongan_luar->Sterofoam
                                                                            ;
                                                                        @endphp
                                                                    @endforeach
                                                                <td class="border">Rp. {{ number_format($total_borongan_luar,2,'.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center font-weight-bold border" colspan="2">Total Biaya</td>
                                                                <td class="border font-weight-bold" >Rp.
                                                                    {{ number_format(
                                                                        $total_harga_kayu + $total_harga_plywood_mdf + $total_harga_hardware_accessories + $total_harga_komponen_finishing + $total_harga_pendukung_packing +  $total_harga_karton_box + $total_borongan_dalam + $total_borongan_luar,2,'.') 
                                                                    }}
                                                                </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endif
                                {{-- End Total Biaya --}}

                                {{-- Gambar Item --}}
                                <div class="Gambar_Item">
                                    <div class="row py-4">
                                        <div class="col">
                                            <h5>Gambar Item</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <a href="{{ route('Gambar_Item.create', ['itemId' => $Item]) }}" class="btn rounded btn-primary me-md-2 ml-2 px-5" type="button">
                                                    <i class="fas fa-plus mr-2"></i>Tambah Gambar Item Baru
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_gambar_item'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_gambar_item') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            <div class="row">
                                                @foreach ($gambarItems as $gambarItem)
                                                <div class="col-md-6 h-100 p-2 border my-1">
                                                    <div class="h-100 mb-3">
                                                        <img src="{{ asset('storage/gambar_items/' . $gambarItem->Gambar_Item) }}" class="img-fluid" alt="Gambar Item">
                                                        
                                                    </div>
                                                    <div class="d-flex text-center align-center justify-content-center">
                                                        @if(in_array(auth()->user()->akses , [1]))
                                                        <form action="/Gambar_Item/{{ $gambarItem->id }}"  method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger mt-auto" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</button>
                                                        </form>
                                                        @endif
                                                        <a href="{{ route('download.gambar', $gambarItem->id) }}" class="btn btn-primary ml-2">Download Gambar</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- Gambar Item --}}

                                {{-- Gambar Kerja --}}
                                <div class="Gambar_Item">
                                    <div class="row py-4 mt-5">
                                        <div class="col">
                                            <h5>Gambar Kerja</h5>
                                        </div>
                                        @if(in_array(auth()->user()->akses , [1]))
                                            <div class="col d-flex flex-row-reverse">
                                                <a href="{{ route('Gambar_Kerja.create', ['itemId' => $Item]) }}" class="btn rounded btn-primary me-md-2 ml-2 px-5" type="button">
                                                    <i class="fas fa-plus mr-2"></i>Tambah Gambar Kerja Baru
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @if (session()->has('success_gambar_kerja'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success_gambar_kerja') }}
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </div>
                                            @endif
                                            @foreach ($gambarKerjas as $pdf)
                                            <div class="d-flex flex-column">
                                                <iframe  type="application/pdf" src="{{ asset('storage/gambar_kerjas/' . $pdf->pdf_file) }}" width="100%" height="700"></iframe>
                                                <div class="d-flex text-center align-center justify-content-center mt-2">
                                                    <form action="{{ route('Gambar_Kerja.destroy', $pdf->id) }}"  method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger mt-auto" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Gambar Kerja --}}
                               
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
