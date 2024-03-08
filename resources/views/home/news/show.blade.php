@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <h3 class="card-title ">
            {{$news->title}} - <span class="badge text-light bg-primary">{{$news->category->name}}</span>
        </h3>

        <div class="container">
            <p>
                <img src="{{ $news->image }}" class="image-thumbnail rounded" alt="Responsive image"/>
            </p>
        </div>

        <div id="editor" readonly>
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