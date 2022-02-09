@extends('layout')
@section('CKEDITOR')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endsection
@section('main')
<main class="container" style="background-color: #fff;">
<section id="contact-us">
<h1 style="padding-top: 50px;">Edit Blog Post!</h1>

@include('include.flash-message')


<!-- Contact Form -->
<div class="contact-form">
<form action="{{route('blog.update', $post)}}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <!-- Title -->
    <label for="title"><span>Title</span></label>
    <input type="text" id="title" name="title"  value="{{($post->title)}}"/>
    @error('title')
       <strong style="color: red; font-weight: bold; margin-bottom: 20px;"> {{ $message }}</strong>
    @enderror

    <!-- Image -->
    <label for="image"><span>Image</span></label>
    <input type="file" id="image" name="image" />
    @error('image')
       <strong style="color: red; font-weight: bold; margin-bottom: 20px;"> {{ $message }}</strong>
    @enderror

    <!-- Body-->
    <label for="body"><span>Body</span></label>
    <textarea id="body" name="body">{{($post->body)}}</textarea>
    @error('body')
       <strong style="color: red; font-weight: bold; margin-bottom: 20px;"> {{ $message }}</strong>
    @enderror

    <!-- Button -->
    <input type="submit" value="Submit" />
</form>
</div>

</section>
</main>
@section('scripts')
<script>
    CKEDITOR.replace( 'body' );
  </script>
@endsection
@endsection