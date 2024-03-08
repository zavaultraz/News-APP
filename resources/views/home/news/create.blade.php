@extends('home.includes.parent')
@section('content')
<div class="row">
    <div class="card p-4">
        <h2>News Create</h2>
        <hr>
        <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!-- field title -->
            <!-- fungsi old name adalah menampilkan kembali inputan user -->
            <div class="mb-2">
                <label for="InputTitle" class="form-label">News Title</label>
                <input type="text" class="form-control" id="InputTitle" name="title" value="{{old('title')}}">
            </div>
            <!-- field image -->
            <!-- fungsi old name adalah menampilkan kembali inputan user -->
            <div class="mb-2">
                <label for="InputImage" class="form-label">News Image</label>
                <input type="file" class="form-control" id="InputImage" name="image">
            </div>
            <div class="mb-3">
            <label class="col-sm-2 col-form-label">Chose Category</label>
            <div class="col-sm-10">
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option selected>--Select Category--</option>
            @foreach ($category as $row)
            <option value="{{$row->id}}">{{$row->name}}</option>
                    
            @endforeach
                </select>
            </div>
            </div>
          

            <!-- untuk content -->
            <!-- menggunakan CKeditor -->
            <div class="mb-2">
            <label class="col col-form-label">Content</label>
            <textarea id="editor" name="content"></textarea>
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
            
               <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success mt-2">
                <i class="bi  bi-clipboard-plus"></i> Create News
            </button>
            </div>
        </form>
    </div>
</div>
@endsection