@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <h1 class="fs-3 card-title  ">
            {{$news->title}} - <span class="badge fs-5 text-light bg-primary">{{$news->category->name}}</span>
        </h1>

        <div class="container">
            <p>
                <img src="{{ $news->image }}" class="image-fluid  rounded" width="100%" alt="Responsive image"/>
            </p>
        </div>

        <div class="container" readonly>
            <p>{!! $news->content !!}</p>
        </div>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    readOnly: true
                })
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

        <div class="container">
            <div class="d-flex justify-content-end">
                <a href="{{route('news.index')}}" class="btn btn-primary mt-2">
                    <i class="bi bi-back"> Kembali</i>
                </a>
            </div>
        </div>

    </div>
</div>

@endsection