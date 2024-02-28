@extends('home.includes.parent');
@section('content')
    <div class="container">
        <div class="row">
            <h1>Wellcome {{ Auth::user()->name }}</h1>
        </div>
    </div>
@endsection