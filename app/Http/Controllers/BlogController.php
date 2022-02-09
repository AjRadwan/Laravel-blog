<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BlogController extends Controller{

    public function __Construct(){
       $this->middleware('auth')->except(['index']);
}    

    public function index(){
        $posts = Post::all();
        return view('blog', compact('posts'));
    }

    public function create(){
        return view('create-blog-post');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);

        $title = $request->input('title');
        $slug = Str::slug($title, '-');
        $user_id = Auth::user()->id;
        $body = $request->input('body');

        // File Upload
        $imagePath = 'storage/' . $request->file('image')->store('postsImages', 'public');

       $post = new Post();
       $post->title = $title;
       $post->slug = $slug;
       $post->user_id = $user_id;
       $post->imagePath = $imagePath;
       $post->body = $body;
       $post->save();

       return redirect()->back()->with('message', "Post Created Successfully");
//return redirect()->route('index')->with('message', "Post Created SuccessFully!");

    }

    // public function show($slug){
    //     $post = Post::where('slug', $slug)->first();
    //     return view('single-post', compact('post'));
    // }

    // using route model binding

    public function edit(Post $post) {
        if (auth()->user()->id !== $post->user->id){
            abort(403);
        }
        return view('edit-blog', compact('post'));
    }

    public function show(Post $post){
        return view('single-post', compact('post'));
    }



    public function update(Request $request, Post $post){
        if (auth()->user()->id !== $post->user->id){
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);

        $title = $request->input('title');
        $slug = Str::slug($title, '-');
        $body = $request->input('body');

        // File Upload
        $imagePath = 'storage/' . $request->file('image')->store('postsImages', 'public');

       $post->title = $title;
       $post->slug = $slug;
       $post->imagePath = $imagePath;
       $post->body = $body;
       $post->save();

       return redirect()->back()->with('message', "Post Updated Successfully");
    }
}
