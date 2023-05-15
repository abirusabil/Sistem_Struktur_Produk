@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
<div class="d-flex flex-wrap align-items-stretch">
    <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
      <div class="px-4 mx-3 ">
        <img src="/img/unsplash/regalindo-final.png" alt="logo" width="60" class="shadow-light  mb-5 mt-5">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
        @endif

        <h4 class="text-dark font-weight-normal">Welcome to </h4>
        <h5 class="text-dark"> <span class="font-weight-bold">Unit Kayu | PT.Aneka Regalindo</span></h5>
        <small class="text-muted">Before you get started, you must login or register if you don't already have an account.</small>

        <form method="POST" action="/login" class="needs-validation mt-2" novalidate="">
          @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
            <div class="invalid-feedback">
              Please fill in your email
            </div>
          </div>

          <div class="form-group">
            <div class="d-block">
              <label for="password" class="control-label">Password</label>
            </div>
            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
            <div class="invalid-feedback">
              please fill in your password
            </div>
          </div>

          <div class="form-group mt-2">
            {{-- <a href="auth-forgot-password.html" class="float-left mt-3">
              Forgot Password?
            </a> --}}
            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
              Login
            </button>
          </div>

          <div class="mt-5 text-center">
           
          </div>
        </form>

        
      </div>
      <footer class="text-center pt-5">
        <small>Copyright &copy; PT.Aneka Regalindo by Abiru sabil</small> 
      </footer>
    </div>
    <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="/img/unsplash/login-bg.jpg">
      <div class="absolute-bottom-left index-2">
        {{-- <div class="text-light p-5 pb-2">
          <div class="mb-5 pb-3">
            <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
            <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
          </div>
          Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
<footer></footer>
@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
