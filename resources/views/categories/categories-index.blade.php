@extends('layout')

@section('main')
    <div class="categories-list">
        <h1>Categories List</h1>
       @include('include.flash-message')
        @foreach ($categories as $category )
       <div class="item">
        <p>{{$category->name}}</p>
        <div>
            <a href="{{route('categories.edit', $category)}}">Edit</a>
        </div>
        <form action="{{route('categories.destroy', $category)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
        </form>

       
    </div>
       @endforeach
        <div class="index-categories">
            <a href="{{route('categories.create')}}">Create category<span>&#8594;</span></a>
        </div>
    </div>
@endsection