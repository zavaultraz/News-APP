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
        <h3>create category</h3>
        <!-- route store -->
        <!-- untuk melakukan penambahan -->
        <!-- enctype melakukan input  data dalam bentuk file -->
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            <!-- csrf sebagai token atentifikasi  -->
@csrf
<!-- metod jenis yang digunakan -->
@method('POST')
            <div class="col-12">
                <label for="InputName" class="form-label">Create Category</label>
                <input type="text" class="form-control" id="InputName" name="name" value="{{old('name')}}">
            </div>
            <div class="col-12">
                <label for="InputImage" class="form-label">Input Category</label>
                <input type="file" class="form-control" id="InputImage" name="image">
            </div>
            <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success mt-2">
                <i class="bi  bi-clipboard-plus"></i> Add Category
            </button>
            </div>
            
        </form>
    </div>
</div>

@endsection