@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <h1>News</h1>
        <hr>
        <div class="d-flex justify-content-end">
            <a href="{{route('news.create')}}" class="btn btn-primary">
                <i class="bi bi-plus">
                    create news
                </i>
            </a>
        </div>
        <div class="container mt-3">
            <div class="card p-3">
                <h5 class="card-title">Data News</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Image Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $news as $row )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->category->name}}</td>
                            <td>
                                <img src="{{ $row->image }}" width="100px" alt="ini gambar">
                            </td>
                            
                            
                            <td><img src="{{ $row->category->image }}" width="100px" alt="gambar kategori"></td>
                            
                            <td>
                                <button class="btn btn-primary detail">
                                <i class="bi bi-eye"></i> Detail</button>
                                <button class="btn btn-warning edit">
                                    <i class="bi bi-pen"></i> Edit</button>
                                <button class="btn btn-danger delete">
                                    <i class="bi bi-x"></i> Delete</button>
                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection