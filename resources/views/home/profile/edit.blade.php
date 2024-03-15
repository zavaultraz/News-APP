@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <h1 class="card-title fs-2">
            Edit Profile
        </h1>
        <form action="{{route('updateProfile')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text"  name="first_name" value="{{Auth::user()->profile->first_name}}" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Image profile</label>
            <div class="col-sm-10">
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-end">
            
        <button type="submit" class="btn btn-primary "><i class="bi bi-bookmark-check"></i> Submit</button>
        
        </div>
    </form>


    </div>
</div>
@endsection