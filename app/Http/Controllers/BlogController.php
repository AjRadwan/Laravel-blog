<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BlogController extends Controller{

    public function __Construct(){
       $this->middleware('auth')->except(['index', 'show']);
}    

public function index(Request $request){
    if ($request->search) {
        $posts = Post::where('title', 'like', '%' . $request->search . '%')
        ->orwhere('body', 'like', '%' . $request->search . '%')->latest()->paginate(4);
    } elseif ($request->category){
        $posts = Category::where('name', $request->category)->firstOrFail()->posts()->paginate(4)->withQueryString();
        }else{ 
         $posts = Post::latest()->paginate(4);
    }
    //displaying categories in index blog page
    $categories = Category::all() ;
    return view('blog', compact('posts', 'categories'));
}

    public function create(){
        $categories = Category::all();
        return view('create-blog-post', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->input('title');
        $category_id = $request->input('category_id');
        $slug = Str::slug($title, '-');
        $user_id = Auth::user()->id;
        $body = $request->input('body');

        // File Upload
        $imagePath = 'storage/' . $request->file('image')->store('postsImages', 'public');

       $post = new Post();
       $post->title = $title;
       $post->category_id = $category_id;
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
        $category = $post->category;
        $relatedPosts = $category->posts()->where('id', '!=', $post->id)->latest()->take(3)->get();
        return view('single-post', compact('post', 'relatedPosts'));
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

    public function delete(Post $post){

        $post->delete();
        return redirect()->back()->with('message', "Post Deleted Successfully");
    }
}
