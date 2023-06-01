@extends('layouts.app')

@section('title', 'Ecommerce Dashboard')

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
                <h1>User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">User</a></div>
                    <div class="breadcrumb-item">List User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                
                                <div class="w-100">
                                    <h4>List User</h4>
                                </div>
                                <div class="d-grid gap-2 d-md-flex w-100 justify-content-md-end">
                                    <a href="{{ url('User/create') }}" class="btn rounded btn-primary me-md-2" type="button">
                                        <i class="fa-solid fa-plus mr-2"></i>Tambah User Baru
                                    </a>
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
                                                <th>Nama</th>
                                                <th>Email User</th>
                                                <th>Akses</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($User as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->akses == '1')
                                                    ALL Akses
                                                    @elseif ($user->akses == '2')
                                                    Purchasing
                                                    @elseif ($user->akses == '3')
                                                    Accounting
                                                    @elseif ($user->akses == '4')
                                                    R&D
                                                    @elseif ($user->akses == '5')
                                                    PPIC
                                                    @elseif ($user->akses == '6')
                                                    Guest
                                                    @else
                                                    @endif
                                                    
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="/User/{{ $user->id }}/edit " class="btn btn-warning ml-2">Edit</a>
                                                    <form action="/User/{{ $user->id }}"  method="POST">
                                                        @method('delete')
                                                        @csrf
                                                      <button class="btn btn-danger ml-2" onclick="return confirm('Pakah Anda Yakin Untuk Menghapus ?')">Hapus</button>
                                                    </form>
                                                    </div> 
                                                </td>
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
