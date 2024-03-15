@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <div class="card-title">
            <h2 class="fs-1">All User</h2>
            <hr>
        </div>
        @if (session('success'))
        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @foreach ($users as $row)
        <table class="table text-center  table-hover">
    <thead class="table table-primary">
        <tr>
            <th >No</th>
            <th>User</th>
            <th>Email</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->role }}</td>
            <td>
                <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#basicModal{{$row->id}}">
                    <i class="bi bi-exclamation-triangle"></i>
                    Reset Password
                </button>
                <div class="modal fade" id="basicModal{{$row->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password {{$row->name}} ?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Default Password Become to
                                <strong>123456</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{route('resetpassword',$row->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Reset <i class="bi bi-check-circle me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

        @endforeach
    </div>
</div>
@endsection