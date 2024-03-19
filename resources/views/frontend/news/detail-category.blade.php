@extends('frontend.parent')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-9">
                    @foreach($news as $row)
                    <h3 class="category-title">Search Results</h3>

                    <div class="d-md-flex post-entry-2 small-img">
                        <a href="#" class="me-4 thumbnail">
                            <img src="{{$row->image}}" alt="" class="img-fluid">
                        </a>
                        <div>
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas.</p>
                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                                <div class="name">
                                    <h3 class="m-0 p-0">Wade Warren</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

</section>
@endsection