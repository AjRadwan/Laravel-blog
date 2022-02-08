<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function show(){
        return view('single-post');
    }
}
