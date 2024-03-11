@extends('home.includes.parent')
@section('content')
    <div class="row">
        <div class="card p-4">
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

            <h3>Edit page</h3>

            <hr>
            <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                <label for="InputName" class="form-label">Change Category</label>
                <input type="text" class="form-control" id="InputName" name="name" value="{{$category->name}}">
            </div>
            <div class="col-12">
                <label for="InputImage" class="form-label">Change Image</label>
                <input type="file" class="form-control" id="InputImage" name="image">
            </div>
            <div class="d-flex justify-content-end mt-2 ">
                <a href="{{route ('category.index')}}" class="btn btn-warning mt-2 me-2 ">
                    <i class="bi bi-caret-left-fill"></i> Back</a>
            <button type="submit" class="btn btn-success mt-2">
                <i class="bi  bi-check"></i> Edit Category
            </button>
            </div>
            </form>
        </div>
    </div>
@endsection