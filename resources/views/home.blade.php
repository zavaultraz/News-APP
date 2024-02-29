@extends('home.includes.parent');
@section('content')

    <div class="container">
        <div class="row">
            <h1>Wellcome {{ Auth::user()->name }}</h1>
        </div>
    </div>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="btn btn-danger">logout</button>
    </form>
@endsection