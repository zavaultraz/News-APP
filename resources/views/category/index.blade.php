@extends('home.includes.parent')

@section('content')
<div class="row">
    <div class="card p-4">
        <h3 class="text-uppercase">category</h3>
        <hr>
        <div class="d-flex justify-content-end">
            <a href="{{route('category.create')}}" class="btn btn-primary">
                <i class="bi bi-plus">
                    create category
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
                            @forelse ($category as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->slug}}</td>
                                <td>
                                    <img src="{{ $row->image }}" width="100px" alt="ini gambar">
                                </td>
                                <td class="gap-2">

                                    <!--  -->
                                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#basicModal{{$row->id}}">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                    @include('category.include.modal-show')


                                    <a href="{{route('category.edit', $row->id)}}" class="btn btn-warning mt-2">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <!-- button delate with route destroy row > id -->
                                    <form action="{{ route('category.destroy', $row-> id ) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2 "><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center font-size-4">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <!-- paginate -->
                    {{ $category->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection