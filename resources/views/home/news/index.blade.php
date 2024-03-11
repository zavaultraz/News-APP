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
        @if (session('success'))
        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
        {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif
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
                            <th>Icon</th>
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
                                <a href="{{route('news.show', $row->id)}}" class="btn btn-primary mt-2"><i class="bi bi-eye"></i> Lihat</a>
                                <a href="{{route('news.edit', $row->id)}}" class="btn btn-warning mt-2"><i class="bi bi-pencil"></i> Edit</a>
                                <form action="{{ route('news.destroy', $row-> id ) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash"></i> Delete</button>

                                    </form>
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