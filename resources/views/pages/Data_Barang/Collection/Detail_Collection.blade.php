@extends('layouts.app')

@section('title', 'Collection')

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
                <h1>Detail {{ $Collection->Nama_Collection }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Collection</a></div>
                    <div class="breadcrumb-item">List Item {{ $Collection->Nama_Collection }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <div class="row">
                                    <div class="col">
                                        <form action="/Collection">
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
                                  {{-- {{ $Collection->links() }} --}}
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
