@extends('layout')
@section('CKEDITOR')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endsection
@section('main')
<main class="container" style="background-color: #fff;">
<section id="contact-us">
<h1 style="padding-top: 50px;">Update Category !</h1>

@include('include.flash-message')
 

<!-- Contact Form -->
<div class="contact-form">
<form action="{{route('categories.update', $category)}}" method="POST">
    @method('put')
    @csrf
    <!-- Title -->
    <label for="name"><span>Name</span></label>
    <input type="text" id="name" name="name"  value="{{$category->name}}"/>
    @error('name')
       <strong style="color: red; font-weight: bold; margin-bottom: 20px;"> {{ $message }}</strong>
    @enderror


    <!-- Button -->
    <input type="submit" value="Submit" />
</form>
</div>

<div>
    <a href="{{route('categories.index')}}">Category List <span>&#8594</span> </a> 
</div>

</section>
</main>
@section('scripts')
<script>
    CKEDITOR.replace( 'body' );
  </script>
@endsection
@endsection