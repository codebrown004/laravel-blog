@extends('layouts.app')
@section('title', 'Single Post')

@section('content')
    <div class="col-md-8">
        <h1>Create Post</h1>
        <form method="POST" action="/posts" enctype="multipart/form-data">
            @csrf
         <label>Title</label><input type="text" name="title" class="form-control">
         <label>Content</label> <textarea name="body" class="form-control" id="article-ckeditor"></textarea><br>  
         <label>Select file to upload</label><input type="file" name="cover_image" class="form-control"><br>
         <input type="submit" name="submit" value="submit" class="btn btn-primary float-right">
        </form>      
    </div>
@endsection

@push('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endpush
