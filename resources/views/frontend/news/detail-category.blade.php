@extends('frontend.parent')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-9">
                    @foreach($category as $row)
                    <h3 class="category-title">Results {{$row->name}}</h3>
@foreach ($row->news as $news )
    
<div class="d-md-flex post-entry-2 small-img">
                        <a href="#" class="me-4 thumbnail">
                            <img src="{{$news->image}}" alt="" class="img-fluid">
                        </a>
                        <div>
                            <div class="post-meta"><span class="date">{{$row->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                            <h3><a href="#">{{ Str::limit($news->title, 30) }}</a></h3>
                            <p>{{ Str::limit(strip_tags($news->content, 75)) }}</p>
                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                                <div class="name">
                                    <h3 class="m-0 p-0">zavvv</h3>
                                </div>
                            </div>
                        </div>
                    </div>
@endforeach
                    @endforeach
                </div>

</section>
@endsection