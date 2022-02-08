<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
           'body' =>  'required'
        ]);

        $title = $request->input('title');
        $slug = Str::slug('title', '-');
        $user_id = Auth::user()->id;
        $body = $request->input('body');

    }

    public function show(){
        return view('single-post');
    }
}
