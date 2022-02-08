<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    
    public function index(){
        return view('blog');
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
       $imagePath = $request->file('image')->store('public');

       $post = new Post();
       $post->title = $title;
       $post->slug = $slug;
       $post->user_id = $user_id;
       $post->imagePath = $imagePath;
       $post->body = $body;
    
       $post->save();

       return redirect()->back();

    }

    public function show(){
        return view('single-post');
    }
}
