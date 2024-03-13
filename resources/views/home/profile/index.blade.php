@extends('home.includes.parent')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 text-center">
                <div class="row">
                    <div class="col-md-4">
                        <img src="https://ui-avatars.com/api/background=012970&color=fff?name={{ Auth::user()->name }}" alt="" class="img-fluid w-100 rounded-circle">
                    </div>
                    <div class="col-md-8 align-self-center">
                        <h3 class="fw-semibold">Profile</h3>
                        <hr>
                        <div class="text-left">
                            <p><strong>Username :</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Role :</strong> {{ Auth::user()->role }}</p>
                            <p><strong>E-Mail :</strong> {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div



@endsection