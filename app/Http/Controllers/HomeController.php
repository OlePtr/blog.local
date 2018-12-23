<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');



        $posts = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->paginate(100);

//dd($posts);
        $category = DB::table('category')->paginate(10);
        //leftjoin('category', '.id', '=', 'posts.authors_authorID')->paginate(10);
        return view('home', ['posts' => $posts], ['category' => $category]);
    }

    public function getPostForm() {
        return view('post/post_form');
    }

    public function createPost(Request $request){
        $post = Post::create(array(
            'title' => Input::get('title'),
            'description' => Input::get('description'),
            'authors_authorID' => Auth::user()->id,

//TODO: fix me!!!!
            'category_categoryID' => Auth::user()->id
        //Auth::user()->id
        ));
        return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }

    public function getPost($id){
        $post = Post::find($id);
        return view('post/post_detail', ['post' => $post]);
    }

    public function editPost($id) {
        $post = Post::find($id);
        return view('post/edit_post', ['post' => $post]);
    }

    public function updatePost(Request $request, $id) {



        $post = Post::find($id);

        //TODO: strange вот тут была ошибка:  не было $post->postid=$id; и еще при сохранении mysql становится case sensitive
       // dd($request->image);
//dd($post);
        $post->postid=$id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->authors_authorID = 1;
        $post->category_categoryID = 1;

//        $post->image = $request->image->store("public/images");
//        $data=$request->all();
//        $data["imageUpload"] = $request->imageUpload->store("public/images");
     //   dump($request->file('imageUpload'));
      //  dd($request->imageUpload);
        $post->image = $request->file('imageUpload')->store('public/images');

//        $file = $request->file('imageUpload')->store('images');
        $post->save();
//        $request->session()->flash("message", "Post has been updated ?");
//        $data["image"] = $request->image->store("public/images");

        return redirect()->route('home')->with('success', 'Post has been updated successfully!');
    }

    public function deletePost(Request $request, $id) {
        $post = Post::find($id);
        dump($request->title);
        dump($request->description);
        dump($request->authors_authorID);
        dump($request->category_categoryID);

        $post->delete();
        return redirect()->route('home')->with('success', 'Post has been deleted successfully!');
    }
}
