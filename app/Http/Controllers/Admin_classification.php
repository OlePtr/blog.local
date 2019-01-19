<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class Admin_classification extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $posts = DB::table('posts')
//            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
//            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
////            ->where('is_published', '=' ,"1" )
////            ->orderBy('authors.authorID')
//            ->orderBy('posts.postid')
//            ->paginate(8);
//->get();
        $category = DB::table('category')->get();
//        $archives = DB::table('posts')->orderBy('postID', 'description')->get();
//        $selectedcat = 0;

        $postincategorycount = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
//            ->where('is_published', '=' ,"1")
            ->where("category", "!=", null)
            ->selectRaw('category,categoryURL, count(*) as cnt')
            ->groupBy("posts.category_categoryID")
            ->orderBy('authors.authorID')
            ->get();

        $data = array(
  //          'posts' => $posts,
  //          'archives' => $archives,
  //          'selectedcat' => 0,
            'category' => $category,
          'postincategorycount' => $postincategorycount
        );
//dd($data);

        return view('admin_classification', $data);
    }

    public function getCatForm()
    {
        return view('cat/cat_form');
    }

    public function createCat(Request $request)
    {
        $cat = Category::create(array(

            'category' => Input::get('cat_title'),
            'categoryDESCRIPTION' => Input::get('cat_description'),
            'categoryURL' => Input::get('cat_url')
        ));
        return redirect()->route('index_classification')->with('success', 'has been successfully added!');
    }

    public function getPost($id)
    {
        $post = Post::find($id);
        return view('post/post_detail', ['post' => $post]);
    }

    public function editCat($id)
    {
        $category = Category::find($id);
        return view('cat/edit_cat', ['cat' => $category]);
    }

    public function updateCat(Request $request, $id)
    {
        //dd($id);
        $category = Category::find($id);
        $category->category = $request->categoryName;
        $category->categoryDESCRIPTION = $request->description;
        $category->categoryURL = $request->catURL;
        //dd($category);
        $category->save();
        return redirect()->route('index_classification')->with('success', 'has been updated successfully!');
    }

    public function deleteCat($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('index_classification')->with('success', 'has been deleted successfully!');
    }

}
