@extends('layout')
    

@section('main')
<main class="container">
  <h2 class="header-title">All Blog Posts</h2>
  @if (session('message'))
<strong style="color: green; font-weight: bold; text-align: center"> {{ session('message') }}</strong>
@endif
  <div class="searchbar">
    <form action="">
      <input type="text" placeholder="Search..." name="search" />
      <button type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
  <div class="categories">
    <ul>
      <li><a href="">Health</a></li>
      <li><a href="">Entertainment</a></li>
      <li><a href="">Sports</a></li>
      <li><a href="">Nature</a></li>
    </ul>
  </div>

  <section class="cards-blog latest-blog">
    @forelse ($posts as $post)
    <div class="card-blog-content">
      @auth
      @if (auth()->user()->id === $post->user->id)
      <div class="post-buttons">
          <a href="{{route('blog.edit', $post)}}">Edit</a>
      
          <form action="{{route('blog.delete', $post)}}" method="post">
            @csrf
            @method('delete')
              <input type="submit" value="Delete">
          </form>
      </div>
      @endif
      @endauth
      <img src="{{asset($post->imagePath)}}" alt="" />
      <p>
       {{$post->created_at->diffForhumans()}}
        <span>Written By {{$post->user->name}}</span>
      </p>
      <h4>
        <a href="{{route('single-post', $post)}}">{{$post->title}}</a>
      </h4>
    </div>
    @empty
    <p>Sorry!! Currently ther is not post available Related to your search</p>
    @endforelse

  
    <!-- pagination -->
    <div class="pagination" id="pagination">
      <a href="">&laquo;</a>
      <a class="active" href="">1</a>
      <a href="">2</a>
      <a href="">3</a>
      <a href="">4</a>
      <a href="">5</a>
      <a href="">&raquo;</a>
    </div>
  </section>

  
</main>
@endsection