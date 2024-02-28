@extends('home.includes.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>category</h3>
            <div class="d-flex justify-content-end">
                <a href="{{route('category.create')}}" class="btn btn-primary">
                    <i class="bi bi-plus">
                        create category
                    </i>
                </a>
            </div>
            <div class="container mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Category</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>kaska</td>
                                    <td>kaska</td>
                                    <td>
                                        <img src="" alt="ini gambar">
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning">
                                            <i class="bi bi-pencil-fill">edit</i>
                                        </a>
                                        <a href="#" class="btn btn-primary">
                                            <i class="bi bi-eye">View</i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="bi bi-trash">Trash</i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection