@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <div class="card-title fs-2">Change Password</div>
        <!-- alert -->
        @if (session('error'))
        <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-primary mt-2 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-octagon me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

        <form method="post" action="{{route('profile.update-password')}}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Current Paswword</label>
                <div class="col-sm-10">
                    <input type="password" placeholder="password sekarang" name="current_password" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" placeholder="password baru" name="password" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" placeholder="password baru" name="confirmation_password" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 w-100">
                Change Password
            </button>

        </form>


    </div>
    @endsection