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
    </div>
</div>
    
@endsection