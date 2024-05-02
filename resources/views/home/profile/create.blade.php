@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
    @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        <h1 class="card-title fs-2">
            Create Profile
        </h1>
        <form action="{{route('storeprofile')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('POST')
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Jhon" name="first_name" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary "><i class="bi bi-bookmark-check"></i> Submit</button>
        </form>


    </div>
</div>
@endsection